<?php
$conexion = new mysqli("bp0crvzunqnpxlmelgi5-mysql.services.clever-cloud.com",
                       "u4aoh5hhhu3ccxcd", "GvDtABczwxtqsHvvhnXl", "bp0crvzunqnpxlmelgi5");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
