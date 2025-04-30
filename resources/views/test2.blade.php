<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Remix Icon CDN pour de belles icônes -->
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
        }
        .sidebar.active ~ .content {
            margin-left: 250px;
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
            opacity: 0;
            transform: translateY(40px);
            animation: fadeInBlock 0.7s forwards;
        }
        .block:nth-child(2) {
            animation-delay: 0.2s;
        }
        @keyframes fadeInBlock {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            transition: background 0.3s;
        }
        .block ul li:hover {
            background: #f0f6ff;
            border-radius: 6px;
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
            transition: background-color 0.3s, transform 0.2s;
        }
        .block button:hover {
            background-color: #004099;
            transform: scale(1.04);
        }
        /* Friends block transition */
        #friends-block {
            transition: opacity 0.4s, transform 0.4s;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-20px);
        }
        #friends-block.active {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
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
        <span style="position:relative;">
            <a href="#" id="friends-icon" onclick="toggleFriendsBlock(event)"><i class="ri-group-line"></i></a>
            <div id="friends-block">
                <form action="{{ route('friends.add') }}" method="POST" style="margin-bottom:10px;">
                    @csrf
                    <input type="text" name="friend_name" placeholder="Nom de l'ami" required style="width:70%;padding:4px;">
                    <button type="submit" style="padding:4px 8px; background:#0056b3; color:white; border:none; border-radius:4px;">Ajouter</button>
                </form>
                <div style="margin-bottom:8px; font-weight:bold;">Mes amis :</div>
                <ul style="max-height:120px;overflow-y:auto;padding-left:10px;">
                    @forelse($friends as $friend)
                        <li>{{ $friend->name }}</li>
                    @empty
                        <li style="color:#888;">Aucun ami ajouté</li>
                    @endforelse
                </ul>
                <button onclick="closeFriendsBlock()" style="margin-top:10px;">Fermer</button>
            </div>
        </span>
        <script>
            function toggleFriendsBlock(e) {
                e.preventDefault();
                const block = document.getElementById('friends-block');
                block.classList.toggle('active');
            }
            function closeFriendsBlock() {
                document.getElementById('friends-block').classList.remove('active');
            }
        </script>
        <a href="#" id="settings-icon"><i class="ri-settings-3-line"></i></a>
        <div id="settings-menu" style="display:none; position:absolute; right:30px; top:60px; background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:10px 0; min-width:140px; z-index:1000;">
            <a href="/profile" style="display:block; padding:8px 20px; color:#333; text-decoration:none;">Voir le profil</a>
            <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" style="display:block; width:100%; padding:8px 20px; background:none; border:none; color:#e60000; text-align:left; cursor:pointer;">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
        document.querySelector('.content').classList.toggle('sidebar-active');
    }
</script>
<style>
    .sidebar {
        display: block;
    }
    body, button, a {
        cursor: pointer;
    }
</style>

<div style="display: flex; flex: 1;">
    <div class="sidebar" id="sidebar">
        <button onclick="toggleSidebar()" style="background:none;border:none;cursor:pointer;font-size:22px;margin-bottom:15px;"><i class="ri-menu-3-line"></i></button>
        <ul>
            <li><a href="/test2"><i class="ri-home-4-line"></i> Accueil</a></li>
            <li><a href="#"><i class="ri-money-dollar-circle-line"></i> Emprunts </a></li>
            <li><a href="#"><i class="ri-add-circle-line"></i> Nouveau transaction</a></li>
            <li><a href="#"><i class="ri-bar-chart-2-line"></i> Rapport</a></li>
            <li><a href="#"><i class="ri-calendar-line"></i> Calendrier</a></li>
        </ul>
        <p style="margin-top: 20px; font-weight: bold;">
            Total: 
            @php
                $totalDebts = collect($debts)->sum(function($debt) use ($user) {
                    return $debt->id_from == $user->id ? $debt->value : -$debt->value;
                });
                $sign = $totalDebts >= 0 ? '+' : '-';
            @endphp
            {{ $sign }}{{ abs($totalDebts) }} MAD
        </p>
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
                <button onclick="location.href='/ajouter-groupe'">+ Créer nouveau groupe</button>
            </div>

            <div class="block">
                <h3>Mes emprunts</h3>
                <ul>
                    @php
                        $groupedDebts = collect($debts)
                            ->groupBy(function($debt) use ($user) {
                                return $debt->id_from == $user->id ? $debt->id_to : $debt->id_from;
                            });
                    @endphp
                    @foreach($groupedDebts as $otherUserId => $userDebts)
                        @php
                            $isFrom = $userDebts->first()->id_from == $user->id;
                            $otherUserName = $isFrom ? $userDebts->first()->id_to_name : $userDebts->first()->id_from_name;
                            $total = $userDebts->sum(function($debt) use ($user) {
                                return $debt->id_from == $user->id ? $debt->value : -$debt->value;
                            });
                            $sign = $total >= 0 ? '+' : '-';
                            $lastDate = $userDebts->sortByDesc('created_at')->first()->created_at->format('d/m/Y');
                        @endphp
                        <li>
                            {{ $otherUserName }} {{ $sign }}{{ abs($total) }}dh {{ $lastDate }}
                        </li>
                    @endforeach
                </ul>
                <button onclick="document.getElementById('nouvel-emprunt-form').classList.add('show-form')">+ Nouvelle emprunt</button>
                <div id="nouvel-emprunt-form" class="nouvel-emprunt-form">
                    <form action="{{ route('private_debts.store') }}" method="POST" class="form-animated">
                        @csrf
                        <div class="close-btn" onclick="closeEmpruntForm()" title="Fermer"><i class="ri-close-line"></i></div>
                        <h4 style="margin-bottom:18px;color:#0056b3;">Ajouter un nouvel emprunt</h4>
                        <div class="input-group">
                            <label for="name">Nom de l'emprunt :</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="input-group">
                            <label for="value">Montant :</label>
                            <input type="number" step="0.01" name="value" id="value" required>
                        </div>
                        <div class="input-group">
                            <label for="id_to">Nom de l'utilisateur (destinataire) :</label>
                            <input type="text" name="id_to_name" id="id_to" required placeholder="Nom exact de l'utilisateur">
                        </div>
                        <div class="input-group">
                            <label for="description">Description :</label>
                            <input type="text" name="description" id="description">
                        </div>
                        <div class="input-group">
                            <label for="status">Statut :</label>
                            <select name="status" id="status" required>
                                <option value="unpaid">Non payé</option>
                                <option value="paid">Payé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-animated">Ajouter</button>
                        <button type="button" onclick="closeEmpruntForm()" class="btn-cancel">Annuler</button>
                    </form>
                </div>
                <style>
                .nouvel-emprunt-form {
                    display: none;
                    position: fixed;
                    left: 0; top: 0; right: 0; bottom: 0;
                    background: rgba(0,0,0,0.18);
                    z-index: 3000;
                    align-items: center;
                    justify-content: center;
                    animation: fadeInBg 0.3s;
                }
                .nouvel-emprunt-form.show-form {
                    display: flex;
                }
                @keyframes fadeInBg {
                    from { background: rgba(0,0,0,0); }
                    to { background: rgba(0,0,0,0.18); }
                }
                .form-animated {
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
                    padding: 32px 28px 24px 28px;
                    min-width: 340px;
                    position: relative;
                    animation: slideInForm 0.5s cubic-bezier(.4,0,.2,1);
                }
                @keyframes slideInForm {
                    from { transform: translateY(-60px) scale(0.95); opacity: 0; }
                    to { transform: translateY(0) scale(1); opacity: 1; }
                }
                .input-group {
                    margin-bottom: 14px;
                    display: flex;
                    flex-direction: column;
                }
                .input-group label {
                    font-weight: 500;
                    margin-bottom: 4px;
                    color: #0056b3;
                }
                .input-group input, .input-group select {
                    padding: 7px 10px;
                    border: 1px solid #b3c6e0;
                    border-radius: 5px;
                    font-size: 15px;
                    transition: border-color 0.3s, box-shadow 0.3s;
                }
                .input-group input:focus, .input-group select:focus {
                    border-color: #0073e6;
                    box-shadow: 0 0 0 2px #e6f0ff;
                    outline: none;
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
                    transition: background 0.3s, color 0.3s;
                }
                .btn-cancel:hover {
                    background: #ffd6d6;
                    color: #e60000;
                }
                .close-btn {
                    position: absolute;
                    right: 12px;
                    top: 12px;
                    font-size: 22px;
                    color: #888;
                    cursor: pointer;
                    transition: color 0.2s, transform 0.2s;
                }
                .close-btn:hover {
                    color: #e60000;
                    transform: rotate(90deg) scale(1.2);
                }
                </style>
                <script>
                function closeEmpruntForm() {
                    document.getElementById('nouvel-emprunt-form').classList.remove('show-form');
                }
                </script>
            </div>
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
