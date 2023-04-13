<?php if($flag): ?>
    <h2>Hacer pedido</h2>

    <?php if(isset($_SESSION['save_order']) && $_SESSION['save_order'] == 'failed'): ?>
        <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de procesar tu pedido</span>
    <?php endif ?>

    <h3>Dirección para el envio</h3>
    <div class="input-order-container">  
        <?php if(isset($_SESSION["general_error"]['order'])): ?>
            <span class="red-alert" style="margin-bottom: 20px"><?= $_SESSION['general_error']['order'] ?></span>
        <?php endif ?>

        <?php if(isset($_SESSION['input_error'])): ?>  
            <div style="background-color: red; width: 90%; margin: 0 auto 10px auto; border-radius: 10px;">
                <?php if(isset($_SESSION['input_error']['departament'])): ?>
                    <span class="red-alert">- <?= $_SESSION['input_error']['departament'] ?></span>
                <?php endif ?>

                <?php if(isset($_SESSION['input_error']['city'])): ?>
                    <span class="red-alert">- <?= $_SESSION['input_error']['city'] ?></span>
                <?php endif ?>

                <?php if(isset($_SESSION['input_error']['address'])): ?>
                    <span class="red-alert">- <?= $_SESSION['input_error']['address'] ?></span>
                <?php endif ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url ?>order/save" method="POST">
            <div class="input-container">
                <input type="text" name="departament" <?= isset($_SESSION['input_old']['departament']) ? "value='{$_SESSION['input_old']['departament']}'" : ''; ?> required>
                <label for="departament">Departamento</label>
            </div>

            <div class="input-container">
                <input type="text" name="city" <?= isset($_SESSION['input_old']['city']) ? "value='{$_SESSION['input_old']['city']}'" : ''; ?> required>
                <label for="city">Ciudad</label>
            </div>

            <div class="input-container input-large-container" style="width: 65%">
                <input type="text" name="address" <?= isset($_SESSION['input_old']['address']) ? "value='{$_SESSION['input_old']['address']}'" : ''; ?> required>
                <label for="name">Dirección</label>
            </div>

            <button type="submit" class="blue" id="order-confirm-button">Confirmar pedido</button>
        </form>
        <?php 
            Utils::sessionDelete('general_error');
            Utils::sessionDelete('input_error');
            Utils::sessionDelete('input_old');
            Utils::sessionDelete('save_order');
        ?>
    </div>
<?php else: ?>
    <h2>Necesitas estar identificado</h2>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido</p>
<?php endif ?>