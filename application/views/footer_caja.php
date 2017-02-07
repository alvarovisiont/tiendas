
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
</body>
</html>
<script>
    $(function(){

        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: [1, "desc"]
        });

        $("#modal_detalle").on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data().id_venta;
            $.getJSON('<?php echo base_url()."Caja/detalles_venta";?>', {id_venta: id}, function(data)
            {
                if(typeof(data.fallido) == "undefined")
                {
                    var filas = "";
                    $.each(data, function(i, e){
                        filas += "<tr><td>"+e.nombre_articulo+"</td><td>"+e.marca+"</td><td>"+e.precio+"</td><td>"+e.cantidad+"</td><td>"+e.sub_total+"</td><td>"+e.iva+"</td><td><span class='label label-success letras'>"+e.total+"</span></td></tr>";
                    });
                    $("#tabla_detalle tbody").html('');
                    $("#tabla_detalle tbody").html(filas);
                }
                else
                {
                    $("#tabla_detalle tbody").html('');
                }
            });
        });

        $("#modal_cliente").on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data().id_venta;
            $.getJSON('<?php echo base_url()."Caja/detalles_cliente";?>', {id_venta: id}, function(data)
            {
                if(typeof(data.fallido) == "undefined")
                {
                    var filas = "<tr><td>"+data.nombre+"</td><td>"+data.cedula+"</td><td><span class='label label-success letras'>"+data.telefono+"</span></td><td>"+data.telefono+"</td></tr>";

                    $("#tabla_detalle_cliente tbody").html('');
                    $("#tabla_detalle_cliente tbody").html(filas);
                }
                else
                {
                    $("#tabla_detalle_cliente tbody").html('');
                }
            });
        });
    });
</script>