<?php if (count($products) > 0): ?>
    <div id="cards">
    <?php foreach ($products as $product): ?>
        <div class="card" id="<?= $product->id; ?>">
            <?php if ($product->image_url): ?>
                <img class="card-cover" src="<?= $product->image_url; ?>" alt="Product Image">
            <?php else: ?>
                <img class="card-cover" src="/img/product-cover.png" alt="Product Image">
            <?php endif; ?>
            
            <div class="card-content">
                <div class="card-content__product">
                    <strong><?= $product->price?> rub.</strong>
                    <p><?= " {$product->name} "; ?></p>
                </div>
                <div class="card-content__cart">
                    <p class="product-counter">
                        <?= $_SESSION["cart"][$product->id] ?? " " ?>
                    </p>    
                    <button class="remove-from-cart" style="display: <?= isset($_SESSION["cart"][$product->id]) ? 'block' : 'none'; ?>">
                        <img src="/img/icon/remove.svg" alt="Remove from cart">
                    </button>
                    <button class="add-to-cart">
                        <img src="/img/icon/add.svg" alt="Add to cart">
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <script src="/js/masonry.min.js"></script>
    <script src="/js/cart.js"></script>
<?php else: ?>
    <div class="err-container">
        <h1>Nothing added yet</h1>
        <img src="/img/404_sad_robot.png" alt="sad robot">
    </div>
<?php endif; ?>