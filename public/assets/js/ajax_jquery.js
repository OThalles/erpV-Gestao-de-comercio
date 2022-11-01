
var produto = {};

document.querySelector('.nova-venda').style.display = 'none'



buttonFinish = document.querySelector('.default-button-2')
buttonFinish.addEventListener('click', function(){

    let count = document.querySelector('.count-product').textContent
    let amount = document.querySelector('.total-price').textContent
    let amountFormatted = amount.slice(3).replace(/,/g, ".")
    if(count > 0) {
        data = new FormData();
        console.log(count)
        console.log(amountFormatted)
        console.log(JSON.stringify(produto));
        data.append('amount', amountFormatted);
        data.append('quantity_products', count);


            fetch('/finalize-sale', {
                method: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
                body: data
            })
            .then(function(res){ return res.json(); })
            .then((data => {
                //Requisição para finalizar a venda e contabilizar os dados
                let produtos = new FormData()
                produtos.append('produtos', JSON.stringify(produto));
                produtos.append('venda_id', data.id);
                fetch('/insertprodutosvendidos', {
                    method: 'POST',
                    headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
                    body: produtos
                })
                .then(function(res){ return res.json(); })
                .then((data => {
                    console.log("Foi");
                    window.location.href = "/";
                }))

            }))
    }
})


let countPrice = 0.00
document.querySelector('.product-form').addEventListener('keyup', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault()
        codebar = this.value
        this.value = '';
        //Busca do produto na url, para fazer a listagem na tabela

        fetch('api/find-product/'+ codebar)
        .then((response => response.json()))
        .then((responseData => {
            let count = document.querySelector('.count-product');
            if(responseData) {
                countPrice = countPrice + parseFloat(responseData.price);
                console.log(countPrice)
                let numero = parseInt(count.textContent) + 1;
                //Checando se já tem o produto na lista
                if(produto.hasOwnProperty(responseData.identification_number) == false) {
                    produto[responseData.identification_number] = 1
                } else {
                    produto[responseData.identification_number] = produto[responseData.identification_number] + 1 || 1
                }
                console.log(JSON.stringify(produto));
                /**
                 * Criação do produto na tabela;
                 */


                 document.querySelector('.nova-venda').style.display = 'flex' //Exibir o cabeçalho da tabela


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
                createProduct.appendChild(createCod)
                createProduct.appendChild(createProd)
                createProduct.appendChild(createPrice)

                document.querySelector(".p").appendChild(createProduct)
                /**
                 * Função para manter o scroll dos produtos sempre em baixo
                 */
                el = document.querySelector('.p')
                var height = el.scrollHeight;
                el.scrollTop = height;
                count = count + responseData.price

                document.querySelector('.warnerror').style.display = "none";

                let textSubmit = "Produto:"+ responseData.name+" | Preço: "+ responseData.price;
                document.querySelector('.warn').innerHTML = textSubmit;
                document.querySelector('.warn').style.display = "block";

                document.querySelector('.count-product').innerHTML = numero;
                document.querySelector('.total-price').innerHTML = countPrice.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

            } else {
                /**
                 * Popup será inserido para mostrar que o produto não existe
                 */
                let textSubmit = "O produto inserido não existe";
                document.querySelector('.warn').style.display = "none";
                document.querySelector('.warnerror').innerHTML = textSubmit;
                document.querySelector('.warnerror').style.display = "block";
            }



        }))
    }
})


/**
 * Função para descer o menu ao clicar na categoria atual quando estiver pelo celular
 */


