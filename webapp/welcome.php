<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .carousel{
            margin-bottom: 4rem;
        }
        .carousel-caption{
            bottom: 3rem;
            z-index: 10;
        }
        .carousel-item{
            height: 30rem;
        }
        .carousel-item > img{
            position: absolute;
            top: 0;
            left: 0;
            min-height: 100%;
            height: 32rem;
        }
        .circulos{
            margin-top: 10px;
            font-family: sans-serif;
            text-align: center;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .rounded-circle {
            border-radius: 50%!important;
        }
        .gif{
            vertical-align: middle;
            margin-left: -40%;
        }
        .lead{
            text-align: justify;
        }
        #temp{
            margin-left: 5%;
            margin-top: -105%;
        }
        #vacuna{
            vertical-align: middle;
            margin-left: -1%;
            float: left;
            margin-top: -105%;
        }
        lu{
            float: left;
            text-align: justify;
        }
        form{
            float: right;
        }
        .nav {
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }
        a:hover{
            color:#66ccff !important;
        }

        .datos_dosis{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-top: 1rem;
            text-align: center;
        }

        strong{
            font-weight: bold;
        }
        h3{
            margin: 3%;
        }

        #data{
            margin-top: 5%;
        }
        #titulo{
            margin-bottom: 3%;
        }
        strong{
            font-size: 20px;
        }
        #VTexto{
            margin-right: -190px;
        }
        .lista{
            margin-right: -35%;
        }
    </style>
</head>

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <img src="img/ser2.png" width="80px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#QE">Que es</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#VTexto">Vacunas</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="cita.php">Mi Cita</a>
                </li>

                <li class="nav-item dropdown nav-item mx-0 mx-lg-1">
                    <a class="nav-link dropdown-toggle nav-link py-3 px-0 px-lg-3 rounded " href="#" id="navbardrop" data-toggle="dropdown">
                        Cuenta
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="logout.php">Cerrar sesion</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="img/vacuna-coronavirus-biontech-covid-19.jpg" alt="First slide" style="height: 20%;">
        </div>
        <div class="carousel-item">
            <div class="container" id="data">
                <div class="infoBox">
                    <div class="infoData">
                        <h2 style="text-align: center;" id="titulo">Progeso Vacunacion Covid-19</h2>
                        <span class="vacunacion_completa" style="background-color: #66ccff;">
                <strong>
                  Vacunación completa: 78,04% (37.029.165 personas)
                </strong>
                <br>
              </span>
                        <span class="vacunacion_parcia" style="background-color: #00cc99;">
                <strong>
                  Al menos una dosis: 79,81% (37.868.453 personas)
                </strong>
                <br>
              </span>
                        <div class="progress" style="height: 40px;">
                <span class="vacunacion_completa" style="width: 78.04%; background-color: #66ccff;">
                </span>
                            <span class="vacunacion_parcial" style="width: 1.77%; background-color: #00cc99;">
                </span>
                        </div>
                    </div>
                </div>

                <div class="datos_dosis">
                    <div class="row">
                <span class="col">
                  <h3>Dosis distribuidas</h3>
                  <h5>75.642.021</h5>
                </span>
                        <span class="col">
                  <h3>Dosis administradas</h3>
                  <strong>70.982.052</strong>
                </span>
                        <span>
                  <h3>Administradas</h3>
                  <strong>93,8%</strong>
                </span>
                        <span class="col">
                  <h3>Dosis por 100.000 habitantes</h3>
                  <strong>149.964</strong>
                </span>
                    </div>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container circulos">
        <div class="row">
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <img class="gif" src="img/8603-profile.gif" width="50%">
                    <text x="50%" y="50%" fill="#8603-profile.gif" dy=".3em"></text>
                </svg>
                <h2>Registro</h2>
                <p><a class="btn btn-secondary" href="registro.php">View details &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <img class="gif" src="img/24141-unlock-login.gif" width="50%">
                    <text x="50%" y="50%" fill="#8603-profile.gif" dy=".3em"></text>
                </svg>
                <h2>Inicio de Sesion</h2>
                <p><a class="btn btn-secondary" href="login.php">View details &raquo;</a></p>
            </div>

            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <img class="gif" src="img/23283-info.gif" width="50%">
                    <text x="50%" y="50%" fill="#8603-profile.gif" dy=".3em"></text>
                </svg>
                <h2>Infromación</h2>
                <p><a class="btn btn-secondary" href="https://www.comunidad.madrid/servicios/salud/vacunacion-frente-coronavirus-comunidad-madrid">View details &raquo;</a></p>
            </div>
        </div>

        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-6">
                <h2 class="featurette-heading"> <span class="text-muted">Que es el Covid-19</span></h2>
                <p class="lead" id="QE">
                    Es una enfermedad infecciosa causada por el SARS-CoV-2.Produce síntomas similares a los de la gripe o catarro, entre los que se incluyen fiebre, tos,​ disnea, mialgia y fatiga.15​16​ En casos graves se caracteriza por producir neumonía, síndrome de dificultad respiratoria aguda​.
                    Los síntomas aparecen entre dos y catorce días, con un promedio de cinco días, después de la exposición al virus. Existe evidencia limitada que sugiere que el virus podría transmitirse uno o dos días antes de que se tengan síntomas, ya que la viremia alcanza un pico al final del período de incubación.​El contagio se puede prevenir con el lavado de manos frecuente, o en su defecto la desinfección de las mismas con alcohol en gel, cubriendo la boca al toser o estornudar, ya sea con la sangradura o con un pañuelo y evitando el contacto cercano con otras personas, entre otras medidas como el uso de mascarillas.
                </p>
            </div>
            <div class="col-md-5" >
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <img class="gif" src="img/23221-covid-19-temperature-check.gif" width="140%" id="temp">
                </svg>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette" id="c2">
                <div class="col-md-5 order-md-2">
                    <h2 class="featurette-heading">
                        <span class="text-muted">Vacunas.</span>
                    </h2>
                    <p class="lead" id="VTexto">
                        Las vacunas actuan mediante la simulación de los agentes infecciosos que pueden causar una gran enfermedad.
                        Antes de vacunarte si alguna vez has tenido reacciones alergicas graves a algunos de los componentes de las vacunas, si es asi habla con tu medico.
                        Durante la cita informa al personal sanitario de cualquier enfermedad o condición que pueda requerir precauciones adiccionales.
                        Despues de recibir la vacuna debes esperar 15 minutos por posibles complicaiones, los efectos secundarios que puede causar las vacunas son:
                        <a href="listado.php">Lista de vacunas.</a>
                    </p>
                    <lu class="lista">
                        <li>Dolor en el brazo o muscular</li>
                        <li>Fiebre leve</li>
                        <li>Dolor de cabeza</li>
                        <li>Escalofrios</li>
                        <li>Diarrea</li>
                    </lu>
                </div>
                <div class="col-md-6 order-md-1">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <img class="gif" src="img/59933-covid-19-vaccine-concept-animation.gif" id="vacuna" width="100%">
                    </svg>
                </div>

            </div>

            <br>
            <div class="container">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>

                    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <svg class="bi me-2" width="40" height="32"><use xlink:href="https://s1.qwant.com/thumbr/0x0/3/3/47a0f69f826096cc0c49166187bbaecb2688514ee17d37da7c062f3b6aea64/logo-vector-salud-madrid.jpg?u=https%3A%2F%2Fwww.enpozuelo.es%2Ffotos%2F6%2Flogo-vector-salud-madrid.jpg&q=0&b=1&p=0&a=0"/></svg>
                    </a>

                    <p class="float-end"><a href="#">Vuelve arriba</a></p>

                </footer>
            </div>


</body>
</html>


