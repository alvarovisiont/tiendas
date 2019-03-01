
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
    <!-- Custom Theme JavaScript -->
    <script src="./js/main.js"></script>
    <script src="./js/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="./js/amcharts/serial.js" type="text/javascript"></script>
</body>
</html>
<script type="text/javascript">
    $(function(){
        var sub_total_limpio = 0;
        var total_limpio = 0;
        var iva_limpio = 0;

        $("#proveedores").select2();
        $("#articulos").select2();

        function format2(n) {
            return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
        }
        
        function quitar_siglas(num)
        {
            var numero = "";
            var array_pagar = [];

            array_pagar = num.split(",");
            for (var i = 0; i < array_pagar.length; i++)
            {
                //ciclo para quitar las comas del formato

                if(array_pagar[i].indexOf('B') != -1)
                {
                    var posicion = (array_pagar[i].indexOf('B'));
                    var cadena = array_pagar[i].substring(0,posicion -1);
                    numero += cadena
                }
                else
                {
                    numero += array_pagar[i];
                }
            }

            return numero;
        }
                

        $("#proveedores").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url().'Compras/traer_articulos'; ?>",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data)
                {
                    if(typeof(data.fallo) == "undefined" && typeof(data.vacio) == "undefined")
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
                        
                        $("#articulos").select2("val", "");
                        $("#articulos").html('')
                        var text = data.fallo ? data.fallo : data.vacio

                        $("#aviso").html('');
                        $("#aviso").show('slow/400/fast');
                        $("#aviso").html(text);
                        setTimeout(function(){
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
                             var sub_total = sub_total_limpio
                             var iva_calculado = 0;
                             var iva_total_pagar;
                             var total = cantidad * data[0].precio_proveedor;
                            
                            sub_total = parseFloat(sub_total) + parseFloat(total);

                            var total_pagar_total = total_limpio
                            console.log(total_limpio,'total fresco')

                            var iva_registrado = iva_limpio

                            if(data[0].iva == 0)
                            {   
                                iva_total_pagar = iva_registrado;
                                total_pagar_total = parseFloat(sub_total) + parseFloat(iva_total_pagar);
                                
                                console.log(total_pagar_total,'total pagar')
                                console.log(sub_total,'sub_total pagar')

                                total_limpio = total_pagar_total

                                console.log(total_limpio,'total limpio de nuevo')

                                iva_limpio = iva_total_pagar
                                sub_total_limpio = sub_total

                                iva_total_pagar = formatNumber(parseFloat(iva_total_pagar),2,',','.');

                                sub_total = formatNumber(sub_total,2,',','.');
                                iva_total_pagar = formatNumber(iva_total_pagar,2,',','.')
                                total_pagar_total = formatNumber(total_pagar_total,2,',','.')
                                
                                $("#iva").text(iva_total_pagar);
                                $("#sub-total").text(sub_total);
                                $("#total").text(total_pagar_total);
                            }
                            else
                            {
                                iva_calculado = data[0].iva / 100;
                                var iva_recalculado = parseFloat(total) * parseFloat(iva_calculado);
                                
                                iva_total_pagar = parseFloat(
                                    iva_registrado) + iva_recalculado;

                                total_pagar_total = parseFloat(sub_total) + parseFloat(iva_total_pagar);

                                total_limpio = total_pagar_total
                                iva_limpio = iva_total_pagar
                                sub_total_limpio = sub_total

                                sub_total = formatNumber(sub_total,2,',','.');
                                iva_total_pagar = formatNumber(iva_total_pagar,2,',','.')
                                total_pagar_total = formatNumber(total_pagar_total,2,',','.')
                                
                                $("#iva").text( iva_total_pagar );
                                $("#sub-total").text(sub_total);
                                $("#total").text( total_pagar_total );
                            }
                            
                            var filas = "<tr class='alert alert-info'><td class='nombre_articulo'>"+data[0].nombre+"</td><td>"+data[0].marca+"</td><td>"+formatNumber(parseFloat(data[0].precio_proveedor),2,',','.')+"</td><td>"+data[0].nombre_proveedor+"</td><td>"+cantidad+"</td><td class='cantidad'>"+formatNumber(parseFloat(total),2,'.',',')+"</td><td><a href='#' title='quitar' class='quitar' data-iva ='"+parseFloat(iva_calculado)+"' data-total='"+parseFloat(parseFloat(total))+"'><i class='fa fa-remove'></i></a></td></tr>";
                            $("#tabla_articulos > tbody").append(filas);
                             
                            $("#section_pagar_oculto").show('slow/400/fast');
//------------------------------------------------------------------------------------------------------------------------------
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

//La funcion que se ejecutara al pulsar en la x de remover el artículo----------------------------------------------------

        $("#tabla_articulos > tbody").on('click', 'tr .quitar', function(){
                
                var iva = $(this).data().iva;
                var cantidad_pagar_articulo = $(this).data().total;
                
                $(this).parent().parent().remove();
                

                var cantidad_total_pagar = total_limpio;
                    

                var iva_flotante = cantidad_pagar_articulo * iva;
                var iva_anterior = iva_limpio;
                    
                var iva_nuevo = parseFloat(iva_anterior) - parseFloat(iva_flotante);
                iva_limpio = iva_nuevo
                iva_nuevo = formatNumber(iva_nuevo,2,',','.');

                var sub_total = sub_total_limpio;

                var sub_total_nuevo = parseFloat(sub_total) - parseFloat(cantidad_pagar_articulo);
                sub_total_limpio = sub_total_nuevo

                sub_total_nuevo = formatNumber(sub_total_nuevo,2,',','.');
        

                var nueva_cantidad_total = parseFloat(cantidad_total_pagar) - parseFloat(cantidad_pagar_articulo) - parseFloat(iva_flotante);
                
                total_limpio = nueva_cantidad_total

                console.log(total_limpio,'nuevo total')

                nueva_cantidad_total = formatNumber(nueva_cantidad_total,2,',','.');
                
                $("#sub-total").text('');
                $("#sub-total").text(sub_total_nuevo);
                $("#iva").text('');
                $("#iva").text(iva_nuevo);
                $("#total").text('');
                $("#total").text(nueva_cantidad_total);

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
                $(this).prop('disabled', true);
                $("#articulos").empty();
                $("#cantidad").val('');
                $("#tabla_articulos").children('tbody').empty();
                $("#sub-total").empty();
                $("#iva").empty();
                $("#total").empty();
                $("#section_pagar_oculto").hide('slow/400/fast');
            }
        });
    });
</script>