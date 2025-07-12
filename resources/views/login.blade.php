<html>

<head>
    <title>Administrador</title>
    <link rel="shortcut icon" href="/Backend/public/image/unimar.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/css/bootstrap.min.css"
        integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 0.5rem 1rem;
        }

        .navbar-brand img.title-app {
            width: 150px;
            height: auto;
            object-fit: contain;
        }

        .title-app {
            font-size: 1rem;
            font-weight: 500;
            color: #000000;
            padding-left: 0.5rem;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .navbar-toggler {
            border: none;
            outline: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 0, 0, 0.7)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .navbar-nav {
            margin-left: auto;
            align-items: center;
        }

        body {
            margin: 0;
            box-sizing: border-box;
            overflow: hidden;
            z-index: 9999999999999999999;
        }

        .pepe {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 200px;
            height: auto;
        }

        #login_form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        #login_form>div {
            width: 25%;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        #login_form .input-group {
            display: flex;
        }

        #login_form .input-group>label {
            flex-basis: 95px;
        }

        #login_form .input-group>div {
            flex-grow: 1;
            flex-shrink: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="https://portalunimar.unimar.edu.ve/home">
                <img class="title-app" src="https://portalunimar.unimar.edu.ve/image/logounimar-22.jpg"
                    style="width:150px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <span class="title-app">Bienvenid@</span>
                </ul>
            </div>
        </div>
    </nav>

    <form id="login_form">
        <div class="border border-primary rounded p-5">
            <div class="input-group">
                <label for="user_email" class="form-label">Correo</label>
                <div><input id="user_email" type="email" name="email" class="form-control" /></div>
            </div>
            <div class="input-group">
                <label for="user_password" class="form-label">Contraseña</label>
                <div><input id="user_password" type="password" name="password" class="form-control" /></div>
            </div>
            <div>
                <button class="btn btn-outline-primary">Iniciar sesión</button>
            </div>
        </div>
    </form>
    <div class="pyro">
        <div class="before"></div>
        <div class="after"></div>
    </div>
    <figure id="diegoespato" style="text-align: center; display:none;">
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
        <h1>Felicidades!<br />Diego es pato!
        </h1>
    </figure>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            let user;
            let password;
            let warning;
            let pepeX = undefined,
                pepeY = undefined,
                pepeDirX = 1,
                pepeDirY = 1;

            let trumpX = undefined,
                trumpY = undefined,
                trumpDirX = 1,
                trumpDirY = 1;

            const pepeSpeed = 2;
            const trumpSpeed = 5;
            const pepe1 = document.getElementById("pepe1");
            const trump = document.getElementById("trump");

            function animate() {
                const pepeWidth = pepe1.offsetWidth;
                const pepeHeight = pepe1.offsetHeight;
                const screenHeight = document.body.offsetHeight;
                const screenWidth = document.body.offsetWidth;

                if (pepeX === undefined) pepeX = Math.random() * screenWidth;
                if (pepeY === undefined) pepeY = Math.random() * screenHeight;

                if (trumpX === undefined) trumpX = Math.random() * screenWidth;
                if (trumpY === undefined) trumpY = Math.random() * screenHeight;

                if (pepeY + pepeHeight >= screenHeight || pepeY < 0)
                    pepeDirY *= -1;

                if (pepeX + pepeWidth >= screenWidth || pepeX < 0)
                    pepeDirX *= -1;

                pepeX += pepeDirX * pepeSpeed;
                pepeY += pepeDirY * pepeSpeed;
                pepe1.style.left = pepeX + "px";
                pepe1.style.top = pepeY + "px";

                const trumpWidth = trump.offsetWidth;
                const trumpHeight = trump.offsetHeight;

                if (trumpY + trumpHeight >= screenHeight || trumpY < 0)
                    trumpDirY *= -1;

                if (trumpX + trumpWidth >= screenWidth || trumpX < 0)
                    trumpDirX *= -1;

                trumpX += trumpDirX * trumpSpeed;
                trumpY += trumpDirY * trumpSpeed;
                trump.style.left = trumpX + "px";
                trump.style.top = trumpY + "px";
                window.requestAnimationFrame(animate);
            }

            $('#user_email').on("input", function(event) {
                user = event.target.value;
            });

            $('#user_password').on("input", function(event) {
                password = event.target.value;
            });

            $('#login_form').on("submit", function(e) {
                e.preventDefault();

                if (user === "admin@test.com" && password === "12345") {
                    window.location.href = "/Backend/public/admin";
                } else if (user === "becario@test.com" && password === "123") {
                    window.location.href = "/Backend/public/becario";
                } else if (user === "diegotheduck@duckmail.com" && password === "diegoespato") {
                    $("body").css("background", "black");
                    $('#login_form').hide();
                    $(".pyro").show();
                    $("#diegoespato").show();
                    $("#pepe1").show();
                    $("#trump").show();
                    window.requestAnimationFrame(animate);
                    const circusAudio = document.getElementById("circus");
                    circusAudio.play();

                    circusAudio.addEventListener("ended", function(e) {
                        circusAudio.play();
                    });

                    const horseAudio = document.getElementById("horse");

                    setInterval(function() {
                        horseAudio.play();
                    }, 2000);
                } else {
                    window.alert(
                        "Ingrese un correo o contraseña válidos"); // buscar como usarlo con warning
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js"
        integrity="sha512-zKeerWHHuP3ar7kX2WKBSENzb+GJytFSBL6HrR2nPSR1kOX1qjm+oHooQtbDpDBSITgyl7QXZApvDfDWvKjkUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
