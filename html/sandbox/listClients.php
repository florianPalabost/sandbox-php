<?php $pdo = require('db.php'); ?>

<div class="container">
    <h1 id="clients">Clients</h1>
    <div class="row">
        <?php
        $query = $pdo->query('select c.customerNumber, c.customerName, count(o.customerNumber) nb_commandes, SUM(p.amount) sum_cumul from customers c
         join orders o on c.customerNumber = o.customerNumber
         join payments p on p.customerNumber = o.customerNumber
         group by c.customerNumber');

        $customers = $query->fetchAll(PDO::FETCH_ASSOC);


        echo '<table class="table">';
        echo '<thead>';
        echo '<tr><td>Id Client</td><td>Name Client</td><td>NB orders</td><td>Sum orders</td></tr>';
        echo '</thead>';
        foreach ($customers as $customer) {
            echo '<tr>';
            echo "<td>{$customer["customerNumber"]}</td>" ;
            echo "<td>{$customer["customerName"]}</td>" ;
            echo "<td>{$customer["nb_commandes"]}</td>" ;
            echo "<td class='euro'>{$customer["sum_cumul"]}</td>" ;
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </div>
</div>
