<h2>Carrito de compras</h2>

<?php if($cart): ?>
    <?php if(isset($_SESSION['error_cart'])): ?>
        <span class="red-alert" style="margin-bottom: 20px; width: 80%; font-size: 18px; padding: 10px; box-sizing: border-box"><?= $_SESSION['error_cart'] ?></span>
    <?php endif ?>

    <?php Utils::sessionDelete('error_cart'); ?>
    <table class="products-cart-table">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach($_SESSION['cart'] as $index => $value): ?>
            <tr>
                <td>
                    <?php if($value['product']->image != null): ?>
                        <img src="<?= base_url ?>uploads/product-photos/<?= $value['product']->image ?>" alt="Foto del producto">
                    <?php else: ?>
                        <img src="<?= base_url?>assets/img/logo-camisa.png" alt="Foto del producto">
                    <?php endif ?>
                </td>
                <td><a href="<?= base_url ?>product/view&id=<?= $value['product_id'] ?>" id="link-product-table"><?= $value['product']->name ?></a></td>
                <td>$<?= $value['price'] ?> </td>
                <td><a href="<?= base_url ?>cart/up&index=<?= $index ?>" class="up-button"><i class="fa-solid fa-plus"></i></a> <span style="font-size: 18px"><?= $value['unids'] ?></span> <a href="<?= base_url ?>cart/down&index=<?= $index ?>" class="down-button"><i class="fa-solid fa-minus"></i></a></td>
                <td><a href="<?= base_url ?>cart/deleteone&index=<?= $index ?>" id="trash-button-table"><i class="fa-solid fa-trash"></i></a></td>
            </tr>
        <?php endforeach ?>
    </table>

    <a href="<?= base_url ?>cart/deleteall" id="cart-delete-button"><i class="fa-solid fa-cart-arrow-down"></i>Vaciar carrito</a>
    <?php $stats = Utils::cartStats(); ?>
    <h3 style="margin-left: 24%; display: inline-block">Precio total: $<?= $stats['total'] ?></h3>
    <a href="<?= base_url ?>order/index" class="green" id="do-receipt-button"><i class="fa-solid fa-file-invoice-dollar"></i>Hacer pedido</a>
<?php else: ?>
    <p>El carrito esta vacio, añade algun producto</p>
<?php endif ?>