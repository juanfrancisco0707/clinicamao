<?php
require "conexion.php";

$sql = "SELECT id, grado FROM grados";
$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
</head>

<body>
    <h2>Genera reporte de alumnos</h2>
    <form action="reporte.php" method="post" autocomplete="off">
        Ingresa el grado
        <select id="grado" name="grado">
            <option value="">Selecciona una opcion</option>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <option value="<?php echo $fila['id']; ?>"><?php echo $fila['grado']; ?></option>
            <?php } ?>
        </select>
        <br />
        <button type="submit">Generar</button>
    </form>
</body>
</html>