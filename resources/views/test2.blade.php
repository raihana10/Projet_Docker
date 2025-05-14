<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Remix Icon CDN pour de belles icônes -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        .notification {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 9999;
            padding: 16px 28px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            animation: fadeIn 0.5s;
        }
        .notification.success {
            background: #e6fff2;
            color: #008c4a;
            border: 1px solid #00c97b;
        }
        .notification.error {
            background: #ffeaea;
            color: #e60000;
            border: 1px solid #e60000;
        }
        .notification.warning {
            background: #fffbe6;
            color: #b38f00;
            border: 1px solid #ffe066;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }
        #calendar-modal {
            position: fixed;
            top: 40px;
            left: 0; right: 0;
            margin: auto;
            width: 350px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.18);
            z-index: 9999;
            padding: 24px;
        }
        #emprunts-modal {
            position: fixed;
            top: 60px;
            left: 0; right: 0;
            margin: auto;
            width: 400px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.18);
            z-index: 9999;
            padding: 24px;
        }
        #rapport-modal {
            position: fixed;
            top: 60px;
            left: 0; right: 0;
            margin: auto;
            width: 400px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.18);
            z-index: 9999;
            padding: 24px;
        }
    </style>
</head>
<body>
@if(session('success'))
    <div class="notification success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="notification error">
        {{ session('error') }}
    </div>
@endif
@if(session('one_day_left'))
    <div class="notification warning">
        {{ session('one_day_left') }}
    </div>
@endif
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
            <li onclick="showEmprunts()" style="cursor:pointer;">
                <i class="ri-money-dollar-circle-line"></i> Emprunts
            </li>
            <li><a href="#"><i class="ri-add-circle-line"></i> Nouveau transaction</a></li>
            <li onclick="showRapport()" style="cursor:pointer;">
                <i class="ri-bar-chart-2-line"></i> Rapport
            </li>
            <li onclick="showCalendar()" style="cursor:pointer;">
                <i class="ri-calendar-line"></i> Calendrier
            </li>
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
                <div style="display: flex; gap: 20px;">
                    <!-- Bouton Créer un groupe -->
                    <button onclick="document.getElementById('nouveau-groupe-form').classList.add('show-form')">+ Créer groupe</button>

                    <!-- Bouton Rejoindre un groupe -->
                    <button onclick="document.getElementById('rejoindre-groupe-form').classList.add('show-form')">→ Rejoindre groupe</button>
                </div>
                <div id="nouveau-groupe-form" class="nouvel-emprunt-form">
                    <form action="{{ route('groups.store') }}" method="POST" class="form-animated">
                        @csrf
                        <div class="close-btn" onclick="closeGroupeForm()" title="Fermer"><i class="ri-close-line"></i></div>
                        <h4 style="margin-bottom:18px;color:#0056b3;">Créer un nouveau groupe</h4>

                        <div class="input-group">
                            <label for="group-name">Nom du groupe :</label>
                            <input type="text" name="name" id="group-name" required>
                        </div>
                        <div class="input-group">
                            <label for="group-description">Description :</label>
                            <input type="text" name="description" id="group-description">
                        </div>
                        <div class="input-group">
                            <label for="join-code">Code de groupe :</label>
                            <input type="text" name="join_code" id="join-code" required>
                        </div>

                        <button type="submit" class="btn-animated">Créer</button>
                        <button type="button" onclick="closeGroupeForm()" class="btn-cancel">Annuler</button>
                    </form>
                </div>

                <!-- Formulaire REJOINDRE GROUPE (modifié) -->
                <div id="rejoindre-groupe-form" class="nouvel-emprunt-form">
                    <form method="POST" action="{{ route('groups.join') }}" class="form-animated">
                        @csrf
                        <div class="close-btn" onclick="closeJoinForm()" title="Fermer"><i class="ri-close-line"></i></div>
                        <h4 style="margin-bottom:18px;color:#0056b3;">Rejoindre un groupe</h4>

                        <div class="input-group">
                            <label for="join_code">Code du groupe :</label>
                            <input type="text" name="join_code" id="join_code" required>
                        </div>

                        <button type="submit" class="btn-animated">Rejoindre</button>
                        <button type="button" onclick="closeJoinForm()" class="btn-cancel">Annuler</button>
                    </form>
                </div>

                <script>
                    function closeJoinForm() {
                        document.getElementById('rejoindre-groupe-form').classList.remove('show-form');
                    }
                </script>

                <script>
                function closeGroupeForm() {
                    document.getElementById('nouveau-groupe-form').classList.remove('show-form');
                }
                </script>
                <style>
                    .nouveau-groupe-form {
                        display: none;
                        position: fixed;
                        left: 0; top: 0; right: 0; bottom: 0;
                        background: rgba(0,0,0,0.18);
                        z-index: 3000;
                        align-items: center;
                        justify-content: center;
                        animation: fadeInBg 0.3s;
                    }
                    .nouveau-groupe-form.show-form {
                        display: flex;
                    }
                </style>
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
                            $dueDate = $userDebts->first()->due_date ?? null;
                            $daysRemaining = $dueDate ? \Carbon\Carbon::parse($dueDate)->diffInDays(now(), false) : null;
                        @endphp
                        <li>
                            {{ $otherUserName }} {{ $sign }}{{ abs($total) }}dh {{ $lastDate }}
                            @if($dueDate)
                                <span style="color:#0073e6;">
                                    (Récupération : {{ \Carbon\Carbon::parse($dueDate)->format('d/m/Y') }})
                                    @if($daysRemaining >= 0)
                                        ({{ $daysRemaining }} jour(s) restant(s))
                                    @else
                                        (Date dépassée)
                                    @endif
                                </span>
                            @endif
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
                        <div class="input-group">
                            <label for="due_date">Date de récupération :</label>
                            <input type="text" name="due_date" id="due_date" required>
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
        <div id="calendar-modal" style="display:none;">
            <button onclick="hideCalendar()" style="float:right;">Fermer</button>
            <div id="calendar"></div>
            <div id="simple-calendar"></div>
        </div>
        <div id="emprunts-modal" style="display:none;">
            <button onclick="hideEmprunts()" style="float:right;">Fermer</button>
            <h3>Mes emprunts</h3>
            <ul>
                @foreach($debts as $debt)
                    <li>
                        {{ $debt->name }} : {{ $debt->value }}dh 
                        @if($debt->due_date)
                            (à rendre le {{ \Carbon\Carbon::parse($debt->due_date)->format('d/m/Y') }})
                        @endif
                        - Statut : {{ $debt->status }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="rapport-modal" style="display:none;">
            <button onclick="hideRapport()" style="float:right;">Fermer</button>
            <h3>Rapport des transactions</h3>
            <ul>
                @foreach($debts as $debt)
                    <li>
                        {{ $debt->name }} : {{ $debt->value }}dh - 
                        @if($debt->due_date)
                            (à rendre le {{ \Carbon\Carbon::parse($debt->due_date)->format('d/m/Y') }})
                        @endif
                        - Statut : {{ $debt->status }}
                    </li>
                @endforeach
            </ul>
            <hr>
            <strong>Total transactions :</strong>
            {{ $debts->sum('value') }} dh
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

    // Cache la notification après 4 secondes
    setTimeout(function() {
        let notif = document.querySelector('.notification');
        if(notif) notif.style.display = 'none';
    }, 4000);

    function showCalendar() {
        document.getElementById('calendar-modal').style.display = 'block';
        if (!window.simpleCalendarRendered) {
            flatpickr("#simple-calendar", {
                inline: true,
                locale: "fr",
                onChange: function(selectedDates, dateStr, instance) {
                    // Ici tu peux afficher un message si la date correspond à une due_date
                    // Ex: alert("Tu as une dette à cette date !");
                }
            });
            window.simpleCalendarRendered = true;
        }
    }

    function hideCalendar() {
        document.getElementById('calendar-modal').style.display = 'none';
    }

    function showEmprunts() {
        document.getElementById('emprunts-modal').style.display = 'block';
    }
    function hideEmprunts() {
        document.getElementById('emprunts-modal').style.display = 'none';
    }

    function showRapport() {
        document.getElementById('rapport-modal').style.display = 'block';
    }
    function hideRapport() {
        document.getElementById('rapport-modal').style.display = 'none';
    }
</script>
<pre>
    {!! json_encode($calendarEvents, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</pre>
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<?php
$calendarEvents = collect($debts)
    ->filter(fn($debt) => !empty($debt->due_date))
    ->map(function($debt) {
        return [
            'title' => 'Rendre à ' . ($debt->id_to_name ?? $debt->id_to),
            'start' => $debt->due_date,
            'message' => "Attention : Il faut rendre l'argent à " . ($debt->id_to_name ?? $debt->id_to) . " ce jour-là !"
        ];
    })
    ->values(); // <-- important pour avoir un tableau indexé
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#due_date", {
            locale: "fr",
            dateFormat: "Y-m-d",
            minDate: "today",
            disableMobile: "true",
            allowInput: true,
            altInput: true,
            altFormat: "d/m/Y",
            placeholder: "Sélectionnez une date"
        });
    });
</script>