
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="./js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./js/raphael.min.js"></script>
    <script src="./js/morris.min.js"></script>
    <script src="./js/morris-data.js"></script>
    <script src="./js/sweetalert2.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>

</body>

</html>
<script>
    $(function(){
        $("#form_agregar").submit(function(e){
            var formData = new FormData($("#form_agregar")[0]);
            $.ajax({
                url : $(this).attr('action'),
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function()
                {
                    swal({
                            title: "Datos Almacenados!",
                            type: "success",
                            confirmButtonText: "Listo",
                            confirmButtonClass: "btn btn-primary",
                            showButtonCancel: false,
                            closeOnConfirm: true
                        },function(confirm){
                            if(confirm)
                            {
                                $("#form_agregar").keypress(function(e){
                                    if(e.keyCode == 13)
                                    {
                                        return false;
                                    }
                                });       
                                window.location.reload();
                            }
                            
                        });
                }
            });
            return false;
        });

        $("#form_agregar_encargado").submit(function(){
            $.ajax({
                url : $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function()
                {
                    swal({
                            title: "Datos Almacenados!",
                            type: "success",
                            confirmButtonText: "Listo",
                            confirmButtonClass: "btn btn-primary",
                            showButtonCancel: false,
                            closeOnConfirm: true
                        },function(confirm){
                            if(confirm)
                            {
                                $("#form_agregar_encargado").keypress(function(e){
                                    if(e.keyCode == 13)
                                    {
                                        return false;
                                    }
                                });       
                                window.location.reload();
                            }
                            
                        });
                }
            });
            return false;
        });

        $("#modi_datos_encargado").on('show.bs.modal', function(e){
            var x = $(e.relatedTarget).data().id_encargado;
                    $(e.currentTarget).find('#id_modificar').val(x)
            var x = $(e.relatedTarget).data().nombre_encargado;
                    $(e.currentTarget).find('#nombre_encargado_modi').val(x)
            var x = $(e.relatedTarget).data().cedula_encargado;
                    $(e.currentTarget).find('#cedula_encargado_modi').val(x)
            var x = $(e.relatedTarget).data().telefono_encargado;
                    $(e.currentTarget).find('#telefono_encargado_modi').val(x)
            var x = $(e.relatedTarget).data().correo_encargado;
                    $(e.currentTarget).find('#correo_encargado_modi').val(x)
        });

        $("#modi_datos_empresa").on('show.bs.modal', function(e){
            var x = $(e.relatedTarget).data().id;
                    $(e.currentTarget).find('#id_modificar_empresa').val(x)
            var x = $(e.relatedTarget).data().factura;
                    $(e.currentTarget).find('#factura_modificar_empresa').val(x)
            var x = $(e.relatedTarget).data().prefactura;
                    $(e.currentTarget).find('#prefactura_modificar_empresa').val(x)                
            var x = $(e.relatedTarget).data().nombre;
                    $(e.currentTarget).find('#nombre_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().direccion;
                    $(e.currentTarget).find('#direccion_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().telefono;
                    $(e.currentTarget).find('#telefono_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().email;
                    $(e.currentTarget).find('#email_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().rif;
                    $(e.currentTarget).find('#rif_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().fax;
                    $(e.currentTarget).find('#fax_empresa_modi').val(x)
            var x = $(e.relatedTarget).data().logo;
                if(x != "")
                {
                    $("#nombre_logo").val(x);
                    $("#div_logo").show('slow/400/fast');
                    $("#div_logo").children('div').html('');
                    $("#div_logo").children('div').html('<img src="./img/'+x+'" class="img-responsive">');
                }
        });
    });
</script>