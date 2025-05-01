<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Dettes - {{ $selectedGroup->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .group-selector {
            margin-bottom: 20px;
            padding: 10px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .group-selector select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
        }
        
        input[type="number"] {
            width: 60px;
            padding: 5px;
            text-align: center;
        }
        
        .group-name {
            font-size: 1.5em;
            margin-bottom: 15px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="group-selector">
        <form method="GET" action="{{ route('Page3') }}">
            <label for="group-select">Sélectionnez un groupe :</label>
            <select id="group-select" name="group_id" onchange="this.form.submit()">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $group->id == $selectedGroup->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    
    <div class="group-name">{{ $selectedGroup->name }}</div>
    
    <table>
        <thead>
            <tr>
                <th></th>
                @foreach($groupUsers as $col)
                    <th>{{ $col->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($groupUsers as $row)
                <tr>
                    <th>{{ $row->name }}</th>
                    @foreach($groupUsers as $col)
                        <td>
                            @if($row->id === $col->id)
                                —
                            @else
                                <input type="number"
                                       class="debt-cell"
                                       data-from="{{ $row->id }}"
                                       data-to="{{ $col->id }}"
                                       data-group="{{ $selectedGroup->id }}"
                                       value="{{ optional($debits["{$row->id}-{$col->id}"] ?? null)->value }}">
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        const token = document.querySelector('meta[name="csrf-token"]').content;

        document.querySelectorAll('input.debt-cell').forEach(input => {
            input.addEventListener('change', () => {
                fetch("{{ route('debts.update') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        id_from: input.dataset.from,
                        id_to: input.dataset.to,
                        group_id: input.dataset.group,
                        value: input.value,
                        name: "Dette automatique",
                        description: "Ajout via le tableau"
                    })
                })
                .then(r => r.json())
                .then(data => {
                    console.log('Enregistré', data);
                    // Actualiser la page après mise à jour
                    window.location.reload();
                })
                .catch(err => console.error(err));
            });
        });
    </script>
</body>
</html>