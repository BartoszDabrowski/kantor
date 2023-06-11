<?php

include 'class.php';
include 'conn.php';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_db);

$new_curr = $_POST['curr_to'];
$old_curr = $_POST['curr_from'];
$ammount = floatval($_POST['ammount']);
$msg = '';

if($new_curr == $old_curr) $msg = "<h1>wybierz różne waluty </h1>";
else{
    if($ammount == 0) $msg = "<h1>Podana wartość nie jest liczbą </h1>";
    else {
        $select = new SelectCommand($conn, 'currencies');
        $result = $select->execute("currency = '$old_curr' OR currency = '$new_curr' ORDER BY date DESC LIMIT 2");
        //$from_object = new Currency($result[0][0],$result[0][1],$result[0][2],$result[0][3]);
        //$to_object = new Currency($result[1][0],$result[1][1],$result[1][2],$result[1][3]);
        $from_object = Currency::from_database($result[0]);
        $to_object = Currency::from_database($result[1]);

        
        if($from_object->GetCurr() == $old_curr) $transaction = new Transaction($from_object,$to_object,$ammount);
        else $transaction = new Transaction($to_object,$from_object,$ammount);

        $x = $transaction->calc();
        $transaction->save($conn);
        $msg = "<h1> Przewalutowano poprawnie </h1>";
    }
}



echo $msg;

//$send = new InsertCommand($conn, 'transactions');
//$send->execute("'$old_curr','$new_curr','$ammount','$przewalutowanie'");

$conn->close();

?>
<a href="/"><button>Wróć do strony głównej</button></a>