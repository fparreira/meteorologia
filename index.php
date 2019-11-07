<!DOCTYPE html>
<html>
    <head>    
        <title>EstaçãoMeteorológica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="animate.css-master/animate.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap-3.3.7-dist (2)/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <script src="Chart.js-master/samples/utils.js" type="text/javascript"></script>
        <link href="animate.css-master/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="animate.css-master/animate.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="animate.css-master/"/>
        <script src="moment.min.js" type="text/javascript"></script>
        <script src="Chart.min.js" type="text/javascript"></script>
       <!--   <script src="utils.js" type="text/javascript"></script>-->



        <style>
            .temp{
                width:130px;
                height:130px;
                border-radius:50%;
                border:3px solid #000;
                z-index:5;
                background:lightgray;
            }
            .umi{
                width:140px;
                height:140px;
                border-radius:50%;
                border:3px solid #000;
                z-index:5;
                background:lightgray;
            }
            .table{
                width:40%;
                border: ridge;
                border-color: lightgrey;

            }
            body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
            body, html {
                height: 100%;
                color: #777;
                line-height: 1.8;

            }


            /* Create a Parallax Effect */
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* First image (Logo. Full height) */
            .bgimg-1 {
                background-color: #0ecb70;
                min-height: 15%;
            }

            /* Second image (Portfolio) */
            .bgimg-2 {
                background-image: url("/w3images/parallax2.jpg");
                min-height: 400px;


            }

            /* Third image (Contact) 
            .bgimg-3 {
              background-image: url("");
              min-height: 400px;
            }*/

            .w3-wide {letter-spacing: 5px;}
            .w3-hover-opacity {cursor: pointer;}


            /* Turn off parallax scrolling for tablets and phones */
            @media only screen and (max-device-width: 700px) {
                .bgimg-1, .bgimg-2, .bgimg-3 {
                    background-attachment: scroll;
                    min-height: 350px;
                }
            }
        </style>
    </head>
    <body>


        <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
            <div class="w3-display-middle" style="white-space:nowrap;">
                <span class="w3-center  w3-xlarge w3-wide w3-animate-opacity"><span style="color: white; font-size: 30px">ESTAÇÃO METEOROLÓGICA - INSTITUTO FEDERAL CAMPUS VOTUPORANGA</span>
            </div>
        </div>

        <!--<div class="container"> -->
        <div style="margin: 2%;">
            <div class="umi box animated bounce" style="float: left; margin-right: 40%;margin-left: 10%;">
                <h3 style="margin: 11%; margin-bottom: 7%;text-align: center;float:left;color: black;font-size: 19px; ">Temperatura</h3>
                <h3 style="text-align: center;">
                    <?php
                    include_once ('conexao.php');

                    $sql = "SELECT max(maxima_t) t FROM maxima_minima ";
                    $result = pg_query($sql); //Executar a SQL
                    $dado = pg_fetch_assoc($result);
                    $t = $dado['t'];
                    echo "<div style='font-weight: bold; color: black'><p>$t ºC</p></div>";
                    ?>


                </h3>
            </div>

             <div class="umi" style="float: right; margin-right: 10%">
                <h3 style="margin-left:25%;margin-right: 50%;text-align: center;float:left;color: black;font-size: 22px; ">Chuva</h3>
                <h3 style="text-align: center;">
                    <?php
                    $sql = "SELECT max(maxima_p) p FROM maxima_minima ";
                    $result = pg_query($sql); //Executar a SQL
                    $dado = pg_fetch_assoc($result);
                    $p = $dado['p'];
                    echo "<span style='font-weight: bold;color: black;text-align: center; font-size: 25px'><p>$p mm</p></span>";
                    ?>
                </h3>
            </div>
            
           
                  <div class="umi" style="float: left; margin-left: -12%">
                <h3 style="margin-left:19%;margin-right: 50%;text-align: center;float:left;color: black;font-size: 20px; ">Umidade</h3>
                <h3 style="text-align: center;">
                    <?php
                    $sql = "SELECT max(max_u) u FROM maxima_minima ";
                   
                    $result = pg_query($sql); //Executar a SQL
                    $dado = pg_fetch_assoc($result);
                    $u = $dado['u'];
                    echo "<span style='font-weight: bold;color: black;text-align: center; font-size: 25px'><p>$u%</p></span>";
                    ?>
                </h3>
            </div>
            <!-- Navbar on small screens -->

        </div>
        <br><br><br>
        <br>




        <div style="width:100%;clear: both; ">


            <div class="form-group">

                <div style="width:40%; float:left;margin-left: 5%;">
                    <strong><label style="margin-left: 15%;font-size: 20px;"> Temperatura (ºC) e Umidade relativa do ar (%) durante o período de 24 horas</label></strong>               
                    <canvas id="curve_chart" style="width: 900px; height: 500px"></canvas>
                </div>
            </div>

            <div style="width:40%; float:right;margin-right: 5%; " >
                <strong><label style="margin-left: 15%;font-size: 20px;">  Chuva em milímitros durante o período de 24 horas</label></strong>
                <canvas id="canvas"> </canvas>  
            </div>
            <br><br>
        </div>
        <br>
        <!-- <div class="col-md-12 fundo" align="center">  
            <a href="index.php"><button>Atualizar</button></a>
        </div>--> 



        <script src="jquery-1.12.4.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>



        <script>
            //var dataset = new Array();
            var dataset = "";
            function iniciaValores() {
                //mostra o grafico na tela
                var ctx = document.getElementById("curve_chart").getContext("2d");
                window.myLinee = new Chart(ctx, config);
                //window.myLine2 = new Chart(ctx, config2);
                //Capturar Dados Usando AJAX
                $.ajax({
                    async: true,
                    crossDomain: true,
                    url: "dadosTemp.php",
                    type: "post",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json"
                }).success(function (retorno) {
                    //imprimi os dados que veio do ajax
                    // console.log(retorno);
                    //Laço para adicinar os dados no grafico
                    for (var i = 0; i < retorno.length; i++) {

                        console.log('erro=>');                        
                        // console.log({x: retorno[i].x, y: retorno[i].y});
                        console.log({x: retorno[i].x, y: parseInt(retorno[i].y)});
                        // // console.log({x: retorno[i].x, y: retorno[i].y});
                        // console.log('ok=>');                        
                        // console.log({x: "2019-11-07 "+i+":00:22.911535", y: retorno[i].y});

                        // console.log(myLinee.data.datasets[0]);

                        //x é o tempo e y o valor da temperatura
                        // myLinee.data.datasets[0].data.push({x: retorno[i].x, y: retorno[i].y});
                        myLinee.data.datasets[0].data.push({x: retorno[i].x, y: parseInt(retorno[i].y)});
                        // myLinee.data.datasets[0].data.push({x: "2019-11-07 "+i+":00:22.911535", y: retorno[i].y});

                        //linha ok funcionando
                        // myLinee.data.datasets[0].data.push({ x: i, y: Math.floor(Math.random()*10) });


                        //atualiza o grafico para mostrar os novos dados
                        myLinee.update();
                    }

                }).fail(function (textStatus) {
                    console.log("Request failed: " + textStatus);
                });



            }

            var timeFormat = 'YYYY/MM/DDTHH:mm:ss.SSS'; // formato da data


            // configuração do grafico          
            var config = {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: 'Temperatura',
                            datasets: [{}],
                            fill: false,
                            borderColor: 'red',

                        },
                        {
                            label: "Umidade",
                            datasets: [{}],
                            fill: false,
                            borderColor: 'green',
                        }

                    ]

                },
                options: {
                    responsive: true,
                    title: {
                        display: true,

                        text: "Temperatura e Umidade Relativa do Ar",

                    },
                    scales: {
                        xAxes: [{
                                type: "time",
                                time: {
                                    tooltipFormat: 'll',
                                    stepSize: '1',

                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Horário',

                                }
                            }],
                        yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Temperatura (ºC)'
                                }
                            }]
                    }
                }
            };








            
            var config2 = {
                type: 'line',
                data: {
                    datasets: [
                        {
                            label: "Precipitação",
                            datasets: [{}],
                            fill: false,
                            borderColor: 'blue',

                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: "Precipitação"
                    },
                    scales: {
                        xAxes: [{
                                type: "time",
                                time: {
                                    format: timeFormat,
                                    tooltipFormat: 'll'
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Horário'
                                }
                            }],
                        yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Umidade (%)'
                                }
                            }]
                    }
                }
            };
            var configDoug = {
                type: 'doughnut',
                data: {
                    datasets: [{
                            data: [
                            ],
                            backgroundColor: [
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        'Maxima',
                        'Minima'
                    ]
                },
                options: {
                    responsive: true,
                    legend: {

                    },
                    title: {
                        display: true,
                        text: 'Precipitação'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };


            window.onload = function () {
                iniciaValores();
            };
        </script>
        <!-- Container (About Section) -->


        <!-- Second Parallax Image with Portfolio Text -->


        <!-- Container (Portfolio Section) -->


        <!-- Modal for full size images on click-->
        <div id="modal01" class="w3-modal w3-black" onclick="this.style.display = 'none'">
            <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>

        </div>


        <table class="table">
            <tr>
                <td></td>
            <strong><td style="text-align: center;">Temperatura</td></strong>
            <strong> <td style="text-align: center;">Umidade</td></strong>
            <strong>  <td style="text-align: center;">Precipitação</td></strong>
        </tr>
        <?php
        require_once('conexao.php');

//$sql = "select * from estacaometeorologica";
      //  $sql = "select * from media";

        $sql = "SELECT * as  data_hora from maxima_minima 
        WHERE data_hora > current_timestamp - interval '12 hours'";
        $result = pg_query($sql); //Executsar a SQL
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>
                            <td></td>
                    <td style='text-align: center'>" . $row['media_t'] . "</td>
                    <td style='text-align: center'>" . $row['media_u'] . "</td>
                    <td style='text-align: center'>" . $row['media_p'] . "</td>
                        <td></td>
                    </tr>";
        }
        ?>
    </table>
        <br>
        <br>
        <br>
        <br>
   
  
 

    <a href="tabelaest.php" style="color: darkblue;">Tabela</a>
    <!-- DIV CONTAINER </div> -->
    <!-- Footer -->
    <footer class="w3-center w3-black w3-padding-32 ">

        <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
        <div class="w3-xlarge w3-section">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
    </footer>


</body>
</html>
