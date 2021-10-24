<?php
// Initialize the session
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado vacunas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
             <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">CITA</h2>
                </div>
                <?php
                // Include config file
                require_once "config/configuracion.php";
                // Attempt select query execution
                $sql = "SELECT u.nombre, u.id, c.localizacion, c.fechacitacion
                FROM cita c
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE usuario_id = $_SESSION[id]";
                if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Localizacion</th>";
                            echo "<th>Fecha de Citacion</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $result->fetch_array()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['localizacion'] . "</td>";
                                echo "<td>" . $row['fechacitacion'] . "</td>";
                                echo "<td>";
                                echo '<a href="archivoCita.php?id='. $row['id'] .'" class="mr-3" title="Detalles" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="deleteCita.php?id='. $row['id'] .'" title="Borrar" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';

                            }
                            // Free result set
                            $result->free();
                        }else{
                            echo '<div class="alert alert-danger"><em>No se encontraron registros.</em></div>';
                        }
                    } else{
                        echo "Oops! Algo fue mal. Please try again later.";
                    }



                // Close connection
                $mysqli->close();
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>