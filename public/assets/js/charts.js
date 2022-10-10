google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["DayOfMonth", "Vendas", { role: "style" } ],
      ["01", 9, "#b87333"],
      ["02", 15, "silver"],
      ["04", 15, "gold"],
      ["03", 15, "gold"],
      ["05", 15, "gold"],
      ["06", 15, "gold"],
      ["07", 15, "gold"],
      ["08", 15, "gold"],
      ["04", 15, "gold"],
      ["04", 15, "gold"],
      ["04", 100, "color: #e5e4e2; border-radius: 10px;"],
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "Vendas no ultimo mês",
      bar: {groupWidth: "95%"},
      backgroundColor: '#eaf4f4',
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
    chart.draw(view, options);
}
