
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Esp</title>
</head>
<style>
    /* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}


a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Tabla */
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
}

td {
    background-color: #fff;
    color: #333;
}

td a {
    margin-right: 10px;
    padding: 6px 10px;
    background-color: #28a745;
    color: white;
    border-radius: 4px;
}

td a:hover {
    background-color: #218838;
}

/* Botón de nuevo Esp */
a[href='/esp/create'] {
    display: inline-block;
    padding: 10px 20px;
    margin: 20px auto;
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    text-align: center;
}

a[href='/esp/create']:hover {
    background-color: #218838;
}

</style>
<body>
    <h1>Listado de Esp</h1>
    <a href="/esp/create">Nuevo Esp</a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($esps as $esp): ?>
            <tr>
                <td><?= $esp->getNombre() ?></td>
                <td><?= $esp->getDescripcion() ?></td>
                <td><?= $esp->getPrecio() ?></td>
                <td>
                    <a href="/esp/show/<?= $esp->getId() ?>">Ver</a>
                    <a href="/esp/edit/<?= $esp->getId() ?>">Editar</a>
                    <a href="/esp/delete/<?= $esp->getId() ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
