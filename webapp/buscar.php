<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PHP MySQL AJAX ejemplo</title>
    <style>
        body {
            font-family: Arail, sans-serif;
        }

        /* Formatting search box */
        .search-box {
            width: 100%;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }

        .search-box input[type="text"] {
            width: 200px;
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }

        .result {
            width: 200px;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .search-box input[type="text"], .result {
            width: 200px;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }

        .result p:hover {
            background: #f2f2f2;
        }

        .miColumna {
            width: 40%;
            float: left;
            margin-left: 50px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.search-box input[type="text"]').on("keyup input", function () {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", {term: inputVal}).done(function (data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function () {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();

                $("#clienteId").text($(this).attr("id"));
                $("#clienteNombre").text($(this).text());
                $("#clienteEmail").text($(this).attr("email"));
            });
        });
    </script>
</head>
<body>
<div class="search-box">
    <div class="miColumna">
        <input id="nombre" type="text" autocomplete="off" placeholder="Buscar usuario..."/>
        <div class="result"></div>
    </div>
    <div class="miColumna">
        <p>Id de cliente: <span id="clienteId"></span></p>
        <p>Nombre del cliente: <span id="clienteNombre"></span></p>
        <p>Email del cliente: <span id="clienteEmail"></span></p>
    </div>
</div>
</body>
</html>
