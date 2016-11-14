  <script src="http://code.jquery.com/jquery-1.9.1.min.js" charset="utf-8"></script>
  <script src="js/bootstrap.js" charset="utf-8"></script>
  <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
  <script src="js/bootstrap-datetimepicker.js" charset="utf-8"></script>
  <script>
   $(document).ready(function(){
     $("#search_table").keyup(function(){
      _this = this;
      // Show only matching TR, hide rest of them
      $.each($("#searchtable tbody tr"), function() {
      if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
          $(this).hide();
          else
          $(this).show();
        });
      });

      $("#month_select").change(function(){
         var selected_month=$(this).val();
         sendType(selected_month);
           });
    });
    function sendType(type)
    {
        $.ajax({
        type:"GET",
        url:"projection.php",
        data:({month:type}),
        success:function(success)
        {
           location.href="projection.php?month="+type;
        }
    });
  }
  $(".form_datetime").datetimepicker({
      format: "yyyy-mm-dd hh:mm:ss"
  });

  $('select[name=status]').change(function(e){
    if ($('select[name=status]').val() == 'To Meet'){
        $("#meetingdate").prop('required',true);
    }
  });
  $('select[name=status]').change(function(e){
    if ($('select[name=status]').val() == 'Followup'){
        $("#followupdate").prop('required',true);
    }
  });
  $('select[name=status]').change(function(e){
    if ($('select[name=status]').val() == 'In Progress' || $('select[name=status]').val() == 'Awaiting Payment' || $('select[name=status]').val() == 'Awaiting Feedback'){
        $("#startdate").prop('required',true);
        $("#deadline").prop('required',true);
    }
  });
  $('select[name=status]').change(function(e){
    if ($('select[name=status]').val() == 'Yet To Start'){
        $("#startdate").prop('required',true);
    }
  });
  $(function(){
    if ($('#startdate').val() != '') {
      $("#finalpaid").prop('required',true);
    }
  });
</script>
<script type="text/javascript">
  $(function() {

      //autocomplete
      $(".auto").autocomplete({
          source: "includes/searchlist.php",
          minLength: 1
      });

  });
</script>
<script type="text/javascript">
  $(function() {

      //autocomplete
      $(".auto").autocomplete({
          source: "includes/searchlist.php",
          minLength: 1
      });

  });
</script>
<script>
    function isOnlyNumberKey(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode
     if ( charCode > 31 && (charCode < 48 || charCode > 57)){
          return false;
      }
      return true;
    }
</script>



</body>
</html>
