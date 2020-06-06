
<!-- Footer -->
<footer class="footer">
  <div class="row align-items-center justify-content-xl-between">
  </div>
</footer>
</div>
</div>
<!-- Argon Scripts -->
<!-- Core -->

<!-- <script src="<z?= base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script> -->
<script src="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){$('#table_user').DataTable({});});
$(document).ready(function(){$('#table_french').DataTable({});});
$(document).ready(function(){$('#table_agent').DataTable({});});
$(document).ready(function(){$('#table_block').DataTable({});});
$(document).ready(function(){$('#table_banner').DataTable({"aaSorting": []});});
// $('#input-first-date').datepicker({ });
// $('#input-last-date').datepicker({ });
// $('#input-moniter-date').datepicker({ });
jQuery(document).ready(function(){
    jQuery('#shw').on('click', function(event) {
         jQuery('#shw1').toggle('show');
         jQuery('#shw2').toggle('show');
         jQuery('#shw3').toggle('show');
         jQuery('#shw4').toggle('show');
         jQuery('#shw5').toggle('show');
    });
});
$("#ftr_chk").click(function() {
    if($(this).is(":checked")) {
        $("#footer").show();
    } else {
        $("#footer").hide();
    }
});
$(document).ready(function() {
  $("input[name='rate2']").click(function() {
    if (!$("input[name='rate2']:checked").val()) {
      $('#check').popover('show');
    }
    else{
      $('#check').popover('hide');
    }
  });
  $("input[name='active']").click(function() {
    if (!$("input[name='active']:checked").val()) {
      $('#actv_hed').popover('show');
    }
    else{
      $('#actv_hed').popover('hide');
    }
  });
  $("#updt_btn").click(function() {
    if($('#actv').is(":checked") && $("input[name='rate2']:checked").val()) {
      $('#updt_btn').attr('type', 'submit');
    } else {
        if (!$("input[name='rate2']:checked").val()) {
          $('#check').popover('show');
        }
        else{
          $('#check').popover('hide');
        }
        if (!$("input[name='active']:checked").val()) {
        $('#actv_hed').popover('show');
      }
      else{
        $('#actv_hed').popover('hide');
      }
    }

  });
});
//
</script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="<?= base_url(); ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="<?= base_url(); ?>assets/js/argon.js?v=1.0.0"></script>
</body>

</html>
