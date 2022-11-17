
const produto = {};

localStorage.setItem('countProducts', JSON.stringify({'countProducts': 0}));
localStorage.setItem('countPrice', JSON.stringify({'countPrice': 0.00}));
buttonFinish = document.querySelector('.default-button-2')
buttonFinish.addEventListener('click', function(){


    let getCountProducts =JSON.parse(localStorage.getItem('countProducts')).countProducts
    let getCountPrice = JSON.parse(localStorage.getItem('countPrice')).countPrice

    if(getCountProducts > 0) {
        data = new FormData();
        data.append('amount', getCountPrice);
        data.append('quantity_products', Object.values(produto).reduce((partialSum, a) => partialSum + a, 0));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });

            $.ajax({
                url: "/finalize-sale",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,

            }).done(function(resposta) {
                    let json = $.parseJSON(resposta);
                    let produtos = new FormData()

                    produtos.append('produtos', JSON.stringify(produto));
                    produtos.append('venda_id', json.id);

                    fetch('/insertprodutosvendidos', {
                        method: 'POST',
                        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
                        body: produtos
                    })
                    .then(function(res){ return res.json(); })
                    .then((data => {
                        window.location.href = "/";
                    }))

            })


    }
})

document.querySelector('.product-form').addEventListener('keyup', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault()
        codebar = this.value
        this.value = '';
        //Busca do produto na url, para fazer a listagem na tabela
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url: "products/find-product/"+codebar,
            type: "GET",
            dataType: "JSON"

        }).done(function(responseData) {
            if(responseData) {
                //Checando se já tem o produto na lista
                if(produto.hasOwnProperty(responseData.identification_number) == false) {
                    produto[responseData.identification_number] = 1
                } else {
                    produto[responseData.identification_number] = produto[responseData.identification_number] + 1 || 1
                }

                /**
                 * Criação do produto na tabela;
                 */

                createProduct = document.createElement('tr')
                txtCod = document.createTextNode(responseData.identification_number)
                txtName = document.createTextNode(responseData.name)
                txtPrice = document.createTextNode(responseData.price)
                createCod = document.createElement('td')
                createCod.appendChild(txtCod)
                createProd = document.createElement('td')
                createProd.appendChild(txtName)
                createPrice = document.createElement('td')
                createPrice.appendChild(txtPrice)

                createAction = document.createElement('td')
                createCircle = document.createElement('div')
                createCircle.className = 'circle remove'
                createCircle.setAttribute('data-id', responseData.identification_number)
                createIcon = document.createElement('img')
                createIcon.src = iconRemove
                createCircle.appendChild(createIcon)
                createAction.appendChild(createCircle)


                createProduct.appendChild(createCod)
                createProduct.appendChild(createProd)
                createProduct.appendChild(createPrice)
                createProduct.appendChild(createAction)

                $("#img-product").attr('src', publicUrl+'/'+responseData.photo)
                $("#name_infotext").text(responseData.name)
                $("#price_infotext").text("R$ "+responseData.price)

                document.querySelector(".p").appendChild(createProduct)
                /**
                 * Função para manter o scroll dos produtos sempre em baixo
                 */
                el = document.querySelector('.p')
                var height = el.scrollHeight;
                el.scrollTop = height;



               localStorage.setItem('countProducts',
                         JSON.stringify({
                            'countProducts': JSON.parse(localStorage.getItem('countProducts')).countProducts + 1
                        }));
               localStorage.setItem('countPrice',
                        JSON.stringify({
                            'countPrice': JSON.parse(localStorage.getItem('countPrice')).countPrice + parseFloat(responseData.price)
                        }))

                let getCountProducts =JSON.parse(localStorage.getItem('countProducts')).countProducts
                let getCountPrice = JSON.parse(localStorage.getItem('countPrice')).countPrice
               document.querySelector('.count-product').innerHTML = parseInt(getCountProducts);
               document.querySelector('.total-price').innerHTML = getCountPrice.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });


            } else {
                /**
                 * Popup será inserido para mostrar que o produto não existe
                 */
                let textSubmit = "O produto inserido não existe";
                document.querySelector('.warn').style.display = "none";
                document.querySelector('.warnerror').innerHTML = textSubmit;
                document.querySelector('.warnerror').style.display = "block";
            }

        })


    }
})


/**
 * Função para descer o menu ao clicar na categoria atual quando estiver pelo celular
 */


