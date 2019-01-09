
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
    <script src="./js/main.js"></script>

</body>

</html>
<script>
    $(function(){

        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: [3, "desc"]
        });

        $("#modal_articulos").on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data().id_venta;
            $.getJSON('<?php echo base_url()."Clientes/traer_articulos"; ?>', {id_venta: id}, function(data) 
            {
                if(typeof(data.fallido) == "undefined")
                {
                    var filas = "";
                    $.each(data, function(i,e)
                    {
                        filas += "<tr class='alert alert-warning'><td>"+e.nombre_articulo+"</td><td>"+e.marca+"</td><td>"+formatNumber(e.precio,2,',','.')+"</td><td>"+e.cantidad+"</td><td>"+formatNumber(e.sub_total,2,',','.')+"</td><td>"+e.iva+"</td><td>"+formatNumber(e.total,2,',','.')+"</td></tr>";
                    });
                    $("#tabla_articulos tbody").html('');
                    $("#tabla_articulos tbody").html(filas);
                }
            });
        });
    });
</script>