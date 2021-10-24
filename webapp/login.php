<?php
// Initialize the session
session_start();
// Include config file
require_once "config/configuracion.php";

// Define variables and initialize with empty values
$nombre = $password = "";
$nombre_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["nombre"]))){
        $nombre_err = "Please enter username.";
    } else{
        $nombre = trim($_POST["nombre"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($nombre_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, nombre, password FROM usuarios WHERE nombre = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_nombre);

            // Set parameters
            $param_nombre = $nombre;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $result = $stmt->get_result();

                // Check if username exists, if yes then verify password
                if($result->num_rows == 1){
                    // Bind result variables
                    $fila = $result->fetch_assoc();
                    if(password_verify($password, $fila["password"])){
                        // Password is correct, so start a new session
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $fila["id"];
                        $_SESSION["nombre"] = $fila["nombre"];

                        // Redirect user to welcome page
                        header("location: citacion.php");
                    } else{
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                }
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


setcookie("password", "lucia", time()+ 84600);

?>

<!DOCTYPE html>
<html lang="en">
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
            box-shadow: 10px 10px 5px grey;
            background-color:#66ccff ;
            opacity: 0.8

        }
        .derecha{
            background-color: white;
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
        }

        img {
            border: 0;
            vertical-align: middle;
        }
        .btn{
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
            width: 100%;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }

        #registro{
            color: white;
            margin-top: 150px;
            margin-bottom: 150px;
            font-family: sans-serif;
            text-align: center;
        }

        p {
            text-align: center;
            margin-top: 5%;
        }


    </style>
</head>
<body>

<body class="m-0 vh-100 row justify-content-center align-items-center">

<div class="container col-auto">
    <div class="row">
        <div class="izquierda col-md-4">

            <div id="registro">
                <h1>INICIO DE SESION</h1>
            </div>
            <div id="registro">
                     <span>
                        <p>- Gestión de inicio de sesión -</p>
                    </span>
            </div>

        </div>
        <div class="derecha col-md-8">
            <img alt="Sacyl" src="img/5831a17a290077c646a48c4db78a81bb-perfil-de-usuario-icono-azul-by-vexels.png" class="img-responsive img-login-xs" width="35%">
            <h2 class="text-center">Inicio de Sesión</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["SCRIPT_NAME"]); ?>" method="post">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>" id="nombre" name="nombre" placeholder="Nombre" required >
                    <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                    <input type="reset" class="btn btn-primary" value="Reset">

                </div>
                <p><a href="registro.php">¿No estas resgistrado? </a>.</p>
                <p><a href="reset_password.php">Resetear contraseña </a>.</p>

            </form>

        </div>
    </div>
</div>
</div>
</body>

</body>
</html>

