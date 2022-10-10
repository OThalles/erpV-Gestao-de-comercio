

document.querySelector('.selectstock-1').addEventListener('click', function() {
    document.querySelector('.add-stock-box').style.display = 'none'
    document.querySelector('.box-found-items-add').style.display = 'block';
    document.querySelector('.selectstock-2').classList.add('inactive')
    document.querySelector('.selectstock-1').classList.remove('inactive')
})

document.querySelector('.selectstock-2').addEventListener('click', function() {
    document.querySelector('.box-found-items-add').style.display = 'none';
    document.querySelector('.add-stock-box').style.display = 'block'
    document.querySelector('.selectstock-1').classList.add('inactive')
    document.querySelector('.selectstock-2').classList.remove('inactive')
})


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
                document.querySelector('.stock').innerHTML = textSubmit;
                document.querySelector('.stock').style.display = "block";
            } else {

            }
        }))

})

document.querySelector(".add-product-form").addEventListener('submit', async(e)=>{

        e.preventDefault();
        codProductAdd = document.querySelector('.codadd')
        nameProductAdd = document.querySelector('.nameadd')
        priceProductAdd = document.querySelector('.priceadd')
        qtinitProductAdd = document.querySelector('.qtinitadd')

        payload = {
            identification_number:codProductAdd.value,
            name:nameProductAdd.value,
            price:priceProductAdd.value,
            quantity:qtinitProductAdd.value
        };

        let data = new FormData();
        data.append('identification_number', payload.identification_number)
        data.append('name', payload.name)
        data.append('price', payload.price)
        data.append('quantity', payload.quantity)

        console.log(data)
            fetch('add-product', {
                method: "POST",
                headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
                body: data
            })
            .then(function(res){ return res.json(); })
            .then((data => {
                let textSubmit = "O produto "+data.name+" foi adicionado com sucesso";
                document.querySelector('.codadd').value = ''
                document.querySelector('.nameadd').value = ''
                document.querySelector('.priceadd').value = ''
                document.querySelector('.qtinitadd').value = ''
                document.querySelector('.warn').innerHTML = textSubmit;
                document.querySelector('.warn').style.display = "block";
            }))

})



