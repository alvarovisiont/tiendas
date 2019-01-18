
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
    <!-- Custom Theme JavaScript -->
    <script src="./js/main.js"></script>
</body>
</html>
<script type="text/javascript">
$(function(){

    function format2(n) {
        return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
    }

    var tipo_venta = false,
        total_total = 0,
        total_formateado = false,
        iva_limpio = 0,
        sub_total_limpio = 0,
        dolar_value = parseFloat(<?= $config->dolar_value ?>),
        iva_conf = parseInt(<?= $config->iva ?>),
        porcentaje_efectivo = 0,
        porcentaje_debito = 0,
        porcentaje_visa = 0,
        id_descuento_debito = null,
        id_descuento_efectivo = null,
        id_descuento_visa = null

    

    <?php
      foreach ($descuentos as $row) {
        if($row->nombre === "Descuento Debito"){
          ?> 
            porcentaje_debito = parseFloat(<?php echo $row->cantidad; ?>)
            id_descuento_debito = parseFloat(<?php echo $row->id; ?>)
          <?php
        }else if($row->nombre === "Descuento Efectivo"){
          ?> 
            porcentaje_efectivo = parseFloat(<?php echo $row->cantidad; ?>)
            id_descuento_efectivo = parseFloat(<?php echo $row->id; ?>)
          <?php
        }else if($row->nombre === "Descuento Visa"){
          ?> 
          porcentaje_visa = parseFloat(<?php echo $row->cantidad; ?>)
          id_descuento_visa = parseFloat(<?php echo $row->id; ?>)
          <?php
        }
      }
    ?>


    $("#tabla_clientes").dataTable({
        "language" : {"url" : "json/esp.json"},
        order: [0, 'asc']
    });

    $("#tabla_empleados").dataTable({
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
            alert("Debe ingresar la cédula,teléfono o nombre del cliente que desea buscar");
        }
        else
        {
            let isString = 2
            $("#barra_oculta").show('slow/400/fast');
            if(isNaN(x)){
                isString = 1
            }

            $.ajax({
                url: "<?php echo base_url().'Ventas/buscar_clientes'; ?>",
                type: "POST",
                data: {cedula : x, isString},
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

    $("#tabla_articulos tbody").on('click', 'tr .escoger_producto', function(){

        let name = $(this).data('nombre')

        $('#nombre_articulo').val(name)
        $("#cantidad").focus();
        $("#falta_dinero").hide('slow/400/fast');
        $('#mod_buscar_articulos').modal('hide')

    });

     $("#nombre_articulo" ).autocomplete({
            source: function(request, response)
            {
                $.ajax({
                    url : "<?php echo base_url().'Ventas/traer_articulos'; ?>",
                    type: "POST",
                    dataType: "JSON",
                    data: {art : request.term.toUpperCase()},
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
                            iva_calculado = iva_conf / 100,
                            iva = (sub_total * iva_calculado),
                            total = (parseFloat(sub_total) + parseFloat(iva));
                            total_total = total_total + total;
                            total_pagar = total_total
                            if(total_pagar === 0)
                            {
                                total_pagar = parseFloat(total);
                            }

                            sub_total_limpio = parseFloat(sub_total) + parseFloat(sub_total_limpio)
                            iva_limpio = parseFloat(iva_limpio) + parseFloat(iva)

                            sub_total = formatNumber(sub_total,2,',','.');
                            iva = formatNumber(iva,2,',','.');
                            let total1 = formatNumber(total,2,',','.');
                            total_pagar = formatNumber(total_pagar,2,',','.');



                        var filas = "<tr><td class='nombre'>"+data.nombre+"</td><td>"+data.marca+"</td><td>"+data.precio+"</td><td>"+cantidad+"</td><td>"+sub_total+"</td><td>"+iva+"</td><td class='total'>"+total1+"</td><td><button type='button' class='btn btn-danger eliminar_articulo' data-total='"+total+"'><i class='fa fa-remove'></i></button></td></tr>";

                        $("#section_registrar").show('slow/400/fast');
                        $("#tabla_productos tbody").append(filas);
                        $("#nombre_articulo").val('');
                        $("#cantidad").val('');
                        $("#nombre_articulo").focus();

                        //definir el total a pagar-----------------------

                        $("#total span").text(total_pagar);
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

            var total_span = total_total
            var total_restar = $(this).data('total');
            var nuevo_total_pagar = "";

            total_total = parseFloat(total_total) - parseFloat(total_restar);

            nuevo_total_pagar = parseFloat(total_span) - parseFloat(total_restar);

            var nombre_articulo_eliminar = $(this).parent().siblings('.nombre').text();

            $(this).parent().parent().remove();

            nuevo_total_pagar = formatNumber(nuevo_total_pagar,2,',','.');
            
            $("#total span").text(nuevo_total_pagar);

            $.post("<?php echo base_url().'Ventas/eliminar_articulo'; ?>",{nombre: nombre_articulo_eliminar});

            var total_filas = 0;
            $("#tabla_productos > tbody > tr").each(function(){
                total_filas = parseInt(total_filas) + 1;
            });
            
            if(total_filas == 0)
            {
                $("#section_registrar").hide('slow');
                $("#monto_pago").val('')
                hide_sections_payment_method(1)
                $("input[name='metodo_pago']").prop('checked',false)
            }

            $('#falta_dinero').hide()
    });

    $("#monto_pago").keyup(function(){
        $("#grabar_compra").prop('disabled', false);
    });

    $('#aplicar_descuento').click(function(e){
      
      var validate = false
      var metodo   = ""

      $("input[name='metodo_pago']").each(function(e){
        if($(this).is(':checked')){
          validate = true
          metodo = $(this).val()
        }
      })  

      if($(this).is(':checked')){
        if(validate){
          calculate_discount(metodo,null)
        }
      }else{
        console.log('aquii4444')
        calculate_discount(metodo,null)
      }
        

    })

    $("input[name='metodo_pago']").click(function(){
        val = $(this).val();

      if(val === "efectivo"){
        hide_sections_payment_method(1)
        calculate_discount("efectivo",null)
      }else if(val === "debito"){
        $('#section_debito').show()
        hide_sections_payment_method(2)
        calculate_discount("debito",null)
      }else if(val === "visa"){
        hide_sections_payment_method(5)
        calculate_discount("visa",null)
      }else if(val === "mixto"){
        $('#section_mixto').show()
        hide_sections_payment_method(3)
        calculate_discount("mixto",null)
      }else{
        $('#section_trans').show()
        $('#monto_pago').val(total_total)
        hide_sections_payment_method(4)
        calculate_discount("transferencia",null)
      }

    });

    function hide_sections_payment_method(type){
      type = parseInt(type)
      if(type === 1){
        $('#section_trans').hide()
        $('#section_debito').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').hide()
      }else if(type === 2){
        $('#section_trans').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').hide()
        $("#grabar_compra").prop('disabled', false);
      }else if(type === 3){
        $('#section_debito').hide()
        $('#section_trans').hide()
        $('#section_dolar_cancelar').hide()
      }else if(type === 4){
        $('#section_debito').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').hide()
        $("#grabar_compra").prop('disabled', false);
      }else if(type === 5){
        $('#section_trans').hide()
        $('#section_debito').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').show()
      }
    }

    function calculate_discount(type,validate){
      let isDiscountActive = $('#aplicar_descuento').is(':checked')
      console.log(isDiscountActive,'aqui la mamaguebada')
      if(type === "efectivo"){
        
        if(isDiscountActive){

          var total_span,
              porcentaje = 0;
          porcentaje = (total_total * porcentaje_efectivo) / 100;
          total_span = parseFloat(total_total) - parseFloat(porcentaje);

          if(!validate){
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,porcentaje,id_descuento_efectivo];
          }

        }else{
          return [total_span,porcentaje,id_descuento_efectivo];
        }

      }else if(type === "visa"){

        if(isDiscountActive){
          var total_span,
              porcentaje = 0,
              total_dolar = 0
          porcentaje = (total_total * porcentaje_visa) / 100;
          total_span = parseFloat(total_total) - parseFloat(porcentaje);
          
          total_dolar  = parseFloat(total_span) / dolar_value

          if(!validate){
            $('#dolares_cancelar').val(total_dolar)
            $('#monto_pago').val('')

            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_total,null,id_descuento_visa];
          }
        }else{
          let total_dolar = parseFloat(total_total) / dolar_value
          if(!validate){
            $('#dolares_cancelar').val(total_dolar)
            $('#monto_pago').val('')
          }else{
            return [total_total,null,id_descuento_visa];
          }
        }
          

      }else if(type === "debito"){
        if(isDiscountActive){

          var total_span,
              porcentaje = 0;
          porcentaje = (total_total * porcentaje_debito) / 100;
          total_span = parseFloat(total_total) - parseFloat(porcentaje);
          if(!validate){
            $('#monto_pago').val(total_span)
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,porcentaje,id_descuento_debito];
          }

        }else{
          if(!validate){
            $('#monto_pago').val(total_total)
            $("#total span").text(formatNumber(total_span,2,',','.'));
          }else{
           return [total_total,null,id_descuento_debito]; 
          }
        }
          

      }else{
        $("#total span").text(formatNumber(total_total,2,',','.'));
        return [total_total,porcentaje,null];
      }
        
    }

    $("#form_agregar_compra").submit(function(e)
    {
        e.preventDefault()

        var total_pagar = total_total,
        monto_pagado = $("#monto_pago").val(),
        monto_pagado_limpio = monto_pagado,
        metodo_pago  = '',
        monto_pagado_dolares = parseFloat($('#monto_dolares').val()),
        siglas = " Bs.S",
        descuento = 0

        $("input[name='metodo_pago']").each(function(e){
          if($(this).is(':checked')){
            metodo_pago =  $(this).val()
          }
        })

        if(metodo_pago === "visa"){
          monto_pagado = parseFloat(monto_pagado) * parseFloat(dolar_value)
          siglas = " $";

        }else if(metodo_pago === "mixto"){
          let dolar_to_bs = monto_pagado_dolares * dolar_value
          monto_pagado = parseFloat(monto_pagado) + dolar_to_bs
        }

        var total_pagar_descuento = calculate_discount(metodo_pago,true),
            id_descuento = total_pagar_descuento[2]

        total_pagar = total_pagar_descuento[0]
        descuento = total_pagar_descuento[1]

        $('#descuento_value').val(descuento)
        $('#id_descuento').val(id_descuento)

        if(parseFloat(monto_pagado) < parseFloat(total_pagar))
        {
          let monto = 0

          if(metodo_pago === "visa"){
          
            let dolar_total_pagar = parseFloat(total_pagar) / dolar_value
            monto = dolar_total_pagar - monto_pagado_limpio
          
          }else if(metodo_pago === "mixto"){
            monto = parseFloat(total_pagar) - parseFloat(monto_pagado);
          }else{
            monto = parseFloat(total_pagar) - parseFloat(monto_pagado);
          }

            monto = formatNumber(monto,2,',','.');
            $("#falta_dinero").html('');
            $("#falta_dinero").show('slow/400/fast');
            $("#falta_dinero").text('La cantidad de dinero es insuficiente, restante por pagar: ' + monto+siglas);
            return false;
        }
        else
        {
            var vuelto = parseFloat(monto_pagado) - parseFloat(total_pagar);
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
                            var monto = parseFloat(monto_pagado) - parseFloat(total_pagar);

                            if(metodo_pago === "visa"){
                                monto = monto / dolar_value
                            }

                            monto = formatNumber(monto,2,',','.');
                            $("#monto_suficiente").html('');
                            $("#monto_suficiente").show('slow/400/fast');
                            $("#monto_suficiente").html('total vuelto: ' + monto+siglas);    
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
        $("#form_agregar_compra")[0].reset();
        $("#tabla_productos tbody").html('');
        $("#grabar_compra").prop('disabled');
        $("#imprimir_factura").hide();
        $("#total span").html('');
        $("#monto_suficiente").html('').hide();
        $("#falta_dinero").html('');
        $("#boton_agregar_tabla").prop('disabled', false)
        $('#cliente_encargado').text('')
        total_total = 0;
        hide_sections_payment_method(1)
    });

});
</script>