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
    margin-top: 10px; /* Espacement uniforme */
    text-align: center;
}

.block button:hover {
    background-color: #004099;
}

/* Style spécifique pour le bouton Emprunts si besoin */
.button-emprunts {
    background-color: #0056b3; /* Même couleur que créer */
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
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
<div class="navbar">
    <button class="menu-icon" onclick="toggleSidebar()">☰</button>
    <div class="icons">
        <span style="margin-right: 10px;">Bonjour, {{ $user->name ?? '' }}</span>
        <a href="#">❓</a>
        <a href="#">👤</a>
        <a href="#">👥</a>
        <a href="#" id="settings-icon">⚙️</a>
        <div id="settings-menu" style="display:none; position:absolute; right:30px; top:60px; background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:10px 0; min-width:140px; z-index:1000;">
            <a href="/profile" style="display:block; padding:8px 20px; color:#333; text-decoration:none;">Voir le profil</a>
            <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" style="display:block; width:100%; padding:8px 20px; background:none; border:none; color:#e60000; text-align:left; cursor:pointer;">Logout</button>
                <button type="button" onclick="window.location.href='/Page3';">
    Les Emprunts
</button>


            </form>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar.style.display === 'none' || sidebar.style.display === '') {
            sidebar.style.display = 'block';
        } else {
            sidebar.style.display = 'none';
        }
    }
</script>
<style>
    .sidebar {
        display: none; /* Initially hidden */
    }
    body, button, a {
        cursor: pointer;
    }

</style>

<div style="display: flex; flex: 1;">
    <div class="sidebar">
        <ul>
            <li><a href="/test2">🏠 Accueil</a></li>
            <li><a href="#">💰 Transactions</a></li>
            <li><a href="#">➕ Nouveau transaction</a></li>
            <li><a href="#">📊 Rapport</a></li>
            <li><a href="#">📅 Calendrier</a></li>
        </ul>
        <p style="margin-top: 20px; font-weight: bold;">Total: -15.5 MAD</p>
    </div>

    <div class="content">
    <div class="blocks">
        <div class="block">
            <h3>Mes groupes</h3>
            <ul>
                @foreach($groups as $group)
                    <li>{{ $group->name }}</li>
                @endforeach
            </ul>
            <!-- Boutons alignés et stylisés de la même manière -->
            <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 15px;">
                <button onclick="location.href='/ajouter-groupe'" style="width: 100%;">
                    + Créer nouveau groupe
                </button>
                <button onclick="location.href='/Page3'" style="width: 100%;">
                    📋 Voir les Emprunts
                </button>
            </div>
        </div>

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
</body>
</html>

<script>
    // Settings menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const settingsIcon = document.getElementById('settings-icon');
        const settingsMenu = document.getElementById('settings-menu');
        document.addEventListener('click', function(e) {
            if (settingsIcon.contains(e.target)) {
                settingsMenu.style.display = settingsMenu.style.display === 'block' ? 'none' : 'block';
            } else if (!settingsMenu.contains(e.target)) {
                settingsMenu.style.display = 'none';
            }
        });
    });
</script>
