<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda camisa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="principal-container">
        <!-- HEADER -->
        <header >
            <div id="logo-container">
                <img src="assets/img/logo-camisa.png" alt="">
                <a href=""><h1>Tienda camisa</h1></a>
            </div>
        </header>

        <!-- MENU -->

        <nav id="nav-container">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="">Categoria</a></li>
            </ul>
        </nav>


        <div id="content">
            <aside>
                <div id="login" class="block-aside">
                    <h3>Iniciar sesión</h3>

                    <form action="" method="POST">
                        <label for="email">Correo:</label>
                        <input type="text" name="email" placeholder="Ingrese tu correo">

                        <label for="">Contraseña:</label>
                        <input type="text" name="password" placeholder="Ingrese tu contraseña">

                        <button type="submit" class="blue login-button">Iniciar sesión</button>
                    </form>

                    <ul>
                        <li><a href="">Registrate Aquí</a></li>
                    </ul>
                </div>
            </aside>

            <div id="all-principal-content">
                <h2>Productos destacados</h2>

                <div class="product-container">
                    <a href="">
                        <img src="assets/img/logo-camisa.png" alt="">
                        <span>Camiseta marca puma</span>
                    </a>
                    <p>$10</p>
                    <a href="" class="green buy-button">Comprar</a>
                </div>

                <div class="product-container">
                    <a href="">
                        <img src="assets/img/logo-camisa.png" alt="">
                        <span>Camiseta marca puma</span>
                    </a>
                    <p>$10</p>
                    <a href="" class="green buy-button">Comprar</a>
                </div>

                <div class="product-container">
                    <a href="">
                        <img src="assets/img/logo-camisa.png" alt="">
                        <span>Camiseta marca puma</span>
                    </a>
                    <p>$10</p>
                    <a href="" class="green buy-button">Comprar</a>
                </div>

                <div class="product-container">
                    <a href="">
                        <img src="assets/img/logo-camisa.png" alt="">
                        <span>Camiseta marca puma</span>
                    </a>
                    <p>$10</p>
                    <a href="" class="green buy-button">Comprar</a>
                </div>
            </div>
        </div>

        <footer>
            <p>Pagina desarrollado por Giovanny Orozco &copy <?= date('Y') ?></p>
        </footer>
    </div>
</body>
</html>