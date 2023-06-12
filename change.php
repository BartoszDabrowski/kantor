<?php

include 'class.php';
include 'conn.php';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_db); //nawiązanie połączenia
$conn->set_charset("utf8mb4");
$new_curr = $_POST['curr_to'];
$old_curr = $_POST['curr_from'];
$ammount = floatval($_POST['ammount']); //wymuszenie typu zmiennoprzecinkowego; jeśli użytkownik podał tu coś innego niż liczbę zmienna przybierze wartość 0
$msg = '';

if($new_curr == $old_curr) $msg = "<h1>wybierz różne waluty </h1>"; //weryfikacja czy waluty są różne
else{
    if($ammount <= 0) $msg = "<h1>Podana wartość nie jest liczbą lub jest mniejsza bądź równa 0</h1>"; //upewnienie się czy użytkownik podał liczbę dodatnią, różną od 0; przewalutowanie ujemnych wartości bądź 0 nie ma sensu
    else {
        $select = new SelectCommand($conn, 'currencies');
        $result = $select->execute("currency = '$old_curr' OR currency = '$new_curr' ORDER BY date DESC LIMIT 2");
        //zapytanie zwraca tylko waluty wybrane przez użytkownika
    
        //nazwa pochodzi od obiektów
        $curr_object_1 = Currency::from_database($result[0]);
        $curr_object_2 = Currency::from_database($result[1]);

        //sprawdzenie który obiekt jest walutą źródłową; bez tego waluta posiadająca niższy id zawsze byłaby źródłowa
        if($curr_object_1->GetCurr() == $old_curr) $transaction = new Transaction($curr_object_1,$curr_object_2,$ammount);
        else $transaction = new Transaction($curr_object_2,$curr_object_1,$ammount);

        $bufor = $transaction->calc(); //wykonanie obliczeń
        $transaction->save($conn); //wysłanie danych do bazy
        $msg = "<h1> Przewalutowano poprawnie </h1>";
    }
}



echo $msg;

$conn->close();

?>
<a href="/rekrutacja"><button>Wróć do strony głównej</button></a>