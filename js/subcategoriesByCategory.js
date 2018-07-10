//fetch subcategory based on category
function fetchSubcategory(cid)
{

  var req=new XMLHttpRequest();
  req.open("GET","fetch_subcategory.php?cateid="+cid,true);
  req.send();
  
  req.onreadystatechange=function(){
    if(req.readyState==4 && req.status==200)
    {
        document.getElementById("scatid").innerHTML=req.responseText;
    }
  };
    
}