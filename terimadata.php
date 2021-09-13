<?php
$konek = mysqli_connect("localhost", "Khoirul", "Khoirul", "sister");

// baca data yg dikirim nodmcu
$stringData = $_GET["sData"];

$hum = substr($stringData, 0, 2);
$temperatur = substr($stringData, 2, 2);


// update data db
mysqli_query($konek, "INSERT INTO sensor (temperatur,humidy) VALUES('$temperatur','$hum')");
