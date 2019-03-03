
        </div>
        <!-- /#page-wrapper -->
    </div>                       
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="./js/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>
    <script src='./js/jquery.dataTables.js'></script>
    <script src='./js/dataTables.bootstrap.js'></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./js/raphael.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
    <!-- Custom Theme JavaScript -->

    <script src="./js/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="./js/amcharts/serial.js" type="text/javascript"></script>

    <script src="./js/main.js"></script>
</body>
</html>
<script>

    var chart1;
    var chart2;
    function render_transfer_chart(chartDatos){

        chart1 = null 
        
        // SERIAL CHART
        
        chart1 = new AmCharts.AmSerialChart();
        chart1.dataProvider = chartDatos;
        chart1.categoryField = "category";
        chart1.startDuration = 1;

        // AXES
        // category
        var categoryAxis = chart1.categoryAxis;
        categoryAxis.labelRotation = 90;
        categoryAxis.gridPosition = "start";

        var valueAxis = new AmCharts.ValueAxis();
            valueAxis.integersOnly = true;
            chart1.addValueAxis(valueAxis);


        // value
        // in case you don't want to change default settings of value axis,
        // you don't need to create it, as one value axis is created automatically.

        // GRAPH
        var graph = new AmCharts.AmGraph();
        graph.valueField = "total";
        graph.balloonText = "[[category]]: <b>[[value]]</b>";
        graph.type = "column";
        graph.lineAlpha = 0;
        graph.fillAlphas = 0.8;
        chart1.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart1.addChartCursor(chartCursor);

        chart1.creditsPosition = "top-right";

        chart1.write("chart_trans_day");
        

      }

      function render_debito_chart(chartDatos){
        chart2 = null
        
        // SERIAL CHART
        chart2 = new AmCharts.AmSerialChart();
        chart2.dataProvider = chartDatos;
        chart2.categoryField = "category";
        chart2.startDuration = 1;

        // AXES
        // category
        var categoryAxis = chart2.categoryAxis;
        categoryAxis.labelRotation = 90;
        categoryAxis.gridPosition = "start";

        var valueAxis = new AmCharts.ValueAxis();
            valueAxis.integersOnly = true;
            chart2.addValueAxis(valueAxis);


        // value
        // in case you don't want to change default settings of value axis,
        // you don't need to create it, as one value axis is created automatically.

        // GRAPH
        var graph = new AmCharts.AmGraph();
        graph.valueField = "total";
        graph.balloonText = "[[category]]: <b>[[value]]</b>";
        graph.type = "column";
        graph.lineAlpha = 0;
        graph.fillAlphas = 0.8;
        chart2.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart2.addChartCursor(chartCursor);

        chart2.creditsPosition = "top-right";

        chart2.write("chart_debit_day");
        

      }

      function make_data_chart(arreglo){
        let chart;
        let graph;
        let relleno = [];
        if(arreglo.length > 0){

          arreglo.forEach((i,e) =>{
            relleno.push({
              category: i.nombre,
              total: i.total
            })
          })

        }else{
          relleno.push({
            category: "Sin registros",
            total: 0
          })
        }

        return relleno;
      }

    $(function(){

      // ========== chart transferencias ======================

      var siglas = "<?= $config->siglas ?>"
      var chart;
      var graph;
      var relleno = [];
      var chartData;
      <?php 
        
        foreach ($transferencia_dia as $row){
            ?>
                relleno.push({
                "category": "<?php echo $row->nombre; ?>",
                "total": <?php echo $row->total; ?>
                });
            <?php

        }      
      ?>

      chartData = relleno;
      
      render_transfer_chart(chartData)          

      // ========== chart DEBITO ======================

      var chart;
      var graph;
      var relleno = [];
      var chartData;
      <?php 
        
        foreach ($debito_total as $row){
            ?>
                relleno.push({
                "category": "<?php echo $row->nombre; ?>",
                "total": <?php echo $row->total; ?>
                });
            <?php

        }      
      ?>

      chartData = relleno;
      
      render_debito_chart(chartData)          
      


      $('#form_filter').submit(function(e){
        e.preventDefault()
        
        let btn = $('#btn_filter')
        
        btn.text('filtrando...')

        $.ajax({
          url: "<?= base_url().'Caja/get_registers_by_filter' ?>",
          method: "GET",
          data: $(this).serialize(),
          dataType: "json",
          success: function(data){
            
            let general = data.general,
                trans   = general.total_transferencia,
                debito  = general.total_debito,
                efectivo= general.total_efectivo,
                dolares = general.total_dolares,
                dolares_bs = general.total_dolares_bs

            $('#badge_transferencia').text(number_decimals_format(trans,true)+" "+siglas)
            $('#badge_debito').text(number_decimals_format(debito,true)+" "+siglas)
            $('#badge_efectivo').text(number_decimals_format(efectivo,true)+" "+siglas)
            $('#badge_dolares').html(number_decimals_format(dolares,true)+"$")
            $('#badge_dolares_bs').html(number_decimals_format(dolares_bs,true)+" "+siglas)

            btn.html("Aceptar&nbsp;<i class='fa fa-thumbs-up'></i>")
            

            let data1 = make_data_chart(data.total_transfer)
            let data2 = make_data_chart(data.total_debito)
            
            render_transfer_chart(data1)
            render_debito_chart(data2)

            $('#modal_filtro').modal('hide')
          }
        })
      })
    });
</script>