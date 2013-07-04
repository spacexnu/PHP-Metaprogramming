<?php
require 'OtherCar.php';

$car = new Car ( 'Uno', '1995' );

$car->start ();

$str = '$carro->buzinar = function() {';
$str .= "echo \"fom fom \n\";";
$str .= "};";

eval ( $str );

$fun = function() {
	echo "faz alguma coisa";
};

$car->algumaCoisa = $fun;


$car->buzinar ();
$car->freiar ();
$car->algumaCoisa();

?>