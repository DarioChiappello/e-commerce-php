<!DOCTYPE HTML>
<html>
    <head>
        <title>E-Commerce</title>
        <link rel="stylesheet" href="<?= base_url ?>assets/styles.css">
    </head>
    <body>
        <div id="container">
            <!-- header -->
            <header id="header">
                <div id="logo">
                    <img src="<?= base_url ?>assets/img/logo.png" alt="Logo">
                    <a href="<?= base_url ?>">Clothing Store</a>
                </div>
            </header>
            <?php $categorias=Utils::showCategorias();?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>
                    <?php while($cat = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
                        </li>
                    <?php endwhile;?>
                </ul>
            </nav>
            <div id="content">