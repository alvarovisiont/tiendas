 
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="./js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>
    <script src='./js/jquery.dataTables.js'></script>
    <script src='./js/dataTables.bootstrap.js'></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./js/raphael.min.js"></script>
    <script src="./js/morris.min.js"></script>
    <script src="./js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="./js/main.js"></script>

</body>
</html>
<script>
  $(function(){
    $("table").dataTable({
        "language" : {"url" : "./json/esp.json"},
        "order": []
    });

    $('#btn_filter').click(function (e) {
       let desde = $('#desde').val(),
           hasta = $('#hasta').val(),
           worker = $('#worker').val(),
           span = $(this).children('#span_filter')
        
        span.text('Filtrando...')

        $.ajax({
          url: "<?= base_url().'index.php/Comisiones/get_registers_by_date' ?>",
          data : {desde,hasta,worker},
          type: "GET",
          dataType: "JSON",
          success: function(data){
            

            let individual = data.individual,
                grupal = data.grupal,
                tabla1 = $('#tabla'),
                tabla2 = $('#tabla_grupal'),
                html = "",
                html2= "",
                meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

            tabla1.DataTable().destroy()

            tabla1.dataTable({
              data: individual,
              columns: [
                {"data": "nombre_apellido"},
                {"data": "factura"},
                {"data": "porcentaje", "render" : function(porce){
                  return porce+" %"
                }},
                {"data": "monto", "render" : function(monto){
                  return `<span class='badge letras' style='background-color: #BC9427; color: white;'>${formatNumber(monto,2,',','.')} Bs.S</span>`
                }},
                {"data": "fecha1"},
                {"data": "type", "render" : function(type){
                  
                  let span = ""
                  
                  if(type === "debito"){
                    span="<span class='badge letras' style='background-color: darkred; color: white; font-size: 16px;''>"+type+"</span>";
                  }else{
                    span="<span class='badge' style='background-color: #337ab7; color: white; font-size: 16px;'>"+type+"</span>";
                  }

                  return span
                }}
              ]
            })

            tabla2.DataTable().destroy()

            tabla2.dataTable({
              data: grupal,
              columns: [
                {"data": "nombre_apellido"},
                {"data": "total_nuevo", "render": function (total) {
                  return `<span class='badge letras' style='background-color: #BC9427; color: white;'>${formatNumber(total,2,',','.')}</span>`
                }},
                {"data": "mes", "render" : function (mes) {
                  return meses[mes - 1]
                }},
                {"data": "año"},
              ]
            })

            span.text('Filtrar')
            $('#modal_filtros').modal('hide')
          }
        })
    })

  });


  $("#exportar_pdf_bss").click(function(){
    var ruta = $(this).data('ruta');
    window.open(ruta, "_blank");
  });
  
</script>
