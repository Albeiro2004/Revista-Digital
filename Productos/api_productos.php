<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Permite peticiones desde cualquier origen
header("Access-Control-Allow-Methods: GET, POST"); // Permite estos métodos

/*include './conexion/conexion.php';*/ // Asegúrate que sea la ruta correcta

try {
    $conexion = new mysqli("bp0crvzunqnpxlmelgi5-mysql.services.clever-cloud.com",
                       "u4aoh5hhhu3ccxcd", "GvDtABczwxtqsHvvhnXl", "bp0crvzunqnpxlmelgi5");
    
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        throw new Exception("Error en consulta: " . $conexion->error);
    }

    $productos = [];
    while ($producto = $resultado->fetch_assoc()) {
        $productos[] = $producto;
    }

    echo json_encode([
        'success' => true,
        'data' => $productos
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} finally {
    if (isset($conexion)) {
        $conexion->close();
    }
}
?>
