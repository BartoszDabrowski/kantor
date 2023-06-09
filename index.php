<!doctype html>
<?php
    include 'class.php';
    include 'conn.php';

   
    
    
    $currencies = GetCurrencies::get();
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_db);

    
    $test = new InsertCommand($conn, 'currencies');
    $zmienna =[];
    foreach ($currencies as $curr) array_push($zmienna, $curr->to_database());
    
    $test->execute($zmienna);

    //print_r($x);
    //$x = Currency::from_database($zmienna[0]);
    //print_r($zmienna);










?>