<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php
    use Illuminate\Http\Request;
        if(isset($_POST['submit'])){
            if(!empty($_POST['Fruit'])){
                foreach($_POST['Fruit'] as $selected){
                    $test = $selected;
                }
            }
        }
    ?>

    <form action="" method="post">
        @csrf
        <select name="Fruit[]" multiple>
            <option value="" disabled selected>Choose option</option>
            <option value="test">test</option>
            <option value="abcd">abcd</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>

        <input type="submit" value="submit" name="submit">
    </form>

    <br><br>
    <?php foreach($users as $user): ?>
    <?php if($user->option != $test) continue; ?>
    <br><br>

        <button onclick="data('<?php echo $user->name;?>')">{{$user->name}}</button>


    <?php endforeach; ?>
    <br><br>
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    
    <script type="text/javascript">
    
    function data(buttonUser){
        $ime = buttonUser;
        document.cookie = "js_var_value = " + $ime;
        <?php
        $php_var_val= $_COOKIE['js_var_value'];
        echo("console.log('PHP: " . $php_var_val . "');");
        ?>
        window.location.reload()
    }  
    

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([[{type: 'number', label: 'Id'}, {type: 'number', label: 'Učenje'}, {type: 'number', label: 'Fitnes'}],
        <?php
        foreach($posts as $post) {
            
            if($post->user->name == $php_var_val){
                echo "['".$post['id']."', ".$post['ure'].",".$post['fit']."],";
            }
        }
        ?>
    ]);

    var options = {
        title: 'Podatki',
        hAxis: {title: 'Dan/post', titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
      
    </script>

    <div id="chart_div" style="width: 100%; height: 500px;"></div>
    
    
    <br><br>
    <form action="/" method="GET">
        <button>Back</button>
    </form>
</body>
</html>