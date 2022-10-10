


//Mostrar produto pesquisado pelo codigo de barras na sessão PRODUTOS

 document.querySelector('.product-form').addEventListener('keyup', function(e) {
    if(e.keyCode == 13) {
        codebar = this.value
        fetch('api/find-product/'+ codebar)
        .then((response => response.json()))
        .then((responseData => {

            cleanElements = document.querySelector(".item");

            if(cleanElements) {
                cleanElements.remove()
            }
            createProduct = document.createElement('tr')
            createProduct.className = 'item'
            txtCod = document.createTextNode(responseData.identification_number)
            txtName = document.createTextNode(responseData.name)
            txtPrice = document.createTextNode(responseData.price)
            txtQuantity = document.createTextNode(responseData.quantity)

            linkAlter = document.createElement('a')
            linkRemove = document.createElement('a')
            txtActionAlter = document.createTextNode('Alterar')
            txtActionRemove = document.createTextNode('Remover')
            linkAlter.appendChild(txtActionAlter)
            linkRemove.appendChild(txtActionRemove)
            linkAlter.className = 'alterButt'
            linkRemove.className = 'removeButt'


            createCod = document.createElement('td')
            createCod.appendChild(txtCod)

            createProd = document.createElement('td')
            createProd.appendChild(txtName)

            createPrice = document.createElement('td')
            createPrice.appendChild(txtPrice)

            createQuantity = document.createElement('td')
            createQuantity.appendChild(txtQuantity)

            createAction = document.createElement('td')
            createAction.appendChild(linkAlter)
            createAction.appendChild(linkRemove)

            createProduct.appendChild(createCod)
            createProduct.appendChild(createProd)
            createProduct.appendChild(createPrice)
            createProduct.appendChild(createQuantity);
            createProduct.appendChild(createAction);


            document.querySelector(".p").appendChild(createProduct)
            /**
             * Função para manter o scroll dos produtos sempre em baixo
             */
            el = document.querySelector('.p')
            var height = el.scrollHeight;
            el.scrollTop = height;





        }))
    }
})

document.querySelectorAll('.normalelement').forEach(item=>{
    let id = item.closest('.normalelement').getAttribute('data-id');
    if(id % 2 == 0) {
        item.className = "oddelement";
    }
})
