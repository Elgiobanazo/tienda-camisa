<h2>Gestionar categorias</h2>

<?php if(isset($_SESSION['save_category']) && $_SESSION['save_category'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">La categoria fue guardada exitosamente</span>
<?php endif ?>

<?php if(isset($_SESSION['delete_category']) && $_SESSION['delete_category'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">La categoria fue eliminada exitosamente</span>
<?php endif ?>

<?php if(isset($_SESSION['delete_category']) && $_SESSION['delete_category'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de eliminar la categoria</span>
<?php endif ?>

<?php 
    Utils::sessionDelete('save_category');
    Utils::sessionDelete('delete_category');
?>

<a href="<?= base_url ?>category/create" class="green add-category-button"><i class="fa-solid fa-plus"></i>  Agregar categoria</a>
<?php if($categories->num_rows >= 1): ?>
    <table class="administrator-table">
        <tr>
            <th style="padding: 10px 0">ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php while($cat = $categories->fetch_object()): ?>
        <tr>
            <td><?= $cat->id ?></td>
            <td><?= $cat->name ?></td>
            <td style="width: 30%; min-width: 185px;">
                <a href="<?= base_url ?>category/edit&id=<?= $cat->id ?>" title="Editar" class="edit-button"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="<?= base_url ?>category/delete&id=<?= $cat->id ?>" title="Eliminar" class="delete-button"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="margin-top: 30px">No hay categorias agregadas</p>
<?php endif; ?>