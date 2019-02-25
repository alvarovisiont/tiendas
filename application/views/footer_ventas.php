
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


    var tipo_venta = false,
        total_total = 0,
        total_respaldo = 0 , // variable para tener el total y devolverlo a total_total en caso que el descuento no se quiera aplicar
        total_formateado = false,
        iva_limpio = 0,
        iva_respaldo = 0,
        sub_total_limpio = 0,
        sub_total_respaldo = 0,
        dolar_value = parseFloat(<?= $config->dolar_today ?>),
        iva_conf = parseInt(<?= $config->iva ?>),
        porcentaje_efectivo = 0,
        porcentaje_debito = 0,
        porcentaje_visa = 0,
        id_descuento_debito = null,
        id_descuento_efectivo = null,
        id_descuento_visa = null,
        id_descuento_transferencia = null,
        porcentaje_transferencia = null,
        mixto1 = "",
        mixto2 = ""

    

    <?php
      foreach ($descuentos as $row) {
        if($row->tipo == 1){
          ?> 
            porcentaje_debito = parseFloat(<?php echo $row->cantidad; ?>)
            id_descuento_debito = parseFloat(<?php echo $row->id; ?>)
          <?php
        }else if($row->tipo == 3){
          ?> 
            porcentaje_efectivo = parseFloat(<?php echo $row->cantidad; ?>)
            id_descuento_efectivo = parseFloat(<?php echo $row->id; ?>)
          <?php
        }else if($row->tipo == 2){
          ?> 
          porcentaje_visa = parseFloat(<?php echo $row->cantidad; ?>)
          id_descuento_visa = parseFloat(<?php echo $row->id; ?>)
          <?php
        }else if($row->tipo == 4){
          ?>
          porcentaje_transferencia = parseFloat(<?php echo $row->cantidad; ?>)
          id_descuento_transferencia = parseFloat(<?php echo $row->id; ?>)
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

    function igualar_respaldo () {
      // body... 
      total_respaldo = total_total
      iva_respaldo = iva_limpio
      sub_total_respaldo = sub_total_limpio
    }

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
        $("#falta_dinero").hide('slow/400/fast');
        $('#mod_buscar_articulos').modal('hide')
        
        setTimeout(() =>{
            $("#cantidad").focus();
        },500)
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

                            igualar_respaldo()
                            var sub_total1 = sub_total
                            var iva1 = iva

                            sub_total = formatNumber(sub_total,2,',','.');
                            iva = formatNumber(iva,2,',','.');
                            let total1 = formatNumber(total,2,',','.');
                            total_pagar = formatNumber(total_pagar,2,',','.');



                        var filas = "<tr><td class='nombre'>"+data.nombre+"</td><td>"+data.marca+"</td><td>"+data.precio+"</td><td>"+cantidad+"</td><td>"+sub_total+"</td><td>"+iva+"</td><td class='total'>"+total1+"</td><td><button type='button' class='btn btn-danger eliminar_articulo' data-total='"+total+"' data-sub_total='"+sub_total1+"' data-iva='"+iva1+"'><i class='fa fa-remove'></i></button></td></tr>";

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
            var iva_restar = $(this).data('iva');
            var sub_total_restar = $(this).data('sub_total');

            total_total = parseFloat(total_total) - parseFloat(total_restar);
            nuevo_total_pagar = parseFloat(total_span) - parseFloat(total_restar);

            sub_total_limpio = sub_total_limpio - parseFloat(sub_total_restar)
            iva_limpio = iva_limpio - parseFloat(iva_restar)


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
                total_total = 0
                iva_limpio = 0
                sub_total_limpio = 0

                $("#section_registrar").hide('slow');
                $("#monto_pago").val('')
                hide_sections_payment_method(1)
                $("input[name='metodo_pago']").prop('checked',false)
            }

            $('#falta_dinero').hide()

            igualar_respaldo()
    });

    $("#monto_pago").keyup(function(){
        $("#grabar_compra").prop('disabled', false);
    });

    function reset_values(){

      $('#monto_dolares').prop('required',false)
      $('#banco_debito').prop('required',false)
      $('#nro_transferencia').prop('required',false)
      $('#banco_transferencia').prop('required',false)
      $('#monto_debito').prop('required',false)
      $('#monto_debito').val(0)
      $('#monto_dolares').prop('required',false)
      $('#monto_dolares').val(0)
      $('#monto_trans').prop('required',true)
      $('#monto_trans').val(0)
      $('#monto_pago').val(0)
      $('.monto_debito').hide()
      $('.section_trans').show()

      $('#monto_pago').prop({
        required: true,
        readonly: false
      })
    }

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

    /* ===========================================================
                      SECCIÓN MODAL PAGO MIXTO
    =============================================================*/

    function showPaymentsMixFields(val){
      val = parseInt(val,10)
      
      /*
        1)Débito
        2)Visa
        3)Efectivo
        4)Transferencia
      */

      switch(val){
        
        case 1:
          $('#section_debito').show()
          $('#banco_debito').prop('required',true)
          $('.monto_debito').show()
          $('#monto_debito').prop('required',true)
        break;

        case 2:
          $('#section_mixto').show()
          $('#monto_dolares').prop('required',true)
        break;

        case 3:

          $('#monto_pago').prop({
            required: true,
            readonly: false
          })

        break;

        case 4:
          $('#section_trans').show()
          $('.section_trans').show()
          $('#monto_trans').prop('required',true)
        break;
      }

    }

    function calculate_visa_restante(val){

      let selector = ""
      switch(parseInt(val,10)){
        case 1:
          selector = "monto_debito"
        break;
        case 3:
          selector = "monto_pago"
        break;
        case 4:
          selector = "monto_trans"
        break;
      }

      $('#'+selector).keyup(function(e){
        let valor = parseFloat($(this).val()),
            result = 0

        result = (total_total - valor) / dolar_value
        result = formatNumber(result,2,',','.')

        $('#monto_dolares_mixto_restante').val(result)
      })
    }

    $('#btn_modal_mixto').click(function(e){
      let val1 = $('#campo_1_mixto').val(),
          val2 = $('#campo_2_mixto').val()

      if(val1 !== "" && val2 !== ""){
        
        if(val1 === val2){
          
          swal({
            title: "Ambos campos no pueden ser los mismos",
            type: "warning",
            showButtonCancel: false,
            showButtonConfirm: false,
            timer: 2000
          })

        }else{
          
          $('#monto_pago').prop({
            required: false,
            readonly: true
          })

          showPaymentsMixFields(val1)
          showPaymentsMixFields(val2)
          
          mixto1 = val1
          mixto2 = val2
          calculate_discount('mixto',null)

          $('#modal_mixto').modal('hide')
          $("#grabar_compra").prop('disabled', false);
          
          if(val1 == 2 || val2 == 2){
            $('#monto_dolares_mixto_restante').val(total_total / dolar_value)
            if(val1 == 2){
              calculate_visa_restante(val2)
            }else{
              calculate_visa_restante(val1)
            }
          }
        }

      }else{
        swal({
          title: "Debe escojer ambos campos",
          type: "warning",
          showButtonCancel: false,
          showButtonConfirm: false,
          timer: 2000
        })
      }

    })

    /* ===========================================================
                    FIN SECCIÓN MODAL PAGO MIXTO
    =============================================================*/

    function hide_sections_payment_method(type){
      type = parseInt(type)

      reset_values()

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
        $('#banco_debito').prop('required',true)

      }else if(type === 3){
        
        $('#section_debito').hide()
        $('#section_trans').hide()
        $('#section_dolar_cancelar').hide()
        $('#section_mixto').hide()
        //$('#monto_dolares').prop('required',true)
        $('#modal_mixto').modal('show')

      }else if(type === 4){
        
        $('#section_debito').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').hide()
        $("#grabar_compra").prop('disabled', false);
        $('#banco_transferencia').prop('required',true)
        $('#nro_transferencia').prop('required',true)

      }else if(type === 5){
        
        $('#section_trans').hide()
        $('#section_debito').hide()
        $('#section_mixto').hide()
        $('#section_dolar_cancelar').show()

      }
    }

    function calculate_discount(type,validate){
      let isDiscountActive = $('#aplicar_descuento').is(':checked')

      total_total = total_respaldo
      sub_total_limpio = sub_total_respaldo
      iva_limpio = iva_respaldo
      
      if(type === "efectivo"){

        var total_span,
            porcentaje = 0;

        if(isDiscountActive){

          porcentaje = (sub_total_limpio * porcentaje_efectivo) / 100;
          total_span = parseFloat(sub_total_limpio) - parseFloat(porcentaje);

          sub_total_limpio = total_span;
          iva_limpio = (sub_total_limpio * iva_conf) / 100
          total_total = sub_total_limpio + iva_limpio

          total_span = total_total

          $('#porcentaje_descuento').val(porcentaje_efectivo)

          if(!validate){
            
            total_span = formatNumber(total_span,2,',','.');
            $('#monto_pago').val(0)
            $("#total span").text(total_span);

          }else{
            return [total_span,porcentaje,id_descuento_efectivo];
          }

        }else{

          total_span = total_total

          $('#porcentaje_descuento').val(0)

          if(!validate){
            
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
            $('#monto_pago').val(0)

          }else{
            return [total_span,null,id_descuento_efectivo];
          }
          

        }

      }else if(type === "visa"){

        var total_span,
            porcentaje = 0,
            total_dolar = 0
        
        if(isDiscountActive){

          porcentaje = (sub_total_limpio * porcentaje_visa) / 100;
          total_span = parseFloat(sub_total_limpio) - parseFloat(porcentaje);

          sub_total_limpio = total_span;
          iva_limpio = (sub_total_limpio * iva_conf) / 100
          total_total = sub_total_limpio + iva_limpio

          total_span = total_total

          total_dolar  = parseFloat(total_span) / dolar_value

          $('#porcentaje_descuento').val(porcentaje_visa)

          if(!validate){
            $('#dolares_cancelar').val(formatNumber(total_dolar,2,',','.'))
            $('#monto_pago').val('')

            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_total,porcentaje,id_descuento_visa];
          }
        }else{

          total_span = parseFloat(total_total);
          total_dolar  = parseFloat(total_span) / parseFloat(dolar_value)

          $('#porcentaje_descuento').val(0)

          if(!validate){
            $('#dolares_cancelar').val(formatNumber(total_dolar,2,',','.'))
            $('#monto_pago').val('')

            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_total,null,id_descuento_visa];
          }

        }
          
          
      }else if(type === "debito"){

        var total_span,
            porcentaje = 0;
        
        if(isDiscountActive){
          

          porcentaje = (sub_total_limpio * porcentaje_debito) / 100;
          total_span = parseFloat(sub_total_limpio) - parseFloat(porcentaje);

          sub_total_limpio = total_span;
          iva_limpio = (sub_total_limpio * iva_conf) / 100
          total_total = sub_total_limpio + iva_limpio

          total_span = total_total

          $('#porcentaje_descuento').val(porcentaje_debito)

          if(!validate){
            console.log(porcentaje_debito,'aqui validate')
            $('#monto_pago').val(total_span)
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            console.log(porcentaje_debito,'no validate')
            return [total_span,porcentaje,id_descuento_debito];
          }

        }else{

          total_span = parseFloat(total_total)

          $('#porcentaje_descuento').val(0)

          if(!validate){
            $('#monto_pago').val(total_span)
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,null,id_descuento_debito];
          }

        }
          
      }else if(type === "transferencia"){
        
        var total_span,
              porcentaje = 0;

        if(isDiscountActive){

          porcentaje = (sub_total_limpio * porcentaje_transferencia) / 100;
          total_span = parseFloat(sub_total_limpio) - parseFloat(porcentaje);

          sub_total_limpio = total_span;
          iva_limpio = (sub_total_limpio * iva_conf) / 100
          total_total = sub_total_limpio + iva_limpio

          total_span = total_total

          $('#porcentaje_descuento').val(porcentaje_transferencia)

          if(!validate){
            $('#monto_pago').val(total_span)
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,porcentaje,id_descuento_transferencia];
          }        

        }else{
          total_span = parseFloat(total_total)

          $('#porcentaje_descuento').val(0)
          
          if(!validate){
            $('#monto_pago').val(total_span)
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,null,id_descuento_transferencia];
          }                  

        }

      }else{
        
        /* =========================================
                            Mixto  
        ============================================ */

        let porcentaje_aux_array = calculate_min_value_percentaje_discount(mixto1,mixto2),
        porcentaje_aux = porcentaje_aux_array[0],
        id_descuento_aux = porcentaje_aux_array[1],
        total_span,
        porcentaje = 0;

        if(isDiscountActive){

          porcentaje = (sub_total_limpio * porcentaje_aux) / 100;
          total_span = parseFloat(sub_total_limpio) - parseFloat(porcentaje);

          sub_total_limpio = total_span;
          iva_limpio = (sub_total_limpio * iva_conf) / 100
          total_total = sub_total_limpio + iva_limpio

          total_span = total_total

          $('#porcentaje_descuento').val(porcentaje_aux)

          if(!validate){
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,porcentaje,id_descuento_aux];
          }        

        }else{
          total_span = parseFloat(total_total)

          $('#porcentaje_descuento').val(0)
          
          if(!validate){
            total_span = formatNumber(total_span,2,',','.');
            $("#total span").text(total_span);
          }else{
            return [total_span,null,id_descuento_aux];
          }                  

        }
      }
        
    }

    function calculate_min_value_percentaje_discount(val,val2){
      let max1 = search_min_value_percentaje(val),
          max2 = search_min_value_percentaje(val2)

      if(max1[0] <= max2[0]){
        return max1
      }else{
        return max2
      }
    }

    function search_min_value_percentaje(val){

      let porcentaje_aux = 0,
          id_descuento_aux = 0

      if(val == 1){
        porcentaje_aux = porcentaje_debito
        id_descuento_aux = id_descuento_debito
      }else if(val == 2){
        porcentaje_aux = porcentaje_visa
        id_descuento_aux = id_descuento_visa
      }else if(val == 3){
        porcentaje_aux = porcentaje_efectivo
        id_descuento_aux = id_descuento_efectivo
      }else if(val == 4){
        porcentaje_aux = porcentaje_transferencia
        id_descuento_aux = id_descuento_transferencia
      }

      return [porcentaje_aux,id_descuento_aux]
    }

    function search_monto_pagado_mixto(val){

      let monto_aux = 0

      if(val == 1){
        monto_aux = parseFloat($('#monto_debito').val())
      }else if(val == 2){
        let dolares = parseFloat($('#monto_dolares').val())
        monto_aux = dolares * dolar_value
      }else if(val == 3){
        monto_aux = parseFloat($('#monto_pago').val())
      }else if(val == 4){
        monto_aux = parseFloat($('#monto_trans').val())
      }

      return monto_aux
    }

    function return_monto_pagado_mixto(){

      let val1 = search_monto_pagado_mixto(mixto1),
          val2 = search_monto_pagado_mixto(mixto2)
      return val1 + val2
    }

    $("#form_agregar_compra").submit(function(e){
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

          monto_pagado = parseFloat(monto_pagado) * dolar_value
          siglas = " $";

        }else if(metodo_pago === "mixto"){
          monto_pagado = return_monto_pagado_mixto()
        }

        var total_pagar_descuento = calculate_discount(metodo_pago,true),
            id_descuento = total_pagar_descuento[2]

        total_pagar = total_pagar_descuento[0]
        descuento = total_pagar_descuento[1]

        $('#descuento_value').val(descuento)
        $('#id_descuento').val(id_descuento)


        if(parseFloat(monto_pagado) < parseFloat(total_pagar)){
          
          let monto = 0

          if(metodo_pago === "visa"){
          
            let dolar_total_pagar = parseFloat(total_pagar) / dolar_value
            monto = dolar_total_pagar - monto_pagado_limpio

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
            if(metodo_pago === "mixto") {
              $('#tipos_mixto').val(mixto1+','+mixto2)
            }

            var vuelto = parseFloat(monto_pagado) - parseFloat(total_pagar);
            $("#vuelto").val(vuelto);
            $("#total_subtotal").val(sub_total_limpio)
            $("#total_iva").val(iva_limpio)

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(dataJson){
                  if(dataJson.r){
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
                  }else{
                    swal({
                      title: dataJson.motivo,
                      type: "warning",
                      showButtonCancel: false,
                      showButtonConfirm: false,
                      timer: 2000
                    })
                  }
                      
                }
            });
            return false;
        }
    });

    $("#imprimir_factura").click(function(){
        var ruta = $(this).data('ruta');
        window.open(ruta, '_blank');
        setTimeout(() => {
          window.location.reload()
        },500)
        /*$("#form_agregar_compra")[0].reset();
        $("#tabla_productos tbody").html('');
        $("#grabar_compra").prop('disabled');
        $("#imprimir_factura").hide();
        $("#total span").html('');
        $("#monto_suficiente").html('').hide();
        $("#falta_dinero").html('');
        $("#boton_agregar_tabla").prop('disabled', false)
        $('#cliente_encargado').text('')
        total_total = 0;
        hide_sections_payment_method(1)*/
    });

});
</script>