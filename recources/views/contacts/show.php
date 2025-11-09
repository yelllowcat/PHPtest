<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de contacto</title>
</head>
<body>
    <a href="/contacts/<?= $contact['id'] ?>/edit">Editar</a>
    <h1>Detalle de contacto</h1>
    <p>Nombre: <?= $contact['name'] ?></p>
    <p>Email: <?= $contact['email'] ?></p>
    <p>Telefono: <?= $contact['phone'] ?></p>
    <a href="/contacts">Volver</a>
    <form action="/contacts/<?= $contact['id'] ?>/delete" method="post">
        <button>Eliminar</button>
    </form>
</body>
</html>