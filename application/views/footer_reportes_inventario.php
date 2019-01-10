
        </div>
        <!-- /#page-wrapper -->
    </div>                       
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="./js/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>
    <script src='./js/select2.min.js'></script>
    <script src='./js/bootstrap-datepicker.js'></script>
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
    $("#proveedor").select2();

    $("#fecha_desde").datepicker({
        format: "dd-mm-yyyy"
    }).on("changeDate", function(){
        $(this).datepicker('hide');
    });

    $("#fecha_hasta").datepicker({
        format: "dd-mm-yyyy"
    }).on("changeDate", function(){
        $(this).datepicker('hide');
    });

    $("#mostrar_reporte").click(function(){
        $("#barra_oculta").show('slow/400/fast');
        var proveedor = $("#proveedor").val(),
            fecha_desde = $("#fecha_desde").val(),
            fecha_hasta = $("#fecha_hasta").val(),
            cantidad_mayor_que = $("#cantidad_mayor_que").val(),
            cantidad_menor_que = $("#cantidad_menor_que").val();
        $.getJSON('<?php echo base_url()."Reportes_inventario/traer_reporte"; ?>', {proveedor: proveedor, fecha_desde : fecha_desde, fecha_hasta : fecha_hasta, cantidad_menor_que: cantidad_menor_que, cantidad_mayor_que : cantidad_mayor_que}, function(data) 
        {
            if(typeof(data[0].vacio) == "undefined")
            {
                $("#barra_oculta").hide('slow/400/fast');
                var filas = "";
                $.each(data, function(i, e) 
                {
                    filas += "<tr><td>"+e.proveedor+"</td><td>"+e.nombre+"</td><td>"+e.marca+"</td><td>"+e.grupo+"</td><td>"+e.cantidad+"</td><td><img src='./img/dolar.jpg' class='img-responsive' width='100px'> "+formatNumber(e.precio_proveedor,2,',','.')+"<br> <img src='./img/bolivar.png' class='img-responsive' width='60px'> "+formatNumber(e.precio_proveedor * e.preciodolar,2,',','.')+"  </td><td> <img src='./img/dolar.jpg' class='img-responsive' width='100px'> "+formatNumber(e.precio,2,',','.')+" <img src='./img/bolivar.png' class='img-responsive' width='60px'> "+formatNumber(e.precio * e.preciodolar,2,',','.')+"</td><td>"+e.fecha_agregado+"</td></tr>";    
                });
                $("#tabla_reporte tbody").html('');
                $("#tabla_reporte tbody").html(filas);
            }
            else
            {
                alert(data[0].vacio);
                $("#barra_oculta").hide('slow/400/fast');
            }
        });
    });

    $("#imprimir_excel").click(function(){  
        var proveedor = $("#proveedor").val(),
            fecha_desde = $("#fecha_desde").val(),
            fecha_hasta = $("#fecha_hasta").val(),
            cantidad_mayor_que = $("#cantidad_mayor_que").val(),
            cantidad_menor_que = $("#cantidad_menor_que").val(),
            base_url = "<?php echo base_url().'Reportes_inventario/'; ?>";
        var ruta = base_url + "imprimir_excel?proveedor="+btoa(proveedor)+"&fecha_desde="+btoa(fecha_desde)+"&fecha_hasta="+btoa(fecha_hasta)+"&cantidad_menor_que="+btoa(cantidad_menor_que)+"&cantidad_mayor_que="+btoa(cantidad_mayor_que);
        window.open(ruta, "_blank");
    });

    $("#imprimir_pdf").click(function(){  
        var proveedor = $("#proveedor").val(),
            fecha_desde = $("#fecha_desde").val(),
            fecha_hasta = $("#fecha_hasta").val(),
            cantidad_mayor_que = $("#cantidad_mayor_que").val(),
            cantidad_menor_que = $("#cantidad_menor_que").val(),
            base_url = "<?php echo base_url().'Reportes_inventario/'; ?>";
        var ruta = base_url + "imprimir_pdf?proveedor="+btoa(proveedor)+"&fecha_desde="+btoa(fecha_desde)+"&fecha_hasta="+btoa(fecha_hasta)+"&cantidad_menor_que="+btoa(cantidad_menor_que)+"&cantidad_mayor_que="+btoa(cantidad_mayor_que);
        window.open(ruta, "_blank");
    });
});
</script>