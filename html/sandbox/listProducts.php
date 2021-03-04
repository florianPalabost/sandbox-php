<?php
$pdo = require_once('../db.php');
?>

<div class="container">
    <div class="row">
        <?php
            $query = $pdo->query('select * from products');
            $products = $query->fetchAll();

            foreach ($products as $product) {
               // template product
            }
        ?>
    </div>
</div>
