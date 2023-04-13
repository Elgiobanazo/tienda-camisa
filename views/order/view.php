<h2>Detalle del pedido</h2>

<?php if($ord): ?>
    <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?>
        
        <?php if(isset($_SESSION['update_status']) && $_SESSION['update_status'] == 'successful'): ?>
            <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">El estado del pedido se ha actualizado de manera exitosa</span>
        <?php endif; ?>

        <?php if(isset($_SESSION['update_status']) && $_SESSION['update_status'] == 'failed'): ?>
            <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de actualizar el estado del pedido</span>
        <?php endif ?>

        <?php Utils::sessionDelete('update_status') ?>

        <h3 style="margin-bottom: 5px">Cambiar estado del pedido</h3>
        <form action="<?= base_url ?>order/statusUpdate" method="POST">
            <input type="hidden" name="id" value="<?= $ord->id ?>">
            <select name="status" style="padding: 10px 0; border: 3px solid #000; width: 200px; text-align: center;">
                <option value="confirm" <?= $ord->status == 'confirm' ? 'selected' : '';?>>Pendiente</option>
                <option value="preparation" <?= $ord->status == 'preparation' ? 'selected' : '';?>>En preparación</option>
                <option value="ready" <?= $ord->status == 'ready' ? 'selected' : '';?>>Preparado para enviar</option>
                <option value="sended" <?= $ord->status == 'sended' ? 'selected' : '';?>>Enviado</option>
            </select>

            <button type="submit" class="blue detail-button-button">Cambiar estado</button>
        </form>

        <h3 style="margin: 0 0 5px 0">Información del usuario</h3>
        <p><strong style="color: green">Nombre:</strong> <?= $user->name ?></p>
        <p style="margin: 3px 0"><strong style="color: green">Apellidos:</strong> <?= $user->lastname ?></p>
        <p style="margin: 0 0 15px 0"><strong style="color: green">Email:</strong> <?= $user->email ?></p>
    <?php endif; ?>

    <h3 style="margin: 0 0 5px 0">Dirección de envio</h3>
    <div style="width: 50; margin: autox">
        <p><strong style="color: green">Departamento:</strong> <?= $ord->departament ?></p>
        <p style="margin: 3px 0"><strong style="color: green">Ciudad:</strong> <?= $ord->city ?></p>
        <p><strong style="color: green">Dirección:</strong> <?= $ord->address ?></p>
    </div>

    <h3 style="margin: 15px 0 5px 0">Datos del pedido</h3>
    <div>
        <p><strong style="color: green">Estado:</strong> <?= Utils::showStatus($ord->status) ?></p>
        <p  style="margin: 3px 0"><strong style="color: green">Numero del pedido: </strong>#<?=$ord->id?></p>
        <p><strong style="color: green">Total a pagar: </strong>$<?= $ord->cost ?></p>
        <p  style="margin: 3px 0"><strong style="color: green">Fecha: </strong><?= Utils::showDateFormatSpanish($ord->date) ?></p>
                                                        <!-- Para tranformar el formato de 24 horas al formato normal de 12 horas  -->
        <p><strong style="color: green">Hora: </strong> <?= Utils::showHourFormat12($ord->hour); ?></p>
     
    </div>

    <h3 style="padding: 15px 0 5px 0;">Productos del pedido</h3>
    <table style="margin: 10px auto 20px auto" class="products-cart-table">
    <tr>
        <th>ID</th>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
<?php while($product = $products->fetch_object()): ?>
    <tr>
        <td><?= $product->id ?></td>
        <?php if($product->image != null): ?>
            <td><img src="<?= base_url ?>uploads/product-photos/<?= $product->image ?>" alt=""></td>
        <?php else: ?>
            <td><img src="" alt=""></td>
        <?php endif ?>
        <td><?= $product->name ?></td>
        <td><?= $product->price ?></td>
        <td><?= $product->unids ?></td>
    </tr>
<?php endwhile; ?>
</table>

<?php else: ?>
    <p>El pedido no existe</p>
<?php endif ?>


