
        </div>
        <!-- /#page-wrapper -->
    </div>                       
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="./js/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>
    <script src='./js/jquery.dataTables.js'></script>
    <script src='./js/jquery-ui.min.js'></script>
    <script src='./js/dataTables.bootstrap.js'></script>
    <script src="./js/sweetalert2.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>
</body>
</html>
<script type="text/javascript">
$(function(){

    function format2(n) {
        return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }

    var tipo_venta = false,
        total_total = 0,
        total_formateado = false;

    $("#tabla_clientes").dataTable({
        "language" : {"url" : "json/esp.json"},
        order: [0, 'asc']
    });

    $("#tabla_articulos").dataTable({
        "language" : {"url" : "json/esp.json"},
        order: [3, 'asc']
    });

    $("#cedula_cliente").keyup(function(e){
        if(e.keyCode == 13)
        {
            $("#buscar_clientes").click();
        }
    });

    $("#buscar_clientes").click(function(){
        var x = $("#cedula_cliente").val();
        if(x == "")
        {
            alert("Debe ingresar la cédula del cliente que desea buscar");
        }
        else
        {
            $("#barra_oculta").show('slow/400/fast');

            $.ajax({
                url: "<?php echo base_url().'Ventas/buscar_clientes'; ?>",
                type: "POST",
                data: {cedula : x},
                dataType: "JSON",
                success: function(data)
                {
                    if(typeof(data.vacio) == "undefined")
                    {
                        $("#barra_oculta").slideUp('slow/400/fast');
                        $("#nombre_cliente").val(data.nombre);
                        $("#telefono_cliente").val(data.telefono);
                        $("#direccion_cliente").val(data.direccion);   
                    }
                    else
                    {
                        alert(data.vacio);
                        $("#barra_oculta").slideUp('slow/400/fast');
                        $("#nombre_cliente").val("");
                        $("#telefono_cliente").val("");
                        $("#direccion_cliente").val("");
                        $("#buscar_clientes").hide();
                        $("#nombre_cliente").focus();
                    }
                }
            });
        }
    });

    $("#tabla_clientes tbody").on('click', 'tr .escoger_cliente', function()
    {
        $("#cedula_cliente").val($(this).data('cedula'));
        $("#nombre_cliente").val($(this).data('nombre'));
        $("#telefono_cliente").val($(this).data('telefono'));
        $("#direccion_cliente").val($(this).data('direccion'));
        $("#mod_buscar_clientes").modal('hide');
    });

     $("#nombre_articulo" ).autocomplete({
            source: function(request, response)
            {
                $.ajax({
                    url : "<?php echo base_url().'Ventas/traer_articulos'; ?>",
                    type: "POST",
                    dataType: "JSON",
                    data: {art : request.term},
                    success: function(data)
                    {
                        response(data);
                    }
                });
            },
            minLenght: 1,
            select: function(e, ui)
            {
                $("#cantidad").focus();
                $("#falta_dinero").hide('slow/400/fast');
            }
      });

     $("#cantidad").keypress(function(event) {
         if(event.keyCode == 13)
         {
            $("#boton_agregar_tabla").click();
         }
     });

    $("#boton_agregar_tabla").click(function()
    {
        if($("#nombre_articulo").val() == "")
        {
            alert("Debe seleccionar un artículo para agregarlo a la tabla");
            return false;
        }
        else if($("#cantidad").val() == "")
        {
            alert("Debe seleccionar la cantidad a vender del artículo");
            return false;   
        }
        else
        {

            var articulo = $("#nombre_articulo").val(),
                cantidad = $("#cantidad").val();

            $.ajax({
                url: "<?php echo base_url().'Ventas/agregar_tabla'; ?>",
                type: "POST",
                dataType: "JSON",
                data: {articulo : articulo, cantidad: cantidad},
                success: function(data)
                {  
                    if(typeof(data.repetido) != "undefined")
                    {
                        $("#aviso").html('');
                        $("#aviso").html(data.repetido);
                        $("#aviso").show('slow/400/fast');
                        setTimeout(function(){
                            $("#aviso").hide();
                        }, 2000);
                        $("#nombre_articulo").val('');
                        $("#cantidad").val('');
                        $("#nombre_articulo").focus();
                    }
                    else if(typeof(data.nombre) != "undefined")
                    {
                        $("#falta_dinero").hide('slow/400/fast');

                        var sub_total = (data.precio * cantidad),
                            iva_calculado = data.iva / 100,
                            iva = (sub_total * iva_calculado),
                            total = (parseInt(sub_total) + parseInt(iva));
                            total_total = total_total + total;
                            total_pagar = $("#total span").text();
                            if(total_pagar == "")
                            {
                                total_pagar = 0;
                                total_pagar = parseInt(total_pagar) + parseInt(total);
                                total_pagar = format2(total_pagar);
                            }
                            else
                            {
                                var array_pagar = [];
                                array_pagar = total_pagar.split(",");
                                var numero = "";
                                var numero_resta;
                                for (var i = 0; i < array_pagar.length; i++)
                                {
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
                                numero_resta = parseInt(total);
                                total_pagar =  parseInt(numero) + parseInt(total);
                                total_pagar = format2(total_pagar);
                            }
                            sub_total = format2(sub_total);
                            iva = format2(iva);
                            total = format2(total);



                        var filas = "<tr><td class='nombre'>"+data.nombre+"</td><td>"+data.marca+"</td><td>"+data.precio+"</td><td>"+cantidad+"</td><td>"+sub_total+"</td><td>"+iva+"</td><td class='total'>"+total+"</td><td><button type='button' class='btn btn-danger eliminar_articulo'><i class='fa fa-remove'></i></button></td></tr>";
                        $("#section_registrar").show('slow/400/fast');
                        $("#tabla_productos tbody").append(filas);
                        $("#nombre_articulo").val('');
                        $("#cantidad").val('');
                        $("#nombre_articulo").focus();

                        //definir el total a pagar-----------------------

                        $("#total span").text(total_pagar+" <?php echo $this->session->userdata('siglas'); ?>");
                        //----------------------------------------------------
                    }
                    else if(typeof(data.inventario_insuficiente) != "undefined")
                    {
                        $("#aviso").html('');
                        $("#aviso").html(data.inventario_insuficiente);
                        $("#aviso").show('slow/400/fast');
                        setTimeout(function(){
                            $("#aviso").hide();
                        }, 2000);
                        $("#nombre_articulo").val('');
                        $("#cantidad").val('');
                        $("#nombre_articulo").focus();
                    }
                }
            });
        }
    });

    $("#tabla_productos tbody").on('click', 'tr td .eliminar_articulo', function(e){

        var comparacion = $("#total span").text().substring(0, $("#total span").text().indexOf('B') -1);        

        if(parseInt(comparacion) == parseInt(total_pagar))
        {
            var total_span = $("#total span").text();
            var total_restar = $(this).parent().siblings('.total').text();
            var nuevo_total_pagar = "";

            array_pagar = [];
            array_pagar = total_span.split(",");
            numero = "";
            for (var i = 0; i < array_pagar.length; i++)
            {
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

            total_span = numero;

            array_pagar = [];
            array_pagar = total_restar.split(",");
            numero = "";
            for (var i = 0; i < array_pagar.length; i++)
            {
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

            total_restar = numero;

            nuevo_total_pagar = parseInt(total_span) - parseInt(total_restar);

            var nombre_articulo_eliminar = $(this).parent().siblings('.nombre').text();

            $(this).parent().parent().remove();

            nuevo_total_pagar = nuevo_total_pagar;
            nuevo_total_pagar = format2(nuevo_total_pagar);
            
            $("#total span").text(nuevo_total_pagar+ " <?php echo $this->session->userdata('siglas'); ?>");

            total_pagar = nuevo_total_pagar;

            $.post("<?php echo base_url().'Ventas/eliminar_articulo'; ?>",{nombre: nombre_articulo_eliminar});

            var total_filas = 0;
            $("#tabla_productos > tbody > tr").each(function(){
                total_filas = parseInt(total_filas) + 1;
            });
            
            if(total_filas == 0)
            {
                $("#section_registrar").hide('slow');
            }
        }
    });

    /*$("#monto_pago").blur(function()
    {
        var total_pagar = parseInt($("#total span").text()),
            monto_pagado = $(this).val();
            if(monto_pagado < total_pagar)
            {
                var monto = parseInt(total_pagar) - parseInt(monto_pagado);
                $("#falta_dinero").html('');
                $("#falta_dinero").show('slow/400/fast');
                $("#falta_dinero").text('La cantidad de dinero es insuficiente, restante por pagar: ' + monto);
            }
            else if(monto_pagado == total_pagar)
            {
                $("#falta_dinero").hide();
                $("#monto_suficiente").html('');
                $("#monto_suficiente").show('slow/400/fast');
                $("#monto_suficiente").text('total vuelto: ' + 0); 
                $("#grabar_compra").prop('disabled', false);  
            }
            else
            {
                var monto = parseInt(monto_pagado) - parseInt(total_pagar);
                $("#monto_suficiente").html('');
                $("#monto_suficiente").show('slow/400/fast');
                $("#monto_suficiente").html('total vuelto: ' + monto);    
                $("#grabar_compra").prop('disabled', false);
            }
    });*/
    $("#monto_pago").keyup(function()
    {
        $("#grabar_compra").prop('disabled', false);
    });

    $("input[name='metodo_pago']").click(function(){
        val = $(this).val();
        console.log(val);

        if(val != "efectivo")
        {
            var total_span = $("#total span").text(),
                porcentaje = 0;

            array_pagar = [];
            array_pagar = total_span.split(",");
            numero = "";
            for (var i = 0; i < array_pagar.length; i++)
            {
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

            porcentaje = (numero * 2) / 100;
            total_span = parseInt(numero) - parseInt(porcentaje);
            total_span = format2(total_span);
            $("#total span").text(total_span+" <?php echo $this->session->userdata('siglas'); ?>");

            tipo_venta = true;
        }
        else
        {
            if(tipo_venta == true)
            {
                if(total_formateado == true)
                {
                    
                    array_pagar = [];
                    array_pagar = total_total.split(",");
                    numero = "";
                    for (var i = 0; i < array_pagar.length; i++)
                    {
                        if(array_pagar[i].indexOf('.') != -1)
                        {
                            var posicion = (array_pagar[i].indexOf('.'));
                            var cadena = array_pagar[i].substring(0,posicion);
                            numero += cadena
                        }
                        else
                        {
                            numero += array_pagar[i];
                        }
                    }
                    
                    total_total = format2(parseInt(numero));

                    $("#total span").text(total_total+" <?php echo $this->session->userdata('siglas'); ?>");

                 }
                 else
                 {
                    total_total = format2(total_total);
                    $("#total span").text(total_total+" <?php echo $this->session->userdata('siglas'); ?>");  
                    total_formateado = true;
                 }                    
            }
        }

    });

    $("#form_agregar_compra").submit(function(e)
    {
            var total_pagar = $("#total span").text(),
            monto_pagado = $("#monto_pago").val();

            array_pagar = [];
            array_pagar = total_pagar.split(",");
            numero = "";
            for (var i = 0; i < array_pagar.length; i++)
            {
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

            total_pagar = numero;

            if(monto_pagado < parseInt(total_pagar))
            {
                var monto = parseInt(total_pagar) - parseInt(monto_pagado);
                monto = format2(monto);
                $("#falta_dinero").html('');
                $("#falta_dinero").show('slow/400/fast');
                $("#falta_dinero").text('La cantidad de dinero es insuficiente, restante por pagar: ' + monto);
                return false;
            }
            else
            {
                var vuelto = parseInt(monto_pagado) - parseInt(total_pagar);
                $("#vuelto").val(vuelto);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: $(this).serialize(),
                    success: function()
                    {
                        swal({
                            title: "¡Venta Registrada con Éxito!",
                            type: "success",
                            showButtonCancel: false,
                            confirmButtonClass: "btn btn-primary",
                            confirmButtonText: "confirmar",
                            closeOnConfirm: true
                        },function(confirmar)
                        {
                            $("#form_agregar_compra").keypress(function(e){
                                if(e.keyCode == 13)
                                {
                                    return false;
                                }
                            });
                            if(monto_pagado == total_pagar)
                            {
                                $("#falta_dinero").hide();
                                $("#monto_suficiente").html('');
                                $("#monto_suficiente").show('slow/400/fast');
                                $("#monto_suficiente").text('total vuelto: ' + 0); 
                                $("#grabar_compra").prop('disabled', true);  
                            }
                            else
                            {
                                $("#falta_dinero").hide();
                                var monto = parseInt(monto_pagado) - parseInt(total_pagar);
                                monto = format2(monto);
                                $("#monto_suficiente").html('');
                                $("#monto_suficiente").show('slow/400/fast');
                                $("#monto_suficiente").html('total vuelto: ' + monto);    
                                $("#grabar_compra").prop('disabled', true);
                            }

                            $("#imprimir_factura").show('slow/400/fast');

                            $("#tabla_productos").children("tbody").children("tr").children("td").children(".eliminar_articulo").prop('disabled', true);
                            $("#grabar_compra").prop('disabled', true);
                            $("#boton_agregar_tabla").prop('disabled', true)
                        });
                    }
                });
                return false;
            }
    });

    $("#imprimir_factura").click(function(){
        var ruta = $(this).data('ruta');

        window.open(ruta, '_blank');
    });

});
</script>