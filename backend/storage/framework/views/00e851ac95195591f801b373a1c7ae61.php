<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if(auth()->guard()->check()): ?>
    <p>vou etes connécte</p>
    <form action="/logout" method="POST">
        <?php echo csrf_field(); ?>
        <button>deconnexion</button>
    </form>
    <div style ="border: 3px solid black;">
        <h2>Ajouter un dette</h2>
        <form action="/creat-dette" method="POST">
            <?php echo csrf_field(); ?>
            <input name="nom" type="text" placeholder="nom">
            <input name="prix" type="text" placeholder="prix">
            <input name="description" type="text" placeholder="description">
            <button>ajouter</button>
        </form>
    </div>
    <?php else: ?> 
    <div style ="border: 3px solid black;">
        <h2>Registrer</h2>
        <form action="/register" method="POST">
            <?php echo csrf_field(); ?>
            <input name="nom" type="text" placeholder="nom">
            <input name="email" type="text" placeholder="email">
            <input name="mot_de_passe" type="password" placeholder="mot de passe">
            <button>register</button>
        </form>
    </div>
    <div style ="border: 3px solid black;">
        <h2>login</h2>
        <form action="/login" method="POST">
            <?php echo csrf_field(); ?>
            <input name="loginnom" type="text" placeholder="nom">
            <input name="loginmot_de_passe" type="password" placeholder="mot de passe">
            <button>login</button>
        </form>
    </div>
    <?php endif; ?>
    
</body>
</html><?php /**PATH /var/www/resources/views/test.blade.php ENDPATH**/ ?>