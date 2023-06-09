<?php

include 'class.php';
include 'conn.php';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_db);

$new_curr = $_POST['curr_to'];
$old_curr = $_POST['curr_from'];
$ammount = $_POST['ammount'];



$select = new SelectCommand($conn, 'currencies');
$result = $select->execute("currency = '$old_curr' OR currency = '$new_curr'");

$from_object = new Currency($result[0][0],$result[0][1],$result[0][2],$result[0][3]);
$to_object = new Currency($result[1][0],$result[1][1],$result[1][2],$result[1][3]);

if($from_object->GetCurr() == $new_curr) $transaction = new Transaction($from_object,$to_object,$ammount);
else $transaction = new Transaction($to_object,$from_object,$ammount);

$x = $transaction->calc();
$transaction->save($conn);

echo "<h1> Przewalutowano poprawnie </h1>";

//$send = new InsertCommand($conn, 'transactions');
//$send->execute("'$old_curr','$new_curr','$ammount','$przewalutowanie'");

$conn->close();

?>
<a href="/"><button>Wróć do strony głównej</button></a>