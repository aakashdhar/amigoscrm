
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
   });
 </script>
</body>
</html>
