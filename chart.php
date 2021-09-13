<?php
$koneksi    = mysqli_connect("localhost", "Khoirul", "Khoirul", "inkubator");
$hasil      = mysqli_query($koneksi, "SELECT temperatur FROM sensor");
$humidy   = mysqli_query($koneksi, "SELECT humidy FROM sensor");
$waktu   = mysqli_query($koneksi, "SELECT waktu FROM sensor");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart</title>
    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<body>
    <a href="index.php" class="btn btn-outline-warning col-12 my-5 fs-1 text-orange fw-bold" style="font-size:16px">HOME</a>
    <canvas id="myChart"></canvas>
    <script>
        //function agar memanggil data secara berkala
        function realtime() {
            setInterval(function() {
                fetch('ambildata.php').then(function(response) {
                    return response.json();
                }).then(function(data) {
                    // document.getElementById('viewCount').textContent = data.viewCount;
                    tambah();
                    // keadaan();
                }).catch(function(error) {
                    console.log(error);
                });
            }, 500);
        }
        document.addEventListener('DOMContentLoaded', function() {
            realtime();
        });

        //pembautan line chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [<?php while ($row = $waktu->fetch_assoc()) {
                                echo $row['waktu'] . ",";
                            } ?>],
                datasets: [{
                    label: 'Temperatur',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [<?php while ($row = $hasil->fetch_assoc()) {
                                echo $row['temperatur'] . ",";
                            } ?>]
                }, {
                    label: 'Humidy',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: '#5dbafc',
                    borderColor: '#5dbafc',
                    data: [<?php while ($isi = $humidy->fetch_assoc()) {
                                echo $isi['humidy'] . ",";
                            } ?>]
                }]
            },

            // Configuration options go here
            options: {
                legend: {
                    display: true
                },
                barValueSpacing: 10,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            stepSize: 5
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)"
                        }
                    }]
                }
            }
        });

        //pengambilan data lalu menambah ke chart
        function tambah() {
            $.ajax({
                type: 'GET',
                url: "ambildata.php",
                data: '',
                cache: false,
                success: function(data) {
                    var hasil = JSON.parse(data);
                    chart.data.labels.push(hasil['waktu']);
                    chart.data.datasets[0].data.push(hasil['temperatur']);
                    chart.data.datasets[1].data.push(hasil['humidy']);
                    chart.update();
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    </script>
</body>

</html>