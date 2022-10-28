
//Buscando com o fetch as vendas dos ultimos 30 dias
fetch('dashboard/get-last-days')
.then((response => response.json()))
.then((responseData => {
    const labels = []

    const ctx = document.getElementById('myChart').getContext("2d")

    const gradient = ctx.createLinearGradient(0,0,50,400)
    gradient.addColorStop(0, '#5cffca')
    gradient.addColorStop(1, '#66ff')



    const data = {
        labels,
        datasets: [{
            data: [],
            label: "Vendas",
            fill: true,
            backgroundColor:gradient
        }]
    }

    responseData.forEach(item=>{
        data.labels.push(item.day)
        data.datasets[0].data.push(item.Day_count)
    })
    console.log(data)

    const config = {
        type: 'line',
        data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            radius:4,
            hoverRadius:10,
        }
    }

    const myChart = new Chart(ctx,config)

}))










    //Obtenção dos dados bestSellers

fetch('dashboard/get-best-sellers')
.then((response => response.json()))
.then((responseData => {

    const labels = [];
    const datachart = {
        labels,
        datasets: [{
        label: 'Produtos mais vendidos',
        data: [],
        backgroundColor: [
        ],
        hoverOffset: 4
        }]
    };

    if(responseData.length > 0) {
        responseData.forEach(item=>{
            datachart.labels.push(item.name)
            datachart.datasets[0].data.push(item.qt_vendas)

            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            };

            datachart.datasets[0].backgroundColor.push(dynamicColors())

        })
    } else {
        datachart.labels.push('Nenhum')
        datachart.datasets[0].data.push(1)
        datachart.datasets[0].backgroundColor.push('rgb(144,238,144)')
    }

    console.log(datachart.labels)

    //Criação do gráfico
    const ctx2 = document.getElementById('myChartbestsellers').getContext("2d")

    const configchart = {
        type: 'doughnut',
        data: datachart,
        options: {
            responsive: true,
            maintainAspectRatio: false,

        }
    };

    //Geração dos gráfico bestSellers
    const myChartb = new Chart(ctx2,configchart)

}))



