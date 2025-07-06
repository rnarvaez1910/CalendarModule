<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/css/bootstrap.min.css"
        integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .pyro>.before,
        .pyro>.after {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            box-shadow: -120px -218.66667px blue, 248px -16.66667px #00ff84, 190px 16.33333px #002bff, -113px -308.66667px #ff009d, -109px -287.66667px #ffb300, -50px -313.66667px #ff006e, 226px -31.66667px #ff4000, 180px -351.66667px #ff00d0, -12px -338.66667px #00f6ff, 220px -388.66667px #99ff00, -69px -27.66667px #ff0400, -111px -339.66667px #6200ff, 155px -237.66667px #00ddff, -152px -380.66667px #00ffd0, -50px -37.66667px #00ffdd, -95px -175.66667px #a6ff00, -88px 10.33333px #0d00ff, 112px -309.66667px #005eff, 69px -415.66667px #ff00a6, 168px -100.66667px #ff004c, -244px 24.33333px #ff6600, 97px -325.66667px #ff0066, -211px -182.66667px #00ffa2, 236px -126.66667px #b700ff, 140px -196.66667px #9000ff, 125px -175.66667px #00bbff, 118px -381.66667px #ff002f, 144px -111.66667px #ffae00, 36px -78.66667px #f600ff, -63px -196.66667px #c800ff, -218px -227.66667px #d4ff00, -134px -377.66667px #ea00ff, -36px -412.66667px #ff00d4, 209px -106.66667px #00fff2, 91px -278.66667px #000dff, -22px -191.66667px #9dff00, 139px -392.66667px #a6ff00, 56px -2.66667px #0099ff, -156px -276.66667px #ea00ff, -163px -233.66667px #00fffb, -238px -346.66667px #00ff73, 62px -363.66667px #0088ff, 244px -170.66667px #0062ff, 224px -142.66667px #b300ff, 141px -208.66667px #9000ff, 211px -285.66667px #ff6600, 181px -128.66667px #1e00ff, 90px -123.66667px #c800ff, 189px 70.33333px #00ffc8, -18px -383.66667px #00ff33, 100px -6.66667px #ff008c;
            -moz-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -webkit-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -o-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            -ms-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
            animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        }

        .pyro>.after {
            -moz-animation-delay: 1.25s, 1.25s, 1.25s;
            -webkit-animation-delay: 1.25s, 1.25s, 1.25s;
            -o-animation-delay: 1.25s, 1.25s, 1.25s;
            -ms-animation-delay: 1.25s, 1.25s, 1.25s;
            animation-delay: 1.25s, 1.25s, 1.25s;
            -moz-animation-duration: 1.25s, 1.25s, 6.25s;
            -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
            -o-animation-duration: 1.25s, 1.25s, 6.25s;
            -ms-animation-duration: 1.25s, 1.25s, 6.25s;
            animation-duration: 1.25s, 1.25s, 6.25s;
        }

        @-webkit-keyframes bang {
            from {
                box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white;
            }
        }

        @-moz-keyframes bang {
            from {
                box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white;
            }
        }

        @-o-keyframes bang {
            from {
                box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white;
            }
        }

        @-ms-keyframes bang {
            from {
                box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white;
            }
        }

        @keyframes bang {
            from {
                box-shadow: 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white, 0 0 white;
            }
        }

        @-webkit-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }

        @-moz-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }

        @-o-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }

        @-ms-keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }

        @keyframes gravity {
            to {
                transform: translateY(200px);
                -moz-transform: translateY(200px);
                -webkit-transform: translateY(200px);
                -o-transform: translateY(200px);
                -ms-transform: translateY(200px);
                opacity: 0;
            }
        }

        @-webkit-keyframes position {

            0%,
            19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }

            20%,
            39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }

            40%,
            59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }

            60%,
            79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }

            80%,
            99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }

        @-moz-keyframes position {

            0%,
            19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }

            20%,
            39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }

            40%,
            59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }

            60%,
            79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }

            80%,
            99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }

        @-o-keyframes position {

            0%,
            19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }

            20%,
            39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }

            40%,
            59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }

            60%,
            79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }

            80%,
            99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }

        @-ms-keyframes position {

            0%,
            19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }

            20%,
            39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }

            40%,
            59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }

            60%,
            79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }

            80%,
            99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }

        @keyframes position {

            0%,
            19.9% {
                margin-top: 10%;
                margin-left: 40%;
            }

            20%,
            39.9% {
                margin-top: 40%;
                margin-left: 30%;
            }

            40%,
            59.9% {
                margin-top: 20%;
                margin-left: 70%;
            }

            60%,
            79.9% {
                margin-top: 30%;
                margin-left: 20%;
            }

            80%,
            99.9% {
                margin-top: 30%;
                margin-left: 80%;
            }
        }

        figure {
            animation: wobble 5s ease-in-out infinite;
            transform-origin: center center;
            transform-style: preserve-3d;
        }

        @keyframes wobble {

            0%,
            100% {
                transform: rotate3d(1, 1, 0, 40deg);
            }

            25% {
                transform: rotate3d(-1, 1, 0, 40deg);
            }

            50% {
                transform: rotate3d(-1, -1, 0, 40deg);
            }

            75% {
                transform: rotate3d(1, -1, 0, 40deg);
            }
        }

        h1 {
            display: block;
            width: 100%;
            padding: 40px;
            line-height: 1.5;
            font: 900 8em 'Concert One', sans-serif;
            text-transform: uppercase;
            position: absolute;
            color: #0a0a0a;
        }

        @keyframes glow {

            0%,
            100% {
                text-shadow: 0 0 30px red;
            }

            25% {
                text-shadow: 0 0 30px orange;
            }

            50% {
                text-shadow: 0 0 30px forestgreen;
            }

            75% {
                text-shadow: 0 0 30px cyan;
            }
        }

        h1:nth-child(2) {
            transform: translateZ(5px);
        }

        h1:nth-child(3) {
            transform: translateZ(10px);
        }

        h1:nth-child(4) {
            transform: translateZ(15px);
        }

        h1:nth-child(5) {
            transform: translateZ(20px);
        }

        h1:nth-child(6) {
            transform: translateZ(25px);
        }

        h1:nth-child(7) {
            transform: translateZ(30px);
        }

        h1:nth-child(8) {
            transform: translateZ(35px);
        }

        h1:nth-child(9) {
            transform: translateZ(40px);
        }

        h1:nth-child(10) {
            transform: translateZ(45px);
        }

        @import url(https://fonts.googleapis.com/css?family=Concert+One);

        h1 {
            animation: glow 10s ease-in-out infinite;
        }

        #diegoespato {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <!--
        Crear una pagina de login (visual):
        - Dos campos de texto
        - Boton de login
        - Formulario

        Para falsear:
        - Validaciones
    -->
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
    <div class="pyro" style="display: none;">
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
        let user;
        let password;
        let warning;

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
            } else {
                window.alert("Ingrese un correo o contraseña válidos"); // buscar como usarlo con warning
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.7/js/bootstrap.min.js"
        integrity="sha512-zKeerWHHuP3ar7kX2WKBSENzb+GJytFSBL6HrR2nPSR1kOX1qjm+oHooQtbDpDBSITgyl7QXZApvDfDWvKjkUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
