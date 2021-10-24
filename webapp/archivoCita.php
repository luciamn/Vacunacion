<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config/configuracion.php";

    // Prepare a select statement
    $sql = "SELECT * FROM cita WHERE usuario_id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve individual field value
                $fechacitacion = $row["fechacitacion"];
                $localizacion = $row["localizacion"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Algo fue mal. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
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
        #logo{
            float: right;
            width: 10%;
        }
        h3{
            margin-top: 10px;

        }
        .caja{
            margin-top: 30px;
            border: 1px solid black;
            border-radius: 10px;
        }
        #tick{
            height: auto;
            display: inline-block;
            margin-right: auto;
            margin-left: auto;
            display: block;
            width: 17%;
            margin-top: 10%;
        }
        img{
            border: 0;
            vertical-align: middle;
        }
        h2{
            margin-left: 37%;
            margin-top: 5px;
            color: #009933;
        }
        h5{
            color: grey;
        }
        .form-group{
            text-align: center;
        }



    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <img src="img/logo_comunidad_de_madrid_1.jpg" id="logo">
        <h3>Servicio Madrileño de Salud <br>
            CONSEJERIA DE SANIDAD
        </h3>
    </div>
</div>
<div class="container">
    <h5>Bienvenido al sistema de citación contra el SARS-COV-2(COVID-19)</h5>
    <div class="caja">
        <div class="form-group">
            <label>Fecha</label>
            <p><b><?php echo $row["fechacitacion"]; ?></b></p>
        </div>
        <div class="form-group">
            <label>Localizacion</label>
            <p><b><?php echo $row["localizacion"]; ?></b></p>
        </div>
    </div>
    <img src="img/green-checkmark-transparent-17.png" id="tick">
    <h2>La cita fue confimada</h2>
    <p><a href="cita.php" class="btn btn-primary">Back</a></p>
</div>
</body>
</html>