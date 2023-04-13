<h2>Agregar nueva categoria</h2>

<?php if(isset($_SESSION['save_category']) && $_SESSION['save_category'] == 'failed'): ?>
    <span class="red-alert" style="width: 80%; font-size: 18px; margin-bottom: 20px; padding: 10px 0">Error al momento de guardar la nueva categoria</span>
<?php endif; ?>

<div style="border: 3px solid #888; width: 80%; margin: auto; border-radius: 10px; padding: 25px 0px 20px 0">
    <?php if(isset($_SESSION['input_error']['name'])): ?>
        <span class="red-alert" style="margin-bottom: 10px"><?= $_SESSION['input_error']['name'] ?></span>
    <?php endif; ?>

    <div class="input-container">
        <form action="<?= base_url ?>category/save" method="POST">
            <input type="text" name="name" <?= isset($_SESSION['input_old']['name']) ? "value='{$_SESSION['input_old']['name']}'" : ''; ?> required>
            <label for="">Nombre</label>

            <button type="submit" class="green" style="margin: 10px auto 0 auto; padding: 8px 30px; font-size: 16px; border-radius: 5px"><i class="fa-solid fa-plus"></i> Agregar</button>
        </form>
    </div>
</div>

<?php
    Utils::sessionDelete('save_category');
    Utils::sessionDelete('input_error');
?>