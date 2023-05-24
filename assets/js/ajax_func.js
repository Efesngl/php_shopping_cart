const ajax_func=new XMLHttpRequest();
console.log("ajax functions loaded");
function a(json,func){
    ajax_func.open("post","lib/db_func.php");
    ajax_func.setRequestHeader("Content_Type","application/json");
    ajax_func.send(json);
    ajax_func.onload=func;
}
