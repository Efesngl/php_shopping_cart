let url=location.pathname.slice(location.pathname.lastIndexOf("/")+1);
if(url.length==0){
    url="index.php";
}
let navbars=document.querySelectorAll(".nav-link");
navbars.forEach(elem=>{
    if(elem.dataset.link==url){
        elem.classList.add("active");
    }
})

const ajax=new XMLHttpRequest();
