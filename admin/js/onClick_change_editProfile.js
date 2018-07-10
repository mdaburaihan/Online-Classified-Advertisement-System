$(document).ready(function(){
  $('#contentid :input').each(function(){
      $(this).attr("readOnly",true);
  });
});

$(document).ready(function(){
$('#editName').click(function(){
  $('#name').each(function(){
      $(this).attr("readOnly",false);
      $(this).css("border", "2px solid #ccc");
      });
  });
});
$(document).ready(function(){
$('#editEmail').click(function(){
  $('#email').each(function(){
      $(this).attr("readOnly",false);
      $(this).css("border", "2px solid #ccc");
      });
  });
});
$(document).ready(function(){
$('#editPhone').click(function(){
  $('#phone').each(function(){
      $(this).attr("readOnly",false);
      $(this).css("border", "2px solid #ccc");
      });
  });
});