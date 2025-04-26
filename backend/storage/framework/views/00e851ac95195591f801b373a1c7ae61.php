<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style ="border: 3px solid black;">
        <h2>Registrer</h2>
            <form action="/register" method="POST">
                <?php echo csrf_field(); ?>
                <input name="name" type="text" placeholder="nom">
                <input name="email" type="text" placeholder="email_institutionnelle">
                <input name="password" type="password" placeholder="password">
                <button>register</button>
            </form>
        
    </div>
</body>
</html><?php /**PATH /var/www/resources/views/test.blade.php ENDPATH**/ ?>