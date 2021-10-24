<?php
// Include config file

session_start();

require_once "config/configuracion.php";

// Define variables and initialize with empty values
$cipa = $nombre = $dni = $fechadenacimiento = "";
$fechacitacion = $localizacion = $vacuna = "";
$cipa_err = $nombre_err = $dni_err = $fechadenacimiento_err = "";
$fechacitacion_err = $localizacion_err = $vacuna_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate cipa
    $input_cipa = trim($_POST["cipa"]);
    if(empty($input_cipa)){
        $cipa_err = "Please enter a apellidos.";
    } elseif(!filter_var($input_cipa, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $cipa_err = "Please enter a valid name.";
    } else{
        $cipa = $input_cipa;
    }

    //Validate fecha de nacimiento
    function validar_fecha($fecha){
        $valores = explode('/', $fecha);
        if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
            return true;
        }
        return false;
    }

    $input_fechadenacimiento = trim($_POST["fechadenacimiento"]);
    if(empty($input_fechadenacimiento)){
        $fechadenacimiento_err = "Please enter a apellidos.";
    } elseif(validar_fecha($fechadenacimiento)){
        $fechadenacimiento_err = "Please enter a valid name.";
    } else{
        $fechadenacimiento = $input_fechadenacimiento;
    }
    //Validate fecha de citacion
    $input_fechacitacion = trim($_POST["fechacitacion"]);
    if(empty($input_fechacitacion)){
        $fechacitacion_err = "Please enter a apellidos.";
    } elseif(validar_fecha($fechacitacion)){
        $fechacitacion_err = "Please enter a valid name.";
    } else{
        $fechacitacion = $input_fechacitacion;
    }

    //validate localizacion
    $input_localizacion = trim($_POST["localizacion"]);
    if(empty($input_localizacion)){
        $localizacion_err = "Please enter a name.";
    } elseif(!filter_var($input_localizacion, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $localizacion_err = "Please enter a valid name.";
    } else{
        $localizacion= $input_localizacion;
    }

    //validate vacuna
    $input_vacuna = trim($_POST["vacuna"]);
    if(empty($input_vacuna)){
        $vacuna_err = "Please enter a name.";
    } elseif(!filter_var($input_vacuna, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $vacuna_err = "Please enter a valid name.";
    } else{
        $vacuna = $input_vacuna;
    }


    // Check input errors before inserting in database
    if(empty($cipa_err)  && empty($fechadenacimiento_err)  && empty($fechacitacion_err) && empty($localizacion_err) && empty($vacuna_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO cita (usuario_id, cipa, fechadenacimiento, fechacitacion, localizacion, vacuna) VALUES (?, ?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("isssss", $param_id_usuario,  $param_cipa, $param_fechadenacimiento, $param_fechacitacion, $param_localizacion, $param_vacuna);

            // Set parameters
            $param_id_usuario = $_SESSION['id'];
            $param_cipa = $cipa;
            $param_fechadenacimiento = $fechadenacimiento;
            $param_fechacitacion = $fechacitacion;
            $param_localizacion = $localizacion;
            $param_vacuna = $vacuna;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                header("location: cita.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .izquierda{
            background-color: white;
            box-shadow: 10px 10px 5px grey;
            height: auto;
            margin-left: 15%;
            opacity: 0.8
        }
        .derecha{
            background-color:#66ccff ;
            box-shadow: 10px 10px 5px grey;
            opacity: 0.8
        }

        .img-responsive {
            height: auto;
            display: inline-block;
            margin-right: auto;
            margin-left: auto;
            display: block;
        }

        body{ font: 14px sans-serif;
            background-image: url('img/vacuna-rusa-sputnik-v-contra-covid-19-tambien-reporta-90-de-efectividad.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        .container{
            margin-right: auto;
            margin-left: auto;
            display: block;
            margin-top: 20px;
        }

        img {
            border: 0;
            vertical-align: middle;
        }
        .button{
            background-color: #66ccff;
            border-radius: 4px;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            width: 48%;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }

        #citacion{
            color: white;
            margin-top: 150px;
            margin-bottom: 150px;
            font-family: sans-serif;
            text-align: center;
        }
        a{
            margin-right: 40px;
        }
        form{
            margin-top: -10%;
        }
        .tituloForm{
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="m-0 vh-100 row justify-content-center align-items-center">

<div class="container">
    <div class="row">
        <div class="izquierda col-xs-12 col-md-4">
            <img alt="Sacyl" src="img/Saludmadrid.jpg" class="img-responsive img-login-xs" width="40%">
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                <div class="form-row col-xs-12">
                    <div class="form-group col-md-6">
                        <label>CIPA</label>
                        <a href=    "https://www.abc.es/sociedad/abci-que-es-cipa-como-saber-numero-nsv-202107121219_noticia.html">Que es el CIPA</a>
                        <input type="text" class="form-control <?php echo (!empty($cipa_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cipa; ?>" id="cipa" name="cipa" placeholder="cipa" required >
                        <span class="invalid-feedback"><?php echo $cipa_err;?></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Fecha de nacimiento</label>
                        <input type="date" class="form-control <?php echo (!empty($fechadenacimiento_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fechadenacimiento; ?>" id="fechadenacimiento" name="fechadenacimiento" placeholder="Fecha de nacimiento" required >
                        <span class="invalid-feedback"><?php echo $fechadenacimiento_err;?></span>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Fecha de Citacion</label>
                        <input type="date" class="form-control <?php echo (!empty($fechacitacion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fechacitacion; ?>" id="fechacitacion" name="fechacitacion" placeholder="Fecha de citacion" required >
                        <span class="invalid-feedback"><?php echo $fechacitacion_err;?></span>
                    </div>

                    <div class="form-group col-md-6">
                        <select class="custom-select <?php echo (!empty($localizacion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $localizacion; ?>" id="localizacion" name="localizacion" required>
                            <option selected>Localizacion</option>
                            <option value="Hospital Enfermera Isabel Zendal">Hospital Enfermera Isabel Zendal</option>
                            <option value="Hospital Gregorio Maranon">Hospital Gregorio Maranon</option>
                            <option value="Wanda Metropolitano">Wanda Metropolitano</option>
                            <option value="Wizink Center">Wizink Center</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $localizacion_err;?></span>
                    </div>

                    <div class="form-group col-md-6">
                        <select class="custom-select <?php echo (!empty($vacuna_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $vacuna; ?>" id="vacuna" name="vacuna" required>
                            <option selected>Vacunas</option>
                            <option value="pfizer">Pfizer</option>
                            <option value="moderna">Moderna</option>
                            <option value="janssen">Janssen</option>
                            <option value="astraZeneca">AstraZeneca</option>
                        </select>
                        <span class="invalid-feedback"><?php echo $vacuna_err;?></span>
                    </div>

                </div>

                <input type="submit" class="button" value="Submit">
                <input type="reset" class="button" value="Reset">

            </form>
            <br>
            <br>
            <div class="text-center">
                <a href="https://www.comunidad.madrid/servicios/salud/vacunacion-frente-coronavirus-comunidad-madrid">
                    <img src="img/27304b9b14ce9bd8a28ca637ed92070e-icono-de-signo-de-interrogaci--n-c--rculo-azul-by-vexels.png" width="25x">
                    <span>Informacion</span>
                </a>
                <a href="cita.php">
                    <span>¿Ya tienes cita?</span>
                </a>
            </div>
        </div>
        <div class="derecha col-xs-12 col-md-4 d-none d-md-block">
            <div id="citacion">
                <h1>AUTOCITA</h1>
            </div>
            <div id="citacion">
                     <span>
                        <p>- Gestión de citas -</p>
                    </span>
            </div>

        </div>
    </div>
</div>

</body>
</html>
