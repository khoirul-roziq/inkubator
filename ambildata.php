<?php
// koneksi db
$konek = mysqli_connect("localhost", "Khoirul", "Khoirul", "inkubator");

// baca isi tabel sensor

$hasil = mysqli_query($konek, "SELECT * FROM sensor ORDER BY waktu DESC LIMIT 1");
$data = mysqli_fetch_assoc($hasil);

echo json_encode($data);
