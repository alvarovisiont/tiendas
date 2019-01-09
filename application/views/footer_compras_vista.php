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

    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="./js/main.js"></script>

</body>

</html>
<script type="text/javascript">
    $(function(){

        var dolar_value = parseFloat(<?= $conf->dolar_value ?>)
        var siglas = "<?= $conf->siglas ?>"

        $("#tabla1").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: [1, "desc"]
        });

        $("#ver_detalle").on('show.bs.modal', function(e){
            var id = $(e.relatedTarget).data().id;
            $.ajax({
                url: "<?php echo base_url().'Compras_vista/ver_detalle'; ?>",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data)
                {
                    var tabla = "<table class='table table-streped table-hover' id='tabla_detalle'><thead><th class='text-center'>Nombre_Artículo</th><th class='text-center'>Marca</th><th class='text-center'>Costo</th><th class='text-center'>Proveedor</th><th class='text-center'>Cantidad</th><th class='text-center'>Sub-Total</th><th class='text-center'>Iva</th><th class='text-center'>Total</th></thead><tbody class='text-center'></tbody></table>";

                    $("#div_tabla").html('');
                    $("#div_tabla").html(tabla);
                    var filas_tabla = "";
                    $.each(data, function(i,e)
                    {
                        let sub_total_dolar = formatNumber(parseFloat(e.sub_total) / parseFloat(dolar_value),2,',','.')
                        
                        let iva_dolar = formatNumber( parseFloat(e.iva) / parseFloat(dolar_value),',','.')
                        let total_dolar = formatNumber( parseFloat(e.total) / parseFloat(dolar_value),2,',','.')

                        filas_tabla += "<tr><td>"+e.nombre_articulo+"</td><td>"+e.marca+"</td><td>"+e.costo+"</td><td>"+e.proveedor+"</td><td>"+e.cantidad+"</td><td>"+formatNumber(e.sub_total,2,',','.')+" "+siglas+" / <br/> "+sub_total_dolar+" $</td><td>"+formatNumber(e.iva,2,',','.')+" "+siglas+" / <br/> "+iva_dolar+" $</td><td><span  class='badge letras' style='background-color: darkred; color: white;'>"+formatNumber(e.total,2,',','.')+" "+siglas+" / <br/> "+total_dolar+" $</span></td></tr>";
                    });
                    $("#tabla_detalle > tbody").html(filas_tabla);
                    $("#tabla_detalle").dataTable({
                        "language" : {"url" : "json/esp.json"},
                        order: [4, "desc"]
                    });
                }
            });
        });

        $(".imprimir_factura").click(function(){
            var id = $(this).data().id,
                ruta = $(this).data('ruta')+"/"+id;
                window.open(ruta, "_blank");
        });
    });
</script>