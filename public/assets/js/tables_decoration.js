document.querySelectorAll('.normalelement').forEach(item=>{
    let id = item.closest('.normalelement').getAttribute('data-id');
    if(id % 2 == 0) {
        item.className = "oddelement";
        console.log("teste")
    }
})
