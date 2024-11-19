<?php 
$servidor="localhost";
$usuario="root";
$password="";
$nombre_bd="arciniega";

$conexion=mysqli_connect($servidor ,$usuario , $password , $nombre_bd);
 if(!$conexion){
echo "Error en la conexion :" . mysqli_connect_error() ;
 }
 