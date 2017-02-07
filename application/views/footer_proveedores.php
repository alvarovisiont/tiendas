
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
<script>
    $(function(){

        $("#tabla").dataTable({
            "language" : {"url" : "json/esp.json"},
            order: [1, "asc"]
        });

        $("#agregar_proveedor").click(function(){
            $("#section_oculto").show('slow/400/fast');
            $("#mostrar_datos").show('slow/400/fast');
            $(this).hide();
            $("#section_table").hide();
        });
        $("#mostrar_datos").click(function(){
            $("#section_oculto").hide();
            $(this).hide();
            $("#agregar_proveedor").show('slow/400/fast');
            $("#section_table").show('slow/400/fast');
            $("#form_agregar")[0].reset();
        });

        function pregunta()
        {
            var agree = confirm("¿Desea realmente eliminar este Proveedor? El proceso sera irreversible.")
            if(agree)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        $(".eliminar_provee").click(function(){
            var desicion = pregunta();
            if(desicion)
            {
                $.ajax({
                    "url" : $(this).data('ruta'), 
                    "type" : "POST",
                    "dataType" : "JSON",
                    "data" : {id: $(this).data('id')},
                    success: function(data)
                    {
                        if(typeof(data.exito) != "undefined")
                        {
                            
                            window.location.reload();
                        }
                        else
                        {
                            alert("No se puede eliminar este proveedor porque aún existe mercancia relacionada con el");
                        }
                    }
                }); 
            }
            else
            {
                return false;
            }

        });

        $("#articulos_provee").on("show.bs.modal", function(e){
            var id = $(e.relatedTarget).data().id;

            var tabla = "<table id='tabla1' class='table table-bordered table-hover'><thead><th class='text-center'>Nombre</th><th class='text-center'>Marca</th><th class='text-center'>Cantidad</th><th class='text-center'>Precio</th><th class='text-center'>Fecha_Registro</th></thead><tbody class='text-center'></tbody></table>";

            $("#div_tabla").html('');
            $("#div_tabla").html(tabla);

            $("#tabla1").dataTable({
                "language" : {"url" : "json/esp.json"},
                order : [1,"asc"],
                "ajax" : {
                    "url" : "<?php echo base_url()."Proveedores/traer_articulos"; ?>",
                    "type" : "POST",
                    "data" : function(d)
                    {
                        d.id = id;
                    },
                    "dataSrc" : ""
                },
                columns: [
                    {"data" : "nombre"},
                    {"data" : "marca"},
                    {"data" : "cantidad"},
                    {"data" : "precio"},
                    {"data" : "fecha_agregado"}
                ]
            });
        });

        $("#modi_provee").on('show.bs.modal', function(e){
            var x = $(e.relatedTarget).data().id;
                    $(e.currentTarget).find("#id_modificar").val(x);
            var x = $(e.relatedTarget).data().nombre;
                    $(e.currentTarget).find("#nombre_modi").val(x);
            var x = $(e.relatedTarget).data().telefono;
                    $(e.currentTarget).find("#telefono_modi").val(x);
            var x = $(e.relatedTarget).data().email;
                    $(e.currentTarget).find("#email_modi").val(x);
            var x = $(e.relatedTarget).data().direccion;
                    $(e.currentTarget).find("#direccion_modi").val(x);
            var x = $(e.relatedTarget).data().rif;
                    $(e.currentTarget).find("#rif_modi").val(x);
            var x = $(e.relatedTarget).data().fax;
                    $(e.currentTarget).find("#fax_modi").val(x);

        });
    });
</script>