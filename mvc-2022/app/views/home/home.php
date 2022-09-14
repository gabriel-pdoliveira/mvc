<?php if ( ! defined('URL_BASE')) exit; ?>


<?php echo "<h1>Dashboard"?>

<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['date', 'Entrada', "Saída"],

            <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $consulta=$pdo->prepare($query);
            $consulta->execute();
            $estáticoOUT=0;

            foreach ($consulta as $mostra) {
            
            $date=$mostra['date'];
            $valor=$mostra['value'];
            $type=$mostra['type'];
            ?>

            <?php
            if ( $type=="input") {
                
            ?>

            ['<?php echo $date;?>', <?php echo $estáticoIN=$valor;?>, <?php echo $estáticoOUT;?>],

            <?php 
            }
            else if($type=="output"){
                ?>
                ['<?php echo $date;?>',<?php echo $estáticoIN;?>, <?php echo $estáticoOUT=$valor;?>],

                <?php
            }
            }
            ?>
            
          
        ]);


        var options = {
          title: 'Gráfico de movimentos',
          curveType: 'function',
          legend: { position: 'rigth' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);

        
      }

      let saldo=0;
            <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $consulta=$pdo->prepare($query);
            $consulta->execute();
            
            foreach ($consulta as $mostra) {
            
                $valor=$mostra['value'];
                $type=$mostra['type'];
                
                if ( $type=="input") { ?>
                    saldo+=<?php echo $valor?>;
                 <?php   
                }
                else if($type=="output"){?>
                    saldo-=<?php echo $valor?>; <?php
                }
                }
          ?>
            console.log(saldo);
            document.querySelector("#saldo").innerText="oi";
    </script>
  </head>
  <body>
    <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title" id="saldo"></h5>
        </div>
    </div>
    <div id="curve_chart" style="width: 1250px; height: 500px"></div>
  </body>
</html>
