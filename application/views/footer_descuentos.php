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

</body>

</html>
<script type="text/javascript">
    $(function(){
        $("#agregar_descuentos").click(function(){
            $("#section_oculto").show('show/400/fast');
            $("#section_datos").hide();
        });

        $("#ver_descuentos").click(function(){
            $("#section_oculto").hide();
            $("#section_datos").show('slow/400/fast');
            $("#form_agregar")[0].reset();
        });

        function pregunta() 
        {
            var agree = confirm("¿Desea eliminar realmente este descuento?");
            if(agree)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $(".eliminar_descuento").click(function(){
            var respuesta = pregunta();
            if(respuesta)
            {
                var ruta = $(this).data("ruta");
                window.location.replace(ruta);
            }
            else
            {
                return respuesta; 
            }
        });
    });
</script>