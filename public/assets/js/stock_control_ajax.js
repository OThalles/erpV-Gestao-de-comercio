

document.querySelector(".add-stock-form").addEventListener('submit', async(e)=>{

    e.preventDefault();
    codProductAdd = document.querySelector('.codadd-stock').value
    qtinitProductAdd = document.querySelector('.qtinitadd-stock').value

    payload = {
        identification_number:codProductAdd,
        quantity:qtinitProductAdd
    };


        

        fetch('/add-stock/'+payload.identification_number+'/'+payload.quantity)
        .then(function(res){  return res.json(); })
        .then((data => {
            if(data) {
                let textSubmit = "Foram adicionados "+data.quantity+" unidades do produto "+data.name;
                document.querySelector('.warn').innerHTML = textSubmit;
                document.querySelector('.warn').style.display = "block";

            } else if (data.erro) {
                document.querySelector('.warnerror').innerHTML = "Você ainda não adicionou esse produto";
                document.querySelector('.warnerror').style.display = "block";
            } else {
                console.log("cringe")
            }
        }))
        .catch(e => {
                document.querySelector('.warnerror').innerHTML = "Você precisa preencher todos os campos corretamente";
                document.querySelector('.warnerror').style.display = "block";
        })


})



