<?php
include "../../php/conexion.php";


$sql = "SELECT * FROM usuarios";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['nombre_usuario'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nombre_usuario'], ENT_QUOTES, 'UTF-8') . "</option>";
    }
} else {
    echo "<option value=''>No hay usuarios disponibles</option>";
}

?>