<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      

      function drawChart() {
        
        var data = google.visualization.arrayToDataTable([['Id', 'Učenje', 'Fitnes'],
            @php
                foreach($posts as $post) {
                    echo "['".$post['id']."', ".$post['ure'].",".$post['fit']."],";
                }
            @endphp
    ]);

        var options = {
          title: 'Podatki',
          hAxis: {title: 'Dan/post',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
  
</html>
