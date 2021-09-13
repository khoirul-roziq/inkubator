<!DOCTYPE html>
<html>

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <style>
    * {
      font-size: 16px;
    }

    .page {
      max-width: 500px;
      margin: auto auto;
    }

    .kotak {
      display: flex;
    }

    .kotak>img {
      width: 100px;
    }

    .kotak>.judul {
      font-size: 20px;
      font-weight: bold;
      color: #ffc107;
      flex: 1;
      text-align: center;
      align-self: center;
    }
  </style>
</head>

<body>
  <div class="page">
    <div class="kotak">
      <img src="https://1.bp.blogspot.com/-IC3Mc1nmQ-0/XxhVTV1xGTI/AAAAAAAACxM/Q9QlL_EpvgkpxKxqACtWkK4xCzVAj8eogCLcBGAsYHQ/s1600/LOGO%2BITERA%2BPNG%2BHD.png" alt="">
      <div class="judul fs-1 text-orange fw-bold">Inkubator Telur Ayam</div>
      <img src="https://1.bp.blogspot.com/-IC3Mc1nmQ-0/XxhVTV1xGTI/AAAAAAAACxM/Q9QlL_EpvgkpxKxqACtWkK4xCzVAj8eogCLcBGAsYHQ/s1600/LOGO%2BITERA%2BPNG%2BHD.png" alt="">
    </div>
    <!-- <iframe src="chart.php" width="100%"></iframe> -->
    <a href="chart.php" class="btn btn-outline-warning col-12 my-5 fs-3 text-orange fw-bold">LIHAT GRAFIK</a>
    <div class="row">
      <div class="col-sm-6">
        <div class="card text-danger border-danger">
          <div class="card-body">
            <h5 class="card-title text-center fs-3">Temperatur</h5>
            <p class="card-text fs-1 text-center" id="cel"></p>
            <!-- <a href="#" class="btn btn-outline-danger">Go somewhere</a> -->
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card text-info border-info">
          <div class="card-body">
            <h5 class="card-title text-center fs-3">Kelembapan</h5>
            <p class="card-text fs-1 text-center" id="hum"></p>
            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function realtime() {
      setInterval(function() {
        fetch('ambildata.php').then(function(response) {
          return response.json();
        }).then(function(data) {
          // document.getElementById('viewCount').textContent = data.viewCount;
          // tambah();
          keadaan();
        }).catch(function(error) {
          console.log(error);
        });
      }, 500);
    }
    document.addEventListener('DOMContentLoaded', function() {
      realtime();
    });

    function keadaan() {
      $.ajax({
        type: 'GET',
        url: "ambildata.php",
        data: '',
        cache: false,
        success: function(data) {
          var hasil = JSON.parse(data);
          document.getElementById("cel").textContent = hasil['temperatur'] + "'C";
          document.getElementById("hum").textContent = hasil['humidy'] + '%';
        },
        error: function(response) {
          console.log(response.responseText);
        }
      });
    }
  </script>
</body>

</html>