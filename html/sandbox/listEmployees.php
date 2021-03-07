<?php
$pdo = require('db.php');
?>

<div class="container">

    <h1 id="employees">Employés</h1>
    <div class="row">
        <?php
        $query = $pdo->query('select e1.employeeNumber, e1.lastName, e1.firstName, e2.employeeNumber referrantNB, e2.lastName referrantLastName, e2.firstName referrantFirstName, e2.jobTitle referrantJobTitle from employees e1
         join employees e2 on e1.reportsTo = e2.employeeNumber');
        $employees = $query->fetchAll(PDO::FETCH_ASSOC);

        echo '<table class="table">';
        echo '<thead>';
        echo '<tr><td>Id Employee</td><td>Name Employee</td><td>REFERRANT NB</td><td>REFERRANT NAME</td><td>REFERRANT JOB TITLE</td></tr>';
        echo '</thead>';
        foreach ($employees as $employee) {
            echo '<tr>';
            echo "<td>{$employee["employeeNumber"]}</td>" ;
            echo "<td>{$employee["lastName"]} {$employee["firstName"]} </td>" ;
            echo "<td>{$employee["referrantNB"]}</td>" ;
            echo "<td>{$employee["referrantLastName"]} {$employee["referrantFirstName"]}</td>" ;
            echo "<td>{$employee["referrantJobTitle"]}</td>" ;
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </div>
</div>
