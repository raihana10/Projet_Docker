<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Créer un nouveau groupe</h2>

    <form method="POST" action="{{ route('store') }}">
        @csrf
        <label for="name">Nom du groupe :</label>
        <input type="text" name="name" required><br>

        <label for="description">Description :</label>
        <textarea name="description"></textarea><br>

        <label for="join_code">Code d'invitation :</label>
        <input type="text" name="join_code" required><br>

        <button type="submit">Créer</button>
    </form>
</body>
</html>

