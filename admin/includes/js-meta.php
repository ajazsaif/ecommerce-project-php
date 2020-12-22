<script src="<?php echo __WEBROOT__; ?>/js/jquery.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/bootstrap.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/fastclick.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/adminlte.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/sparkline.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/slimscroll.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/chart.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/demo.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/select2.full.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery.inputmask.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery.inputmask.extensions.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/moment.min.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/daterangepicker.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/bootstrap-timepicker.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/icheck.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/jquery.dataTables.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/dataTables.bootstrap.js"></script>
<script src="<?php echo __WEBROOT__; ?>/css/ckeditor/ckeditor.js"></script>
<script src="<?php echo __WEBROOT__; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo __WEBROOT__; ?>/js/switchery.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor');
    CKEDITOR.replace('additional_info');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>