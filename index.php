<!doctype html>
<?php
    include 'class.php';
    include 'conn.php';
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_db); //nawiązanie połączenia

    //sprawdzenie czy w bazie są wpisy dodane dzisiaj    
    $select_query = new SelectCommand($conn,'currencies');
    $query_currencies = $select_query->execute('date = CURDATE()');

    //jeśli brakuje takich wpisów, następuje pobór danych z API i dodanie do bazy; jeśli takie wpisy są, następuje pobranie danych z bazy
    if(!empty($query_currencies)) {
        $currencies = [];
        foreach ($query_currencies as $record) array_push($currencies, Currency::from_database($record));
    }else{
        $currencies = GetCurrencies::get(); 
        $insert = new InsertCommand($conn, 'currencies');
        $new_currencies =[];
        foreach ($currencies as $curr) array_push($new_currencies, $curr->to_database());
            
        $insert->execute($new_currencies);    

    }
    //zakończenie połączenia
    $conn->close();

?>
<!-- formularz służący przewalutowaniu -->
<form action="change.php" method="post">
    Kwota
    <input type="number" name="ammount" id="ammount" step="0.01"><br>
    Z waluty 
    <select id="curr_from" name="curr_from">
        <?php foreach ($currencies as $item) { ?>
           <option value="<?php echo $item->GetCurr(); ?>"><?php echo $item->GetCurr(); ?></option>
        <?php } ?>
    </select><br>
    Na walutę
    <select id="curr_to" name="curr_to">
        <?php foreach ($currencies as $item) { ?>
           <option value="<?php echo $item->GetCurr(); ?>"><?php echo $item->GetCurr(); ?></option>
        <?php } ?>
    </select>
    <br>
    <button type="submit">Przewalutowanie</button>
</form>

<a href="history.php"><button>Historia Transakcji</button></a>

<hr>
<h2>Obecne kursy</h2>
<style>
table, th, tr{
    border:1px solid black; border-collapse:collapse;
}
</style>
<!-- wyświetlenie dzisiejszych kursów -->
<table>
    <tr>
        <th>Waluta</th>
        <th>Kod</th>
        <th>Sprzedaż</th>
        <th>Kupno</th>
    </tr>
    <?php foreach($currencies as $curr){ ?>
        <tr>
            <th><?php echo $curr->GetCurr()?></th>
            <th><?php echo $curr->GetCode()?></th>
            <th><?php echo $curr->GetBid()?></th>
            <th><?php echo $curr->GetAsk()?></th>
        </tr>
     <?php } ?>

</table>


