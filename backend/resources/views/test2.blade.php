<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
        }
        .navbar {
            background-color: #f4f4f4;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .navbar .icons {
            display: flex;
            gap: 15px;
        }
        .navbar .icons a {
            text-decoration: none;
            color: #333;
            font-size: 20px;
        }
        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        .sidebar ul {
            list-style: none;
        }
        .sidebar ul li {
            margin-bottom: 15px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar ul li a:hover {
            color: #0056b3;
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .content .blocks {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .block {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .block h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        .block ul {
            list-style: none;
            padding: 0;
        }
        .block ul li {
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }
        .block button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .block button:hover {
            background-color: #004099;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <div class="menu-icon">☰</div>
        <div class="icons">
            <a href="#">❓</a>
            <a href="#">👤</a>
            <a href="#">👥</a>
            <a href="#">⚙️</a>
        </div>
    </div>

    <!-- Conteneur principal -->
    <div style="display: flex; flex: 1;">
        <!-- Barre latérale -->
        <div class="sidebar">
            <ul>
                <li><a href="#">🏠 Accueil</a></li>
                <li><a href="#">💰 Transactions</a></li>
                <li><a href="#">➕ Nouveau transaction</a></li>
                <li><a href="#">📊 Rapport</a></li>
                <li><a href="#">📅 Calendrier</a></li>
            </ul>
            <p style="margin-top: 20px; font-weight: bold;">Total: -15.5 MAD</p>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <div class="blocks">
                <!-- Bloc "Mes groupes" -->
                <div class="block">
                    <h3>Mes groupes</h3>
                    <ul>
                        <li>ENSART</li>
                        <li>aFI</li>
                    </ul>
                    <button>+ Créer nouveau groupe</button>
                </div>

                <!-- Bloc "Mes emprunts" -->
                <div class="block">
                    <h3>Mes emprunts</h3>
                    <ul>
                        <li>Raihana +100dh 21/04/2004</li>
                        <li>Douae -16.5dh 14/04/2025</li>
                    </ul>
                    <button>+ Nouvelle emprunt</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>