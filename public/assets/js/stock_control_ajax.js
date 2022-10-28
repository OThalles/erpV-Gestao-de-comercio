
document.querySelector(".add-stock-form").addEventListener('submit', async(e)=>{

    e.preventDefault();
    codProductAdd = document.querySelector('.codadd-stock').value
    qtinitProductAdd = document.querySelector('.qtinitadd-stock').value

    payload = {
        identification_number:codProductAdd,
        quantity:qtinitProductAdd
    };


        fetch('/add-stock/'+payload.identification_number+'/'+payload.quantity)
        .then(function(res){ return res.json(); })
        .then((data => {
            if(data) {
                let textSubmit = "Foram adicionados "+data.quantity+" unidades do produto "+data.name;
                document.querySelector('.warn').innerHTML = textSubmit;
                document.querySelector('.warn').style.display = "block";
            } else {

            }
        }))

})



