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

    <!-- Custom Theme JavaScript -->
    <script src="./js/sb-admin-2.min.js"></script>

</body>

</html>
<script type="text/javascript">
    $(function(){
        $("#modal_configuracion_modi").on('show.bs.modal', function(e){
            var  x = $(e.relatedTarget).data().id_modi;
                     $("#id_modificar").val(x);
            var  x = $(e.relatedTarget).data().siglas_modi;
                     $("#siglas_modi").val(x);         
            var  x = $(e.relatedTarget).data().iva_modi;
                     $("#iva_modi").val(x);
            var  x = $(e.relatedTarget).data().retencion_modi;
                     $("#retencion_modi").val(x);
            var  x = $(e.relatedTarget).data().dolar_modi;
                     $("#dolar_value_modi").val(x);
            var  x = $(e.relatedTarget).data().dolar_today;
                     $("#dolar_today_modi").val(x);         

        });
    });
</script>