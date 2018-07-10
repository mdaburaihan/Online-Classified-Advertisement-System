$(document).ready(function(){
  $('#contentid :input').each(function(){
      $(this).attr("readOnly",true);
  });
  $('#contentid :select').each(function(){
      $(this).attr("readOnly",true);
  });
});