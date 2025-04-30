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
<div class="navbar">
    <button class="menu-icon" onclick="toggleSidebar()">☰</button>
    <div class="icons">
        <span style="margin-right: 10px;">Bonjour, {{ $user->name ?? '' }}</span>
        <a href="#">❓</a>
        <a href="#">👤</a>
        <span style="position:relative;">
            <a href="#" id="friends-icon" onclick="toggleFriendsBlock(event)">👥</a>
            <div id="friends-block" style="display:none; position:absolute; right:0; top:30px; background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.15); padding:16px; min-width:220px; z-index:2000;">
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
                <button onclick="document.getElementById('friends-block').style.display='none'" style="margin-top:10px;">Fermer</button>
            </div>
        </span>
        <script>
            function toggleFriendsBlock(e) {
                e.preventDefault();
                const block = document.getElementById('friends-block');
                block.style.display = block.style.display === 'block' ? 'none' : 'block';
            }
        </script>
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
            <li><a href="#">💰 Emprunts </a></li>
            <li><a href="#">➕ Nouveau transaction</a></li>
            <li><a href="#">📊 Rapport</a></li>
            <li><a href="#">📅 Calendrier</a></li>
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
                <button onclick="document.getElementById('nouvel-emprunt-form').style.display='block'">+ Nouvelle emprunt</button>
                <div id="nouvel-emprunt-form" style="display:none; margin-top:20px; border:1px solid #ccc; border-radius:8px; padding:16px; background:#f9f9f9;">
                    <form action="{{ route('private_debts.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name">Nom de l'emprunt :</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="value">Montant :</label>
                            <input type="number" step="0.01" name="value" id="value" required>
                        </div>
                        <div>
                            <label for="id_to">Nom de l'utilisateur (destinataire) :</label>
                            <input type="text" name="id_to_name" id="id_to" required placeholder="Nom exact de l'utilisateur">
                        </div>
                        <div>
                            <label for="description">Description :</label>
                            <input type="text" name="description" id="description">
                        </div>
                        <div>
                            <label for="status">Statut :</label>
                            <select name="status" id="status" required>
                                <option value="unpaid">Non payé</option>
                                <option value="paid">Payé</option>
                            </select>
                        </div>
                        <button type="submit" style="margin-top:10px;">Ajouter</button>
                        <button type="button" onclick="document.getElementById('nouvel-emprunt-form').style.display='none'" style="margin-top:10px; margin-left:10px;">Annuler</button>
                    </form>
                </div>
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
