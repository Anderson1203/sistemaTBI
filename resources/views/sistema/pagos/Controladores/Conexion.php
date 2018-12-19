<?php
$usuario = "root";
$contrasena = "";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
$servidor = "localhost";
$basededatos = "administracioncti";

$mysqli = new MySQLi("localhost", "root","", "administracioncti");
if ($mysqli -> connect_errno) {
  die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno()
    . ") " . $mysqli -> mysqli_connect_error());
}

 ?>
