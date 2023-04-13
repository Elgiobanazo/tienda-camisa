<?php if($pro): ?>
    <h2><?= $pro->name ?></h2>

    <div class="view-product-container">

        <div class="product-photo-container">
            <?php if($pro->image != null): ?>
                <img src="<?= base_url ?>uploads/product-photos/<?= $pro->image ?>" alt="">
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/logo-camisa.png" alt="">
            <?php endif ?>
        </div>

        <div class="product-information-container">
            <p><?= $pro->description ?></p>
            <p style="font-size: 22px; font-weight: bold; color: #333;">$<?= $pro->price ?></p>
            <?php if($pro->stock >= 1): ?>
                <a href="<?= base_url ?>cart/add&id=<?= $pro->id ?>" class="green buy-product-button"><i class="fa-solid fa-dollar-sign"></i>Comprar</a>
            <?php else: ?>
                <p style="color: red; padding: 10px 0; background-color: #ddd; margin: 11px 0 16.5px 0">¡No disponible!</p>
            <?php endif ?>
        </div>
    </div>
<?php else: ?>
    <h2>El producto no existe</h2>
<?php endif ?>