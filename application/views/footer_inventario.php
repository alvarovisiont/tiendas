
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
    <script src='./js/select2.min.js'></script>
    <script src="./js/sweetalert2.min.js"></script>
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
<script>
    $(function(){

        $("table").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: [4, "asc"]
        });

        $("#proveedor_modi").select2();
        $("#proveedor").select2();
        $("#grupo").select2();
        $("#grupo_modi").select2();


        function pregunta()
        {
            var agree = confirm("¿Desea realmente eliminar este artículo? El proceso sera irreversible.")
            if(agree)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        $(".eliminar_articulo").click(function(){
            var desicion = pregunta();
            if(desicion)
            {
                window.location.href = $(this).data('ruta');
            }
            else
            {
                return false;
            }

        });

        $("#modi_articulo").on('show.bs.modal', function(e){

            var x = $(e.relatedTarget).data().id_modi;
                    $(e.currentTarget).find("#id_modificar").val(x);
            var x = $(e.relatedTarget).data().nombre_modi;
                    $(e.currentTarget).find("#nombre_modi").val(x);
            var x = $(e.relatedTarget).data().marca_modi;
                    $(e.currentTarget).find("#marca_modi").val(x);
            var x = $(e.relatedTarget).data().precio_modi;
                    $(e.currentTarget).find("#precio_modi").val(x);
            var x = $(e.relatedTarget).data().costo_modi;
                    $(e.currentTarget).find("#costo_modi").val(x);
            var x = $(e.relatedTarget).data().cantidad_modi;
                    $(e.currentTarget).find("#cantidad_modi").val(x);
            var x = $(e.relatedTarget).data().observacion_modi;
                    $(e.currentTarget).find("#observacion_modi").val(x);
            var x = $(e.relatedTarget).data().fecha_modi;
                    $(e.currentTarget).find("#fecha_registro_modi").val(x);
            var x = $(e.relatedTarget).data().proveedor_modi;
                    $(e.currentTarget).find("#proveedor_modi").val(x).prop('selected', true).change();
            var x = $(e.relatedTarget).data().grupo_modi;
                    $(e.currentTarget).find("#grupo_modi").val(x).prop('selected', true).change();
            var x = $(e.relatedTarget).data().iva_modi;
                    $(e.currentTarget).find("#iva_modi").val(x).prop('selected', true);
        });

        $("#form_agregar").submit(function(){
            if($("#proveedor").val() == "")
            {
                alert("Debe escoger un proveedor");
                return false;
            }
            $.ajax({
                url: "<?php echo base_url()?>Inventario/agregar",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(typeof(data.exito) != "undefined")
                    {
                        swal({
                            title: "Artículo registrado!",
                            type: "success",
                            confirmButtonText: "Listo",
                            confirmButtonClass: "btn btn-info",
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
                    else
                    {
                        console.log("fallo");
                    }
                }
            });
            return false;
        });

        $("#proveedor_modi").submit(function(){
            if($(this).val() == "")
            {
                alert("Debe escoger un proveedor");
                return false;
            }
        });

        $("#boton_agregar_grupo").click(function(){
            if($("#agregar_grupo").val() != "")
            {
                var grupo = $("#agregar_grupo").val();
                $("#grupo").append("<option value='"+grupo+"'>"+grupo+"</option>");
                $("#grupo_modi").append("<option value='"+grupo+"'>"+grupo+"</option>");
                $("#agg_grupo").modal('hide');
            }
        });

        $("#exportar_pdf").click(function(){
            var ruta = $(this).data('ruta');
            window.open(ruta, "_blank");
        });

        $("#exportar_excel").click(function(){
            var ruta = $(this).data('ruta');
            window.open(ruta);
        });
    });
</script>