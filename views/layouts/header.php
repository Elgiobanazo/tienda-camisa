<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda camisa</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
    <div id="principal-container">
        <!-- HEADER -->
        <header >
            <div id="logo-container">
                <img src="<?= base_url ?>assets/img/logo-camisa.png" alt="">
                <a href="<?= base_url ?>"><h1>Tienda camisa</h1></a>
            </div>
        </header>

        <!-- MENU -->
        <nav id="nav-container">
            <?php $categories = Utils::getAllCategories(); ?>
            <ul>
                <li><a href="<?= base_url ?>">Inicio</a></li>

                <?php while($category = $categories->fetch_object()): ?>
                    <li><a href="<?= base_url ?>category/view&id=<?= $category->id ?>"><?= $category->name ?></a></li>
                <?php endwhile; ?>
            </ul>
        </nav>