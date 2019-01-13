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
<?php
    $x = "";
    if(!empty($this->session->flashdata('exito')))
    {
        $x = $this->session->flashdata('exito');
    }
?>
</html>
<script type="text/javascript">
    $(function(){

        $("table").dataTable({
            "language" : {"url" : "./json/esp.json"}
        });

        var x = "<?php echo $x; ?>";

        if( x != "")
        {
            setTimeout(function(){
                $("#alerta").hide();
            }, 2000);
        }

        $("#modal_editar").on('show.bs.modal', function(e){
            var x = $(e.relatedTarget).data().id;
                    $("#id_modificar").val(x);
            var x = $(e.relatedTarget).data().nombre;
                    $("#nombre_modi").val(x);
            var x = $(e.relatedTarget).data().cedula;
                    $("#cedula_modi").val(x);
            var x = $(e.relatedTarget).data().telefono;
                    $("#telefono_modi").val(x);
            var x = $(e.relatedTarget).data().sueldo;
                    $("#sueldo_modi").val(x);
        });

        function pregunta()
        {
            var agree = confirm("¿Desea realmente borrar este registro?");
            return agree;
        }

        $(".eliminar").click(function(event) {
            var confirm = pregunta();
            if(confirm)
            {
                var id = $(this).data().id;
                window.location.replace('<?php echo base_url()."Empleados/eliminar/"; ?>'+id);
            }
            else
            {
                return false;
            }
        });
    });
</script>