<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    text-align: center;
    width: 100%;
}

.login-header h1 {
    font-size: 2rem;
    color: #0056b3;
    margin-bottom: 20px;
}

.login-box {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
}

.login-box h2 {
    margin-bottom: 20px;
    font-size: 1.5rem;
    color: #333;
}

.input-group {
    margin-bottom: 15px;
    text-align: left;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.input-group input {
    width: 100%;
    padding: 10px; 
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    box-sizing: border-box;
}


.login-button {
    width: 100%;
    padding: 10px;
    background-color: #0056b3;
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
}

.login-button:hover {
    background-color: #004099;
}
.logo {
    max-width: 100px; 
    margin: 0 100px; 
    display: inline-block;
    vertical-align: middle;
}
.login-header {
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            
            <h1>Chhal katsalouna</h1>
        </div>
        <div class="login-box">
            <h2>Connexion</h2>
            <form>
                <div class="input-group">
                    <label for="apogee">Email Institutionnel </label>
                    <input type="text" id="apogee" name="apogee" placeholder="Nom.Prenom@etu.uae.ac.ma" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrer mot de passe" required>
                </div>
                <button type="submit" class="login-button">Log In</button>
            </form>
            <p>Pas encore inscrit ? <a href="signup_page.html">Inscrivez-vous</a></p>
        </div>
    </div>
   
</body>
</html>
