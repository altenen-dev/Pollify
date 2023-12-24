

function loadResults(a){
    $(document).ready(function(){
      $('button').click(function() {
  
        $.ajax({
          url: 'results.php',
          type: 'POST',
          data: "&id="+a,
          success: function(output){
             $('#results').html(output);
  
          }
        });
      });
    });
  }

  