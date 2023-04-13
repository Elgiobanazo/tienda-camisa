<h2>Mis pedidos</h2>

<?php if($orders->num_rows >= 1): ?>
    <table class="administrator-table">
        <tr>
            <th style="padding: 10px 0">N° pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>

        <?php while($ord = $orders->fetch_object()): ?>
        <tr>
            <td style="padding: 10px 0"><a href="<?= base_url ?>order/view&id=<?= $ord->id ?>" class="blue-link"><?= $ord->id ?></a></td>
            <td>$<?= $ord->cost ?></td>
            <td><?= $ord->date ?></td>
            <td><?= Utils::showStatus($ord->status) ?></td>
        </tr>

        <?php endwhile ?>
    </table>
<?php else: ?>
    <p>No hay pedidos pendientes</p>
<?php endif ?>