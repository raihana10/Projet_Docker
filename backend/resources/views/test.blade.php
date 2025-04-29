<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription et Connexion</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html, body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
        }
        .wrapper {
            overflow: hidden;
            max-width: 390px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
        }
        .wrapper .title-text {
            display: flex;
            width: 200%;
        }
        .wrapper .title {
            width: 50%;
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .wrapper .slide-controls {
            position: relative;
            display: flex;
            height: 50px;
            width: 100%;
            overflow: hidden;
            margin: 30px 0 10px 0;
            justify-content: space-between;
            border: 1px solid lightgrey;
            border-radius: 15px;
        }
        .slide-controls .slide {
            height: 100%;
            width: 100%;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            line-height: 48px;
            cursor: pointer;
            z-index: 1;
            transition: all 0.6s ease;
        }
        .slide-controls label.signup {
            color: #000;
        }
        .slide-controls .slider-tab {
            position: absolute;
            height: 100%;
            width: 50%;
            left: 0;
            z-index: 0;
            border-radius: 15px;
            background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        input[type="radio"] {
            display: none;
        }
        #signup:checked ~ .slider-tab {
            left: 50%;
        }
        #signup:checked ~ label.signup {
            color: #fff;
            cursor: default;
            user-select: none;
        }
        #signup:checked ~ label.login {
            color: #000;
        }
        #login:checked ~ label.signup {
            color: #000;
        }
        #login:checked ~ label.login {
            cursor: default;
            user-select: none;
        }
        .wrapper .form-container {
            width: 100%;
            overflow: hidden;
        }
        .form-container .form-inner {
            display: flex;
            width: 200%;
        }
        .form-container .form-inner form {
            width: 50%;
            transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .form-inner form .field {
            height: 50px;
            width: 100%;
            margin-top: 20px;
        }
        .form-inner form .field input {
            height: 100%;
            width: 100%;
            outline: none;
            padding-left: 15px;
            border-radius: 15px;
            border: 1px solid lightgrey;
            border-bottom-width: 2px;
            font-size: 17px;
            transition: all 0.3s ease;
        }
        .form-inner form .field input:focus {
            border-color: #1a75ff;
        }
        .form-inner form .field input::placeholder {
            color: #999;
            transition: all 0.3s ease;
        }
        form .btn {
            height: 50px;
            width: 100%;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }
        form .btn .btn-layer {
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            background: -webkit-linear-gradient(right, #003366, #004080, #0059b3, #0073e6);
            border-radius: 15px;
            transition: all 0.4s ease;
        }
        form .btn:hover .btn-layer {
            left: 0;
        }
        form .btn input[type="submit"] {
            height: 100%;
            width: 100%;
            z-index: 1;
            position: relative;
            background: none;
            border: none;
            color: #fff;
            padding-left: 0;
            border-radius: 15px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
        }

        /* Style pour le message de connexion */
        p {
            font-size: 18px;
            font-weight: bold;
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style pour le bouton de déconnexion */
        form[action="/logout"] button {
            display: block;
            margin: 0 auto 20px auto;
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form[action="/logout"] button:hover {
            background-color: #e60000;
        }

        /* Style pour le conteneur "Ajouter une dette" */
        div[style*="border: 3px solid black;"] {
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Style pour le titre "Ajouter une dette" */
        div[style*="border: 3px solid black;"] h2 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Style pour les champs de formulaire */
        div[style*="border: 3px solid black;"] form input[type="text"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Style pour le bouton "Ajouter" */
        div[style*="border: 3px solid black;"] form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        div[style*="border: 3px solid black;"] form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    
   
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">Chhal katsalouna!</div>
                <div class="title signup">Inscription</div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">Connexion</label>
                    <label for="signup" class="slide signup">Inscription</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form action="/login" method="POST" class="login">
                        @csrf
                        <div class="field">
                            <input type="text" name="loginnom" placeholder="Nom" required>
                        </div>
                        <div class="field">
                            <input type="password" name="loginmot_de_passe" placeholder="Mot de passe" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Se connecter">
                        </div>
                    </form>
                    <form action="/register" method="POST" class="signup">
                        @csrf
                        <div class="field">
                            <input type="text" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="field">
                            <input type="text" name="email" placeholder="Email" required>
                        </div>
                        <div class="field">
                            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
  
    <script>
        const loginRadio = document.getElementById("login");
        const signupRadio = document.getElementById("signup");
        const loginForm = document.querySelector("form.login");
        const signupForm = document.querySelector("form.signup");

        // Add event listeners to toggle visibility
        loginRadio.addEventListener("change", () => {
            if (loginRadio.checked) {
                loginForm.style.display = "block";
                signupForm.style.display = "none";
            }
        });

        signupRadio.addEventListener("change", () => {
            if (signupRadio.checked) {
                signupForm.style.display = "block";
                loginForm.style.display = "none";
            }
        });

        // Initialize visibility on page load
        if (loginRadio.checked) {
            loginForm.style.display = "block";
            signupForm.style.display = "none";
        } else if (signupRadio.checked) {
            signupForm.style.display = "block";
            loginForm.style.display = "none";
        }
    </script>
</body>
</html>