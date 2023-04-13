<h2>Editar categoria: <?= $cat->name ?></h2>

<?php if(isset($_SESSION['edit_category']) && $_SESSION['edit_category'] == 'successful'): ?>
    <span class="green-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">La categoria fue actualizada correctamente</span>
<?php endif; ?>

<?php if(isset($_SESSION['edit_category']) && $_SESSION['edit_category'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de actualizar la categoria</span>
<?php endif; ?>

<div style="border: 3px solid #888; width: 80%; margin: auto; border-radius: 10px; padding: 25px 0px 20px 0">
    <?php if(isset( $_SESSION['input_error']['name'])): ?>
        <span class="red-alert" style="margin-bottom: 10px"><?= $_SESSION['input_error']['name'] ?></span>
    <?php endif; ?>

    <div class="input-container">
        <form action="<?= base_url ?>category/update" method="POST">
            <input type="hidden" name="id" value="<?= $cat->id ?>">

            <input type="text" name="name" value="<?= $cat->name ?>">
            <label for="">Nombre</label>

            <button type="submit" class="blue" style="width: 180px; margin: 10px auto 0 auto; padding: 8px 0; font-size: 16px; border-radius: 5px"><i class="fa-solid fa-floppy-disk" style="margin-right: 10px; transform: scale(1.3)"></i> Guardar cambios</button>
        </form>
    </div>
</div>

<?php
    Utils::sessionDelete('edit_category');
    Utils::sessionDelete('input_error');

?>
