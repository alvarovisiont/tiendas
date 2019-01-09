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
    <script src='./js/dataTables.responsive.min.js'></script>
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

        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order : [1, 'desc'],
            responsive: true
        });

        $("#modal_detalle").on('show.bs.modal', function(e){
            
            var id = $(e.relatedTarget).data().id_venta;
            $.getJSON('<?php echo base_url()."Ventas_historial/traer_detalle"; ?>', {id_venta: id}, function(data)
            {
                var filas = "";
                var button = "";
                var id_cliente = "";
                $.each(data, function(i,e)
                {
                    id_cliente = e.id_venta;
                    let precio_dolar = formatNumber(e.precio / dolar_value,2,',','.')
                        iva_dolar = formatNumber(e.iva / dolar_value,2,',','.'),
                        sub_total_dolar = formatNumber(e.sub_total / dolar_value,2,',','.'),
                        total_dolar = formatNumber(e.total / dolar_value,2,',','.')

                    filas += "<tr><td>"+e.nombre_articulo+"</td><td>"+e.marca+"</td><td>"+formatNumber(e.precio,2,',','.')+siglas+" / <br/> "+precio_dolar+"$</td><td>"+e.cantidad+"</td><td>"+formatNumber(e.sub_total,2,',','.')+siglas+" / <br> "+sub_total_dolar+"$</td><td>"+formatNumber(e.iva,2,',','.')+siglas+"/ <br/> "+iva_dolar+"$</td><td>"+formatNumber(e.total,2,',','.')+siglas+" / <br/> "+total_dolar+"$</td><td>"+button+"</td>";
                });

                button = "<button class='btn btn-success btn-md' data-toggle='modal' data-target='#modal_clientes' data-id_cliente='"+id_cliente+"'>Ver Cliente&nbsp;<i class='fa fa-user'></i></button><button type='button' class='btn btn-primary' data-dismiss='modal'>cerrar&nbsp;&nbsp;<i class='fa fa-remove'></i></button>";
                $("#tabla_detalle tbody").html('');
                $("#tabla_detalle tbody").html(filas);
                $("#modal_detalle").find(".modal-footer").html('');
                $("#modal_detalle").find(".modal-footer").html(button);

                $("#modal_clientes").on('show.bs.modal', function(e){
                    var id_buscar = $(e.relatedTarget).data().id_cliente;
                    $.getJSON('<?php echo base_url()."Ventas_historial/traer_cliente"; ?>',{id_buscar: id_buscar}, function(data){
                        var filas_clientes = "<tr><td>"+data.cedula+"</td><td>"+data.nombre+"</td><td><span class='badge' style='color: white; background-color: green; font-size: 12px'>"+data.telefono+"</span></td><td>"+data.direccion+"</td>";
                        $("#tabla_clientes tbody").html('');
                        $("#tabla_clientes tbody").html(filas_clientes);
                    });
                });
            }); 
        });

        $(".imprimir").click(function()
        {
            var ruta = $(this).data('ruta');
            window.open(ruta, '_blank');
        });
    });
</script>