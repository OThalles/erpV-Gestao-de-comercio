document.querySelectorAll('.invoicestatus').forEach(item=>{
    item.addEventListener('change', function(e){
        e.preventDefault();
        datainvoice = item.value.split(':')


            fetch('/contas/editstatus/'+datainvoice[0]+'/'+datainvoice[1])
            .then(function(res){ return res.json(); })
            .then((data => {
            }))
    })
})


