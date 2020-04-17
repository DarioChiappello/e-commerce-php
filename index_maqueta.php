<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>E-Commerce</title>
        <link rel="stylesheet" href="assets/styles.css">
    </head>
    <body>
        <div id="container">
            <!-- header -->
            <header id="header">
                <div id="logo">
                    <img src="assets/img/logo.png" alt="Logo">
                    <a href="index.php">Tienda de camisetas</a>
                </div>
            </header>


            <!--menu-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                    <li>
                        <a href="#">Categoria</a>
                    </li>
                    <li>
                        <a href="#">Categoria</a>
                    </li>
                    <li>
                        <a href="#">Categoria</a>
                    </li>
                    <li>
                        <a href="#">Categoria</a>
                    </li>
                    <li>
                        <a href="#">Categoria</a>
                    </li>
                </ul>
            </nav>
            <div id="content">
                <!--sidebar-->
                <aside id="sidebar">
                    <div id="login" class="block_aside">
                        <h3>Ingresar</h3>
                        <form action="#" method="POST">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password">

                            <input type="submit" value="Enviar">
                        </form>
                        
                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li><a href="#">Gestionar pedidos</a></li>
                            <li><a href="#">Gestionar categorias</a></li>
                        </ul>
                        
                        
                        
                    </div>
                </aside>
                <!--content-->
                <div id="central">
                    <h1>Productos destacados</h1>
                    <div class="product">
                        <img src="assets/img/logo1.png">
                        <h2>Camiseta azul</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/logo1.png">
                        <h2>Camiseta azul</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/logo1.png">
                        <h2>Camiseta azul</h2>
                        <p>30 euros</p>
                        <a href="#" class="button">Comprar</a>
                    </div>
                </div>

            </div>
            <!--footer-->
            <footer id="footer">
                <p>Desarrollado por Darío Chiappello &copy; <?= date('Y') ?></p>
            </footer>
        </div>
    </body>
</html>

