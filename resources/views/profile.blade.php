<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            align-items: center;
            justify-content: center;
        }
        .profile-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 40px 32px 32px 32px;
            text-align: center;
            min-width: 320px;
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
        .sidebar {
            display: none; /* Initially hidden */
        }
        body, button, a {
            cursor: pointer;
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
            </form>
        </div>
    </div>
</div>

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
            <button id="editProfileBtn" style="margin-top:16px; padding:8px 24px; border:none; background:#0073e6; color:#fff; border-radius:6px; font-size:15px; cursor:pointer;">Edit</button>

            <form id="editProfileForm" action="/profile/update" method="POST" style="display:none; margin-top:16px;">
                @csrf
                <div style="margin-bottom:10px;">
                    <input type="text" name="name" value="{{ $user->name ?? '' }}" placeholder="Name" style="padding:8px; width:90%; border-radius:5px; border:1px solid #ccc;">
                </div>
                <div style="margin-bottom:10px;">
                    <input type="email" name="email" value="{{ $user->email ?? '' }}" placeholder="Email" style="padding:8px; width:90%; border-radius:5px; border:1px solid #ccc;">
                </div>
                <!-- Add more fields here if needed -->
                <button type="submit" style="padding:8px 24px; border:none; background:#00b894; color:#fff; border-radius:6px; font-size:15px; cursor:pointer;">Save</button>
                <button type="button" id="cancelEditBtn" style="padding:8px 24px; border:none; background:#e17055; color:#fff; border-radius:6px; font-size:15px; cursor:pointer; margin-left:8px;">Cancel</button>
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

        // Profile edit toggle
        const editBtn = document.getElementById('editProfileBtn');
        const editForm = document.getElementById('editProfileForm');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        if(editBtn && editForm && cancelEditBtn) {
            editBtn.addEventListener('click', function() {
                editForm.style.display = 'block';
                editBtn.style.display = 'none';
            });
            cancelEditBtn.addEventListener('click', function() {
                editForm.style.display = 'none';
                editBtn.style.display = 'inline-block';
            });
        }
    });
</script>
@if(session('success'))
    <div style="color: #00b894; margin-bottom: 16px;">
        {{ session('success') }}
    </div>
@endif
</html>
