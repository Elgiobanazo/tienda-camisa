<h2>Tu pedido se ha confirmado</h2>

<p style="width: 80%; margin: auto;">Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria a la cuenta 3891238213 con el coste del pedido, sera procesado y enviado</p>

<div style="width: 220px; margin: 20px auto 20px auto;">
    <h3 style="margin-bottom: 10px;">Datos del pedido:</h3>
    <p style="text-align: left">- Numero del pedido: #<?= $dataOrder ->id ?></p>
    <p style="text-align: left; margin: 4px 0">- Total a pagar: $ <?= $dataOrder ->cost ?></p>
</div>

<h3 style="margin-bottom: 10px">Productos del pedido:</h3>
<table style="margin-bottom: 20px;" class="products-cart-table">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
<?php while($product = $products->fetch_object()): ?>
    <tr>
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
