document.querySelector('.genrandom').addEventListener('click', function(){
    document.querySelector('.codadd').value = Math.floor(Math.random() * 10000000000000000);
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });

    $.ajax({
        url: "add-product",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $(document).find('p.texterror').text('')
        }

    }).done(function(data) {
        let textSubmit = "O produto "+data.name+" foi adicionado com sucesso";
        document.querySelector('.codadd').value = ''
        document.querySelector('.nameadd').value = ''
        document.querySelector('.priceadd').value = ''
        document.querySelector('.qtinitadd').value = ''
        document.querySelector('.warn').innerHTML = textSubmit;
        document.querySelector('.warn').style.display = "block";

    }).fail(function(jqXHR, textStatus ) {


        $.each(jqXHR.responseJSON.errors, function(prefix,val){
            $('p.'+prefix+'_error').text(val[0]);
        })
    })



        // fetch('add-product', {
        //     method: "POST",
        //     headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
        //     body: data
        // })
        // .then(function(res){ return res.json(); })
        // .then((data => {
        //         let textSubmit = "O produto "+data.name+" foi adicionado com sucesso";
        //         document.querySelector('.codadd').value = ''
        //         document.querySelector('.nameadd').value = ''
        //         document.querySelector('.priceadd').value = ''
        //         document.querySelector('.qtinitadd').value = ''
        //         document.querySelector('.warn').innerHTML = textSubmit;
        //         document.querySelector('.warn').style.display = "block";

        // }))
        // .catch(() => {
        //     document.querySelector('.warnerror').innerHTML = "Você precisa preencher todos os campos";
        //     document.querySelector('.warnerror').style.display = "flex";
        // })
})


