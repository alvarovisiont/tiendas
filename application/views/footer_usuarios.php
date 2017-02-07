
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
    <script src="./js/morris.min.js"></script>
    <script src="./js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>

</body>

</html>
<script type="text/javascript">
    $(function(){

        
        
        $("#form_agregar").submit(function(event) {
            $.ajax({
                url: '<?php echo base_url()."Usuarios_agregar/agregar_usuarios"; ?>',
                type: 'POST',
                dataType: 'JSON',
                data: $(this).serialize(),
                success:function(data)
                {
                    if(typeof(data.registrado) != "undefined")
                    {
                        $("#aviso").html('');
                        $("#aviso").html(data.registrado);
                        $("#aviso").show('slow/400/fast');
                        setTimeout(function(){
                            $("#aviso").hide('slow/400/fast');
                        }, 2000);
                    }
                    else
                    {
                        $("#aviso").html('');
                        $("#aviso").html('Usuario registrado con éxito');
                        $("#aviso").show('slow/400/fast');
                        setTimeout(function(){
                            window.location.reload();
                        }, 1500);   
                    }
                }
            
            });
            return false;
        });

        $("#modal_edit").on('show.bs.modal', function(e){
            var x = $(e.relatedTarget).data().id;
                    $(e.currentTarget).find("#id_modificar").val(x);
            var x = $(e.relatedTarget).data().usuario;
                    $(e.currentTarget).find("#usuario_modi").val(x);
            var x = $(e.relatedTarget).data().clave;
                    $(e.currentTarget).find("#clave_modi").val(x);
            var x = $(e.relatedTarget).data().perfil;
                    $(e.currentTarget).find("#perfil_modi").val(x).prop('selected', true);
        });

        function pregunta()
        {
            var agree = confirm("¿Desea realmente eliminar este Usuario? El proceso sera irreversible.")
            if(agree)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        $(".eliminar").click(function(){
            var respuesta = pregunta();
            if(respuesta)
            {
                var id = $(this).data('id');
                window.location.replace('<?php echo base_url()."Usuarios_administracion/eliminar/";?>'+id);    
            }
            else
            {
                return respuesta;
            }
            
        });
    });
</script>