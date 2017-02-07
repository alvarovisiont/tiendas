
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
    <script src="./js/sweetalert2.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>
    <script src='./js/select2.min.js'></script>
    <!-- Morris Charts JavaScript -->
    <script src="./js/raphael.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        $("#proveedores").select2();
        $("#articulos").select2();

        $("#proveedores").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url().'Compras/traer_articulos'; ?>",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data)
                {
                    if(typeof(data.fallo) == "undefined")
                    {
                        var filas = "<option></option>";
                        $.each(data, function(i, e)
                        {
                            filas += "<option value='"+e.id+"'>"+e.nombre+"</option>";
                        });
                        $("#articulos").html('');
                        $("#articulos").html(filas);

                        var tabla = "<table class='table table-streped table-hover' id='tabla_modal'><thead><th class='text-center'>Nombre</th><th class='text-center'>Marca</th><th class='text-center'>Precio_Proveedor</th><th class='text-center'>Stock</th></thead><tbody class='text-center'></tbody></table>";

                        $("#div_tabla").html('');
                        $("#div_tabla").html(tabla);

                        var filas_tabla = "" ;
                        $.each(data, function(i,e)
                        {
                            filas_tabla += "<tr class='alert alert-danger'><td>"+e.nombre+"</td><td>"+e.marca+"</td><td>"+e.precio_proveedor+"</td><td>"+e.cantidad+"</td></tr>";
                        });

                        $("#tabla_modal > tbody").html(filas_tabla);
                        $("#tabla_modal").dataTable({
                            "language" : {"url" : "json/esp.json"},
                            order: [3, 'asc']
                        });
                    }
                    else
                    {
                        $("#aviso").html('');
                        $("#aviso").show('slow/400/fast');
                        $("#aviso").html(data.fallo);
                        setTimeOut(function(){
                            $("#aviso").hide('fast');
                        }, 2000);
                    }
                }
            });
        });

        $("#articulos").change(function(event) {
            $("#cantidad").val('');
            $("#cantidad").focus();
        });

        $("#cantidad").keypress(function(e) {
            if(e.keyCode == 13)
            {
                $("#agregar_articulo").click();
            }
        });

        $("#agregar_articulo").click(function(){
            if($("#proveedores").val() == "")
            {
                alert('Debe seleccionar un proveedor para escoger un producto');
                return false;
            }
            else if($("#articulos").val() == "")
            {
                alert('Debe seleccionar un artículo para agregar a la lista');
                return false;   
            }
            else if($("#cantidad").val() == "")
            {
                alert('Debe seleccionar la cantidad que desea comprar');
                return false;      
            }
            else
            {
                var proveedor = $("#proveedores").val(),
                    articulo = $("#articulos").val(),
                    cantidad = $("#cantidad").val();


                $.ajax({
                    url: "<?php echo base_url().'Compras/agregar_tabla'; ?>",
                    type: "POST",
                    data: {id_proveedor : proveedor, id_articulo : articulo, cantidad : cantidad, },
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(typeof(data.fallo) == "undefined" && typeof(data.repetido) == "undefined")
                        {
                            //Si llega respuesta se agrega el artículo a la tabla y se muestra el precio a cancelar--------------------------------
                             var total_pagar = $("#sub-total").text();
                             var iva_calculado;
                             var iva_total_pagar;
                             var total = cantidad * data[0].precio_proveedor;
                            if(total_pagar == "")
                            {
                                total_pagar = 0;
                            }
                            total_pagar = parseInt(total_pagar) + parseInt(total);
                            $("#sub-total").text(total_pagar);

                            var total_pagar_total = $("#total").text();
                            if(total_pagar_total == "")
                            {
                                total_pagar_total = 0;
                            }

                            var iva_registrado = $("#iva").text();
                            if(iva_registrado == "")
                            {
                                iva_registrado = 0;
                            }

                            if(data[0].iva == 0)
                            {   
                                iva_calculado = data[0].iva / 100;
                                iva_total_pagar = iva_registrado;
                                $("#iva").text(iva_total_pagar);
                                total_pagar_total = parseInt(total_pagar) + parseInt(iva_total_pagar);
                                $("#total").text(total_pagar_total+" <?php echo $this->session->userdata('siglas'); ?>");
                            }
                            else
                            {
                                iva_calculado = data[0].iva / 100;
                                var iva_recalculado = Math.round(parseInt(total) * iva_calculado);
                                    iva_total_pagar = parseInt(iva_registrado) + iva_recalculado;
                                $("#iva").text(iva_total_pagar);

                                total_pagar_total = parseInt(total_pagar) + parseInt(iva_total_pagar);
                                $("#total").text(total_pagar_total+" <?php echo $this->session->userdata('siglas'); ?>");
                            }
                            
                            var filas = "<tr class='alert alert-info'><td class='nombre_articulo'>"+data[0].nombre+"</td><td>"+data[0].marca+"</td><td>"+data[0].precio_proveedor+"</td><td>"+data[0].nombre_proveedor+"</td><td>"+cantidad+"</td><td class='cantidad'>"+total+"</td><td><a href='#' title='quitar' class='quitar' data-iva ='"+iva_calculado+"'><i class='fa fa-remove'></i></a></td></tr>";
                            $("#tabla_articulos > tbody").append(filas);
                             
                            $("#section_pagar_oculto").show('slow/400/fast');
//------------------------------------------------------------------------------------------------------------------------------

//La funcion que se ejecutara al pulsar en la x de remover el artículo----------------------------------------------------

                            $("#tabla_articulos > tbody").on('click', 'tr .quitar', function(){
                                if(parseInt($("#total").text()) == total_pagar_total)
                                {
                                    var iva = $(this).data().iva;
                                    $(this).parent().parent().remove();

                                    var cantidad_pagar_articulo = parseInt($(this).parent().siblings(".cantidad").text());
                                    var cantidad_total_pagar = parseInt($("#total").text());
                                    var iva_flotante = cantidad_pagar_articulo * iva;
                                    var iva_nuevo = parseInt($("#iva").text()) - iva_flotante;
                                    var sub_total_nuevo = parseInt($("#sub-total").text()) - cantidad_pagar_articulo;
                                    var nueva_cantidad_total = cantidad_total_pagar - cantidad_pagar_articulo - iva_flotante;
                                    $("#sub-total").text('');
                                    $("#sub-total").text(sub_total_nuevo);
                                    $("#iva").text('');
                                    $("#iva").text(iva_nuevo);
                                    $("#total").text('');
                                    $("#total").text(nueva_cantidad_total);
                                    total_pagar_total = nueva_cantidad_total;

                                //Lo siguiente es para eliminar el artículo de la tabla del detalle de la compra-----

                                    var nombre_articulo_eliminar = $(this).parent().siblings(".nombre_articulo").text();
                                    $.post("<?php echo base_url().'Compras/eliminar_articulo'; ?>",{nombre: nombre_articulo_eliminar});
                                //-------------------------------------------------------------------------------

                                    var total_filas = 0;
                                    $("#tabla_articulos > tbody > tr").each(function(){
                                        total_filas = parseInt(total_filas) + 1;
                                    });
                                    
                                    if(total_filas == 0)
                                    {
                                        $("#section_pagar_oculto").hide('slow');
                                        $("#total").text("");
                                    }
                                }
                                     
                            });
                        }
                        else if(typeof(data.repetido) != "undefined")
                        {
                            $("#aviso").html('');
                            $("#aviso").show('slow/400/fast');
                            $("#aviso").html(data.repetido);
                            setTimeout(function(){
                                $("#aviso").hide('fast');
                            }, 2000);       
                        }
                    }
                });
            }
        });
        
        $("#registrar_compra").click(function(){
            var total = parseInt($("#total").text());
            $.ajax({
                url: "<?php echo base_url().'Compras/agregar_compra'; ?>",
                type: "POST",
                data: {accion: "agregar", total : total},
                success: function()
                {
                    swal({
                        title: "Compra agregada con éxito",
                        type: "success",
                        showButtonCancel: false,
                        confirmButtonClass: "btn btn-primary",
                        confirmButtonText: "Listo",
                        closeOnConfirm: true
                    },function(confirm){
                        $("#imprimir_factura").prop('disabled', false);
                        $("#agregar_articulo").prop('disabled', true);
                        $("#registrar_compra").prop('disabled', true);
                        $("#tabla_articulos > tbody").children("tr").children("td").children(".quitar").prop('disabled', true);
                    });
                }
            });
        });

        $("#imprimir_factura").click(function(){
            if($(this).prop('disabled') == true)
            {
                return false;
            }
            else
            {
                var ruta = $(this).data('ruta');
                window.open(ruta, '_blank');
            }
        });
    });
</script>