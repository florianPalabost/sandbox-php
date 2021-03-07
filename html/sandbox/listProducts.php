<?php
$pdo = require_once('db.php');
?>

<div class="container">
    <h1 id="products">Produits</h1>
    <div class="row">
        <table class="table w-50">
            <tr>
                <td>Product name</td>
            </tr>
        <?php
            $query = $pdo->query('select * from products order by productName');
            $products = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($products as $product) {
               // template product
                echo "<tr><td>{$product["productName"]}</td></tr>" ;
            }
        ?>
        </table>
    </div>
</div>
