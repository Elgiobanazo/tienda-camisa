<h2>Gestionar productos</h2>

<?php if(isset($_SESSION['create_product']) && $_SESSION['create_product'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">El producto fue guardado exitosamente</span>
<?php endif; ?>

<?php if(isset($_SESSION['create_product']) && $_SESSION['create_product'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de guardar el producto</span>
<?php endif; ?>

<?php if(isset($_SESSION['delete_product']) && $_SESSION['delete_product'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">El producto fue eliminado exitosamente</span>
<?php endif; ?>

<?php if(isset($_SESSION['delete_product']) && $_SESSION['delete_product'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de eliminar el producto</span>
<?php endif; ?>

<?php 
    Utils::sessionDelete('create_product');
    Utils::sessionDelete('delete_product');
?>

<a href="<?= base_url ?>product/create" class="green add-category-button"><i class="fa-solid fa-plus"></i>  Agregar producto</a>
<?php if($products->num_rows >= 1): ?>
    
    <table style="width: 90%; margin-bottom: 20px" class="administrator-table ">
        <tr>
            <th style="padding: 10px 0">ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>

        <?php while($pro = $products->fetch_object()): ?>
            <tr>
                <td><?= $pro->id ?></td>
                <td><a href="<?= base_url ?>product/view&id=<?= $pro->id ?>" class="blue-link"><?= $pro->name ?></a></td>
                <td>$<?= $pro->price ?></td>
                <td style="width: 8%; "><?= $pro->stock ?></td>
                <td style="width: 25%; min-width: 185px">
                    <a href="<?= base_url ?>product/edit&id=<?= $pro->id ?>" title="Editar" class="edit-button"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="<?= base_url ?>product/delete&id=<?= $pro->id ?>" title="Eliminar" class="delete-button"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php else: ?>
    <p>No hay productos agregados</p>
<?php endif; ?>