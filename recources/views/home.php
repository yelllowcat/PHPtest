<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola desde la pagina home</h1>
    <p><?= $title; ?></p>
    <p><?= $content; ?></p>
    <ul>
        <?php foreach($contacts as $contact): ?>
            <li><?= $contact['name']; ?></li>
            <li><?= $contact['email']; ?></li>
            <li><?= $contact['phone']; ?></li>
            <li><?= $contact['id']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>