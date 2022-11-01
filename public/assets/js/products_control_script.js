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
        .catch(() => {
            document.querySelector('.warnerror').innerHTML = "Você precisa preencher todos os campos";
            document.querySelector('.warnerror').style.display = "flex";
        })
})


String.prototype.reverse = function(){
    return this.split('').reverse().join('');
  };

  function mascaraMoeda(campo,evento){
    var tecla = (!evento) ? window.event.keyCode : evento.which;
    var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
    var resultado  = "";
    var mascara = "##.###.###,##".reverse();
    for (var x=0, y=0; x<mascara.length && y<valor.length;) {
      if (mascara.charAt(x) != '#') {
        resultado += mascara.charAt(x);
        x++;
      } else {
        resultado += valor.charAt(y);
        y++;
        x++;
      }
    }
    campo.value = resultado.reverse();
  }


