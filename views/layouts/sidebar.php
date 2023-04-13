        <div id="content">
            <aside>
                <div class="block-aside">
                    <h3>Mi carrito</h3>
                    <?php $stats = Utils::cartStats(); ?>
                    <ul>
                        <li><a href="<?= base_url ?>cart/index">Productos (<?= $stats['products'] ?>)</a></li>
                        <li><a href="<?= base_url ?>cart/index">Total: $<?= $stats['total'] ?></a></li>
                        <li><a href="<?= base_url ?>cart/index">Mi carrito</a></li>
                    </ul>

                </div>
                <?php if(!isset($_SESSION['user'])): ?>
                    <div id="login" class="block-aside login">
                        <h3>Iniciar sesión</h3>

                        <?php if(isset($_SESSION['general_error']['login'])): ?>
                            <span class="red-alert" style="font-size: 14px; margin-bottom: 10px;"><?= $_SESSION['general_error']['login'] ?></span>
                        <?php endif; ?>

                        <form action="<?= base_url ?>user/login" method="POST">
                            <label for="email">Correo:</label>
                            <input type="text" name="email" placeholder="Ingrese tu correo">

                            <label for="">Contraseña:</label>
                            <input type="password" name="password" placeholder="Ingrese tu contraseña">

                            <button type="submit" id="login-button" class="blue">Iniciar sesión</button>
                        </form>

                        <?php Utils::sessionDelete('general_error'); ?>

                        <ul>
                            <li><a href="<?= base_url ?>user/register">Registrate Aquí</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="block-aside">
                        <h3><?= $_SESSION['user']->name.' '.$_SESSION['user']->lastname ?></h3>
                        <?php if($_SESSION['user']->image != null): ?>
                            <img src="<?= base_url ?>uploads/profile-pictures/<?= $_SESSION['user']->image ?>" alt="Foto de perfil" title="<?= $_SESSION['user']->name ?>" id='profile-picture'>
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/user-icon.png" alt="Foto de perfil" title='<?= $_SESSION['user']->name ?>' id="profile-picture">
                        <?php endif; ?>

                        <ul>
                            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'fdf'): ?>
                                <li><a href="<?= base_url ?>category/management">Gestionar categorias</a></li>
                                <li><a href="<?= base_url ?>product/management">Gestionar productos</a></li>
                                <li><a href="<?= base_url ?>order/management
                                ">Gestionar pedidos</a></li>
                            <?php endif; ?>
                            <li><a href="<?= base_url ?>order/myorders">Mis pedidos</a></li>
                            <li><a href="<?= base_url ?>user/logout">Cerrar sesión</a></li>
                        </ul>
                    </div>

                   
                        
                <?php endif; ?>
            </aside>

            <div id="all-principal-content">