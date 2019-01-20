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

         $("#agg_activar").on('show.bs.modal', function(e){
            var  x = $(e.relatedTarget).data().id_modi;
                     $("#id_modificar").val(x);

              var  x = $(e.relatedTarget).data().sw_modi;
                     $("#sw_modificar").val(x);        

                
        });

    });
</script>