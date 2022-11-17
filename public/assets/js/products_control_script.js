document.querySelector('.genrandom').addEventListener('click', function(){
    document.querySelector('.codadd').value = Math.floor(Math.random() * 10000000000000000);
})


$("#add-product-form").submit(function(e) {

    e.preventDefault();
    // image = document.querySelector('.from-control-file')
    // codProductAdd = document.querySelector('.codadd')
    // nameProductAdd = document.querySelector('.nameadd')
    // priceProductAdd = document.querySelector('.priceadd')
    // qtinitProductAdd = document.querySelector('.qtinitadd')

    // payload = {
    //     image:image,
    //     identification_number:codProductAdd.value,
    //     name:nameProductAdd.value,
    //     price:priceProductAdd.value,
    //     quantity:qtinitProductAdd.value
    // };

    let data = new FormData(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });

    $.ajax({
        url: "add-product",
        type: "POST",
        data: data,
        encType: "multipart/form-data",
        cache: false,
        processData: false,
        contentType: false,
        beforeSend:function(){
            $(document).find('p.texterror').text('')
        }

    }).done(function(data) {
        $('#image').val('');
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
