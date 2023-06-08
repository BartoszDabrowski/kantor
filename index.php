<!doctype html>
<?php
    include 'class.php';
    include 'conn.php';

   
    
    
    $currencies = GetCurrencies::get();
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_db);

    
    $test = new SelectCommand($conn, 'currencies');
    $zmienna = $test->execute($currencies[0]->to_database());
    $x = Currency::from_database($zmienna[0]);
    print_r($x)










?>