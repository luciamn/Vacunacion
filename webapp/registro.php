<?php
// Include config file
require_once "config/configuracion.php";

// Define variables and initialize with empty values
$nombre = $apellidos = $email  = "";
$dni  = $password = "";
$nombre_err = $apellidos_err = $email_err = "";
$dni_err  = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Please enter a name.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Please enter a valid name.";
    } else{
        $nombre = $input_nombre;
    }


    //Validate apellidos
    $input_apellidos = trim($_POST["apellidos"]);
    if(empty($input_apellidos)){
        $apellidos_err = "Please enter a apellidos.";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $apellidos_err = "Please enter a valid name.";
    } else{
        $apellidos = $input_apellidos;
    }


    // Validate email
    $email = ($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format";
    }

    // Validate DNI
    $input_dni = trim($_POST["dni"]);
    if(empty($input_dni)){
        $dni_err = "Please enter a apellidos.";
    } elseif(!filter_var($input_dni, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{8,8}[A-Za-z]+$/")))){
        $dni_err = "Please enter a valid name.";
    } else{
        $dni = $input_dni;
    }


    //Validate password
    $input_password = ($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a name.";
    } elseif(strlen(trim($input_password))<6){
        $password_err = "La contraseña debe de tner mas de 6 caracteres.";
    } else{
        $password = $input_password;
    }

    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($apellidos_err) && empty($email_err) && empty($dni_err)  && empty($password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, dni, password) VALUES (?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_nombre, $param_apellidos, $param_email, $param_dni, $param_password);

            // Set parameters
            $param_nombre = $nombre;
            $param_apellidos = $apellidos;
            $param_email = $email;
            $param_dni = $dni;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
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

//COOKIES
setcookie("nombre", "Lucia", time()+ 84600);
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

        #registro{
            color: white;
            margin-top: 150px;
            margin-bottom: 150px;
            font-family: sans-serif;
            text-align: center;
        }
        a{
            margin-right: 40px;
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
                    <label>Nombre</label>
                    <input type="text" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>" id="nombre" name="nombre" placeholder="Nombre" required >
                    <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label>Apellidos</label>
                    <input type="text" class="form-control <?php echo (!empty($apellidos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $apellidos; ?>" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                    <span class="invalid-feedback"><?php echo $apellidos_err;?></span>
                </div>
                <div class="form-group col-lg-12">
                    <label>Email</label>
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" id="email" name="email" placeholder="Email" required>
                    <span class="invalid-feedback"><?php echo $email_err;?></span>
                </div>

                <div class="form-group col-lg-12">
                    <label>DNI</label>
                    <input type="text" class="form-control <?php echo (!empty($dni_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dni; ?>" id="dni" name="dni" placeholder="DNI" required>
                    <span class="invalid-feedback"><?php echo $dni_err;?></span>
                </div>

                <div class="form-group col-lg-12">
                    <label>Contraseña</label>
                    <input type="passwd" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" id="password" name="password" placeholder="Contraseña" required >
                    <span class="invalid-feedback"><?php echo $password_err;?></span>
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
            <a href="login.php">
                <span>¿Ya tienes cuenta?</span>
            </a>
        </div>
    </div>
    <div class="derecha col-xs-12 col-md-4 d-none d-md-block">
        <div id="registro">
            <h1>REGISTRO</h1>
        </div>
        <div id="registro">
                     <span>
                        <p>- Gestión de registro -</p>
                    </span>
        </div>

    </div>
</div>
</div>
</body>
</html>
