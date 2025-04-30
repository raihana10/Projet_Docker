<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Remix Icon CDN pour les icônes -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
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
            transition: box-shadow 0.4s cubic-bezier(.4,0,.2,1);
        }
        .navbar:hover {
            box-shadow: 0 6px 16px rgba(0,0,0,0.18);
        }
        .navbar .icons {
            display: flex;
            gap: 15px;
        }
        .navbar .icons a, .navbar .icons span {
            text-decoration: none;
            color: #333;
            font-size: 22px;
            transition: color 0.3s;
        }
        .navbar .icons a:hover {
            color: #0073e6;
            transform: scale(1.15);
        }
        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.4s cubic-bezier(.4,0,.2,1);
            transform: translateX(-100%);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1001;
        }
        .sidebar.active {
            transform: translateX(0);
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
            transition: color 0.3s;
        }
        .sidebar ul li a:hover {
            color: #0056b3;
            transform: translateX(8px);
        }
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #f9f9f9;
            margin-left: 0;
            transition: margin-left 0.4s cubic-bezier(.4,0,.2,1);
            align-items: center;
            justify-content: center;
        }
        .sidebar.active ~ .content {
            margin-left: 250px;
        }
        .profile-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 40px 32px 32px 32px;
            text-align: center;
            min-width: 320px;
            position: relative;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: #fff;
            margin: 0 auto 24px auto;
            user-select: none;
        }
        .profile-name {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .profile-email {
            font-size: 16px;
            color: #555;
            margin-bottom: 16px;
        }
        #editProfileForm {
            display: none;
            animation: fadeInForm 0.5s cubic-bezier(.4,0,.2,1);
        }
        #editProfileForm.show {
            display: block;
            animation: fadeInForm 0.5s cubic-bezier(.4,0,.2,1);
        }
        @keyframes fadeInForm {
            from { opacity: 0; transform: translateY(-30px) scale(0.98);}
            to { opacity: 1; transform: translateY(0) scale(1);}
        }
        .btn-animated {
            background: linear-gradient(90deg,#0056b3,#0073e6);
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 0;
            font-size: 15px;
            margin-top: 10px;
            width: 100%;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
        }
        .btn-animated:hover {
            background: linear-gradient(90deg,#0073e6,#0056b3);
            transform: scale(1.04);
        }
        .btn-cancel {
            background: #eee;
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 0;
            font-size: 15px;
            margin-top: 10px;
            width: 100%;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background: #e0e0e0;
            color: #0073e6;
        }
        body, button, a {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="navbar">
    <button class="menu-icon" onclick="toggleSidebar()" style="font-size:24px;background:none;border:none;cursor:pointer;"><i class="ri-menu-3-line"></i></button>
    <div class="icons">
        <span style="margin-right: 10px;">Bonjour, {{ $user->name ?? '' }}</span>
        <a href="#"><i class="ri-question-line"></i></a>
        <a href="#"><i class="ri-user-3-line"></i></a>
        <a href="#"><i class="ri-group-line"></i></a>
        <span style="position:relative;">
            <a href="#" id="settings-icon"><i class="ri-settings-3-line"></i></a>
            <div id="settings-menu" style="display:none; position:absolute; right:30px; top:60px; background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:10px 0; min-width:140px; z-index:1000;">
                <a href="/profile" style="display:block; padding:8px 20px; color:#333; text-decoration:none;">Voir le profil</a>
                <form action="/logout" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="display:block; width:100%; padding:8px 20px; background:none; border:none; color:#e60000; text-align:left; cursor:pointer;">Logout</button>
                </form>
            </div>
        </span>
    </div>
</div>

<div style="display: flex; flex: 1;">
    <div class="sidebar" id="sidebar">
        <button onclick="toggleSidebar()" style="background:none;border:none;cursor:pointer;font-size:22px;margin-bottom:15px;"><i class="ri-menu-3-line"></i></button>
        <ul>
            <li><a href="/test2"><i class="ri-home-4-line"></i> Accueil</a></li>
            <li><a href="#"><i class="ri-money-dollar-circle-line"></i> Transactions</a></li>
            <li><a href="#"><i class="ri-add-circle-line"></i> Nouveau transaction</a></li>
            <li><a href="#"><i class="ri-bar-chart-2-line"></i> Rapport</a></li>
            <li><a href="#"><i class="ri-calendar-line"></i> Calendrier</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="profile-container">
            @php
                $colors = ['#0073e6', '#ff6f61', '#6c5ce7', '#00b894', '#fdcb6e', '#e17055', '#00bcd4', '#fd79a8'];
                $bgColor = $colors[array_rand($colors)];
                $firstChar = strtoupper(substr($user->name ?? '', 0, 1));
            @endphp
            <div class="profile-avatar" style="background: {{ $bgColor }}">
                {{ $firstChar }}
            </div>
            <div class="profile-name" id="profileName">{{ $user->name ?? '' }}</div>
            <div class="profile-email" id="profileEmail">{{ $user->email ?? '' }}</div>
            <button id="editProfileBtn" class="btn-animated" style="margin-top:16px;">Modifier</button>
            <form id="editProfileForm" action="/profile/update" method="POST">
                @csrf
                <div style="margin-bottom:10px;">
                    <input type="text" name="name" value="{{ $user->name ?? '' }}" placeholder="Nom" style="padding:8px; width:90%; border-radius:5px; border:1px solid #ccc;">
                </div>
                <div style="margin-bottom:10px;">
                    <input type="email" name="email" value="{{ $user->email ?? '' }}" placeholder="Email" style="padding:8px; width:90%; border-radius:5px; border:1px solid #ccc;">
                </div>
                <button type="submit" class="btn-animated">Enregistrer</button>
                <button type="button" class="btn-cancel" id="cancelEditBtn">Annuler</button>
            </form>
        </div>
    </div>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
        document.querySelector('.content').classList.toggle('sidebar-active');
    }
    // Menu settings
    document.getElementById('settings-icon').onclick = function(e) {
        e.preventDefault();
        const menu = document.getElementById('settings-menu');
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    };
    // Edit profile interactivité
    const editBtn = document.getElementById('editProfileBtn');
    const editForm = document.getElementById('editProfileForm');
    const cancelBtn = document.getElementById('cancelEditBtn');
    editBtn.onclick = function() {
        editForm.classList.add('show');
        editForm.style.display = 'block';
        editBtn.style.display = 'none';
    };
    cancelBtn.onclick = function() {
        editForm.classList.remove('show');
        editForm.style.display = 'none';
        editBtn.style.display = 'inline-block';
    };
    // Fermer le menu settings si clic ailleurs
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('settings-menu');
        const icon = document.getElementById('settings-icon');
        if (!menu.contains(event.target) && event.target !== icon) {
            menu.style.display = 'none';
        }
    });
</script>
</body>
</html>
@if(session('success'))
    <div style="color: #00b894; margin-bottom: 16px;">
        {{ session('success') }}
    </div>
@endif
</html>
