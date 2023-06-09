<?php

include 'class.php';
include 'conn.php';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_db);


$select = new SelectCommand($conn, 'transactions');
$result = $select->execute();
?>


<table>
    <tr>
        <th>Z waluty</th>
        <th>Na walutę</th>
        <th>Ile</th>
        <th>Na ile</th>
        <th>Kurs</th>
    </tr>
    <?php foreach($result as $data){ 
        echo "<tr>";
        echo "<th>'$data[0]'</th>";
        echo "<th>'$data[1]'</th>";
        echo "<th>'$data[2]'</th>";
        echo "<th>'$data[3]'</th>";
        echo "<th>'$data[4]'</th>";
        echo "</tr>";
     } ?>

</table>





