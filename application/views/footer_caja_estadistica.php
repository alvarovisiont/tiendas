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
    <script src='./js/bootstrap-datepicker.js'></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./js/raphael.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
    <script src="./js/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="./js/amcharts/serial.js" type="text/javascript"></script>
<?php
$mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']; 
?>
<script type="text/javascript">

$(function(){

    var mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $("#fecha_inicio").datepicker(function(){
        format: "dd-mm-yyyy"
    }).on("changeDate", function(){
        $(this).datepicker('hide');
    });
    $("#fecha_limite").datepicker(function(){
        format: "dd-mm-yyyy"
    }).on("changeDate", function(){
        $(this).datepicker('hide');
    }); 

    var chart;
    var graph;
    var relleno = [];
    var chartData;
    <?php 
        if(count($estadistica_mes) > 0)
        {
            foreach ($estadistica_mes as $row) 
            {
                $monto = $row->total_monto - $row->total_vuelto;
                ?>
                    relleno.push({
                    category: "<?php echo $mes[$row->mes -1]; ?>",
                    total: <?php echo $monto; ?>
                    });
                <?php

            }
        }
            
    ?>

    chartData = relleno;
    AmCharts.ready(function () {
        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.dataProvider = chartData;
        chart.categoryField = "category";
        chart.startDuration = 1;

        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.labelRotation = 90;
        categoryAxis.gridPosition = "start";

        var valueAxis = new AmCharts.ValueAxis();
            valueAxis.integersOnly = true;
            chart.addValueAxis(valueAxis);


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
        chart.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        chart.addChartCursor(chartCursor);

        chart.creditsPosition = "top-right";

        chart.write("chartdivmes");
    });

    var chart1;
    var graph;

    var chartData1 = [
       <?php 
       if(count($estadistica_año) > 0)
       {
            foreach ($estadistica_año as $row) 
            {
                $monto = $row->total_monto - $row->total_vuelto;
        ?>  
                    {
                    "year": "<?php echo $row->año; ?>",
                    "value": <?php echo $monto; ?>
                    },
        <?php

            }
       }
        ?>
        
    ];


    AmCharts.ready(function () {
        // SERIAL CHART1
        chart1 = new AmCharts.AmSerialChart();

        chart1.dataProvider = chartData1;
        chart1.marginLeft = 10;
        chart1.categoryField = "year";
        chart1.dataDateFormat = "YYYY";

        // listen for "dataUpdated" event (fired when chart1 is inited) and call zoomChart method when it happens
        chart1.addListener("dataUpdated", zoomChart);

        // AXES
        // category
        var categoryAxis = chart1.categoryAxis;
        categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
        categoryAxis.minPeriod = "YYYY"; // our data is yearly, so we set minPeriod to YYYY
        categoryAxis.dashLength = 3;
        categoryAxis.minorGridEnabled = true;
        categoryAxis.minorGridAlpha = 0.1;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0;
        valueAxis.integersOnly = true;
        valueAxis.inside = true;
        valueAxis.dashLength = 3;
        chart1.addValueAxis(valueAxis);

        // GRAPH
        graph = new AmCharts.AmGraph();
        graph.type = "smoothedLine"; // this line makes the graph smoothed line.
        graph.lineColor = "#d1655d";
        graph.negativeLineColor = "#637bb6"; // this line makes the graph to change color when it drops below 0
        graph.bullet = "round";
        graph.bulletSize = 8;
        graph.bulletBorderColor = "#FFFFFF";
        graph.bulletBorderAlpha = 1;
        graph.bulletBorderThickness = 2;
        graph.lineThickness = 2;
        graph.valueField = "value";
        graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>";
        chart1.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.cursorPosition = "mouse";
        chartCursor.categoryBalloonDateFormat = "YYYY";
        chart1.addChartCursor(chartCursor);

        // SCROLLBAR
        var chartScrollbar = new AmCharts.ChartScrollbar();
        chart1.addChartScrollbar(chartScrollbar);

        chart1.creditsPosition = "bottom-right";

        // WRITE
        chart1.write("chartdivaño");
    });

            // this method is called when chart is first inited as we listen for "dataUpdated" event
    function zoomChart() {
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        chart1.zoomToDates(new Date(1972, 0), new Date(1984, 0));
    }

    var chart2;
    var graph;
    var chartData2 = [
    <?php 
        if(count($estadistica_dia) > 0)
        {
            $monto = "";
            foreach ($estadistica_dia as $row) 
            {
                $monto = $row->total_monto - $row->total_vuelto;
                ?>
                    {
                    "category": "<?php echo $row->dia; ?>",
                    "total": <?php echo $monto; ?>
                    },
                <?php

            }
        }
            
    ?>
    ];

    AmCharts.ready(function () {
        // SERIAL CHART2
        chart2 = new AmCharts.AmSerialChart();
        chart2.dataProvider = chartData2;
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

        chart2.write("chartdivdia");
    });

    $("#buscar_grafico_mes").click(function(){
        var año = $("#año_mes").val();
        if(año == "")
        {
            alert("Debe indicar el año en el que quiere ver las estadísticas de los meses");
            return false;
        }
        else
        {   
            
            $("#chartdivmes").html('');
            $("#section_mes").slideUp('slow/400/fast');
            $.getJSON('Caja_estadisticas/traer_graficos_mes',{año: año},function(data)
            {   
                    var x = 0;
                    var relleno = [];
                    var monto;
                        while(x < data.length)
                        {
                            monto = data[x].total_monto -  data[x].total_vuelto;
                            relleno.push({"category" : mes[data[x].mes -1], "total" : monto});
                            x = x + 1;
                        }
                    var chartData3 = relleno;
                    var chart3;
                    var graph3;

                        // SERIAL CHART3
                        chart3 = new AmCharts.AmSerialChart();
                        chart3.dataProvider = chartData3;
                        chart3.categoryField = "category";
                        chart3.startDuration = 1;

                        // AXES
                        // category
                        var categoryAxis = chart3.categoryAxis;
                        categoryAxis.labelRotation = 90;
                        categoryAxis.gridPosition = "start";

                        var valueAxis = new AmCharts.ValueAxis();
                            valueAxis.integersOnly = true;
                            chart3.addValueAxis(valueAxis);

                        // value
                        // in case you don't want to change default settings of value axis,
                        // you don't need to create it, as one value axis is created automatically.

                        // GRAPH3
                        var graph3 = new AmCharts.AmGraph();
                        graph3.valueField = "total";
                        graph3.balloonText = "[[category]]: <b>[[value]]</b>";
                        graph3.type = "column";
                        graph3.lineAlpha = 0;
                        graph3.fillAlphas = 0.8;
                        chart3.addGraph(graph3);

                        // CURSOR
                        var chartCursor = new AmCharts.ChartCursor();
                        chartCursor.cursorAlpha = 0;
                        chartCursor.zoomable = false;
                        chartCursor.categoryBalloonEnabled = false;
                        chart3.addChartCursor(chartCursor);
                        chart3.creditsPosition = "top-right";
                        chart3.write("chartdivmes");

                    $("#section_mes").show('slow/400/fast');
                 
            });
        }
    });

    $("#buscar_grafico_dia").click(function(){
        var año = $("#año_dia").val();
        var mes = $("#mes_dia").val();
        if(año == "")
        {
            alert("Debe indicar el año en el que quiere ver las estadísticas de los dias");
            return false;
        }
        else if(mes == "")
        {
            alert("Debe indicar el mes en el que quiere ver las estadísticas de los dias");
            return false;   
        }
        else
        {
            $("#chartdivdia").html('');
            $("#section_dia").slideUp('slow/400/fast');
            $.getJSON('Caja_estadisticas/traer_graficos_dias',{año: año, mes: mes},function(data)
            {
                var chart4;
                var graph4;
                var monto;
                var relleno = []; 
                var chartData4
                var x = 0;

                    while(x < data.length)
                    {
                        monto = data[x].total_monto -  data[x].total_vuelto;
                        relleno.push({"category" : data[x].dia, "total" : monto});
                        x = x + 1;
                    }
                
                    chartData4 = relleno;
                    // SERIAL CHART2
                    chart4 = new AmCharts.AmSerialChart();
                    chart4.dataProvider = chartData4;
                    chart4.categoryField = "category";
                    chart4.startDuration = 1;

                    // AXES
                    // category
                    var categoryAxis = chart4.categoryAxis;
                    categoryAxis.labelRotation = 90;
                    categoryAxis.gridPosition = "start";

                    var valueAxis = new AmCharts.ValueAxis();
                        valueAxis.integersOnly = true;
                        chart4.addValueAxis(valueAxis);


                    // value
                    // in case you don't want to change default settings of value axis,
                    // you don't need to create it, as one value axis is created automatically.

                    // GRAPH4
                    var graph4 = new AmCharts.AmGraph();
                    graph4.valueField = "total";
                    graph4.balloonText = "[[category]]: <b>[[value]]</b>";
                    graph4.type = "column";
                    graph4.lineAlpha = 0;
                    graph4.fillAlphas = 0.8;
                    chart4.addGraph(graph4);

                    // CURSOR
                    var chartCursor = new AmCharts.ChartCursor();
                    chartCursor.cursorAlpha = 0;
                    chartCursor.zoomable = false;
                    chartCursor.categoryBalloonEnabled = false;
                    chart4.addChartCursor(chartCursor);

                    chart4.creditsPosition = "top-right";

                    chart4.write("chartdivdia");
            });   

            $("#section_dia").slideDown('slow/400/fast');
        }   
    });
});
</script>
