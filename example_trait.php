<?php
require 'CarrUseTrait.php';

$car = new Car ( 'Uno', '1995' );

$car->start ();
$car->createNewMethod ( 'honk', null, ' return "fom fom\n";' );
echo $car->honk ( 1, 2 );

$car->createNewMethod ( 'break', NULL, 'echo \'breaking \' . $this->modelo;' );
$car->break ();

?>