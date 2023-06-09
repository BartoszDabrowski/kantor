<!doctype html>
<?php
    include 'class.php';
    include 'conn.php';

   
    
    
    $currencies = GetCurrencies::get();
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_db);

    /*
    $test = new InsertCommand($conn, 'currencies');
    $zmienna =[];
    foreach ($currencies as $curr) array_push($zmienna, $curr->to_database());
    
    $test->execute($zmienna);
*/
    //print_r($x);
    //$x = Currency::from_database($zmienna[0]);
    //print_r($zmienna);




    $conn->close();




?>

<form action="change.php" method="post">
    <input type="number" name="ammount" id="ammount" step="0.01">
    <select id="curr_from" name="curr_from">
        <?php foreach ($currencies as $item) { ?>
           <option value="<?php echo $item->GetCurr(); ?>"><?php echo $item->GetCurr(); ?></option>
        <?php } ?>
    </select>
    <select id="curr_to" name="curr_to">
        <?php foreach ($currencies as $item) { ?>
           <option value="<?php echo $item->GetCurr(); ?>"><?php echo $item->GetCurr(); ?></option>
        <?php } ?>
    </select>
    <button type="submit">Przewalutowanie</button>
</form>

<a href="history.php"><button>Historia Transakcji</button></a>
