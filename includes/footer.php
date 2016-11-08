  <script src="js/jquery.js" charset="utf-8"></script>
  <script src="js/bootstrap.js" charset="utf-8"></script>
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

      $("#name").keyup(function()
      {
        var name = $(this).val();
        if(name.length > 2)
        {
          $("#result").html('checking...');
          $.ajax({
            type : 'POST',
            url  : 'project-name.php',
            data : $(this).serialize(),
            success : function(data){
                   $("#result").html(data);
                }
            });
            return false;
        }
        else
        {
          $("#result").html('');
        }
      });
   });
</body>
</html>
