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
        var ruta_redirect = ""

        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order : [2, 'desc'],
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
                        total_dolar = formatNumber(e.total / dolar_value,2,',','.'),
                        vuelto_dolar = formatNumber(e.vuelto / dolar_value,2,',','.')

                    filas += "<tr><td>"+e.nombre_articulo+"</td><td>"+e.marca+"</td><td>"+formatNumber(e.precio,2,',','.')+siglas+" / <br/> "+precio_dolar+"$</td><td>"+e.cantidad+"</td><td>"+formatNumber(e.sub_total,2,',','.')+siglas+" / <br> "+sub_total_dolar+"$</td><td>"+formatNumber(e.iva,2,',','.')+siglas+"/ <br/> "+iva_dolar+"$</td><td>"+formatNumber(e.total,2,',','.')+siglas+" / <br/> "+total_dolar+"$</td><td>"+formatNumber(e.vuelto,2,',','.')+" "+siglas+" / <br>"+vuelto_dolar+"</td><td>"+button+"</td>";
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

        $('#tabla tbody').on('click','tr > td > .imprimir',function(e){
            var ruta = $(this).data('ruta');
            window.open(ruta, '_blank');
        })

        $('#tabla tbody').on('click','tr > td > .devolver',function(e){
          
          ruta_redirect = $(this).data('ruta')
          $('#modal_aviso').modal('show')
        })

        $('#dismiss_sell').click(function(e){
          window.location.href = ruta_redirect
        })

        $('#btn_filter').click(function (e) {
       let desde = $('#desde').val(),
           hasta = $('#hasta').val(),
           worker= $('#worker').val(),
           status  = $('#status').val(),
           span = $(this).children('#span_filter')
        
        span.text('Filtrando...')

        $.ajax({
          url: "<?= base_url().'index.php/Ventas_historial/get_registers_by_filter' ?>",
          data : {desde,hasta,worker,status},
          type: "GET",
          dataType: "JSON",
          success: function(data){
            
            
            let tabla1 = $('#tabla')

            tabla1.DataTable().destroy()

            tabla1.dataTable({
              order: [2,'desc'],
              data,
              columns: [
                {"data": "factura"},
                {"data": "fecha1"},
                {"data": "monto_pagado","render" : function(monto){
                  return formatNumber(monto,2,',','.')
                }},
                {"data": "tipo_venta"},
                {"data": {"data":"data"},"render" : function(login){
                  return login.login+"-"+login.usuario
                }},
                {"data": "id","render": function(id){
                    return `<button class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_detalle'
                        data-id_venta = '${id}'><i class='fa fa-search'></i></button>`
                }},
                {"data": "id","render": function(id){
                    return `<button class='btn btn-danger btn-sm imprimir'
                        data-ruta = '<?= base_url().'Ventas_historial/imprimir_factura/'?>${id}'><i class='fa fa-download'></i></button>`
                }},
                {"data": {"data":"data"},"render": function(id){
                    if(id.status == 0){
                        return "<span class='badge' style='background-color: #F28D62; font-size: 16px;'>Anulado</span>"   
                    }else{

                        return `<button class='btn btn-warning btn-sm devolver'
                            data-ruta = '<?=base_url().'Ventas/rollback/'?>${id}'><i class='fa fa-refresh'></i></button>`
                    }
                }}
              ]
            })

            span.text('Filtrar')
            $('#modal_filtros').modal('hide')
          }
        })
    })
    });
</script>