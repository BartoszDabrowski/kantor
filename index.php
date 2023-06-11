<!doctype html>
<?php
    include 'class.php';
    include 'conn.php';
    
    //$currencies = GetCurrencies::get();
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_db);
    //$result = $conn->query("SELECT DISTINCT date FROM currencies ORDER BY date DESC LIMIT 1")->fetch_all();
    
    $select_query = new SelectCommand($conn,'currencies');
    $query_currencies = $select_query->execute('date = CURDATE()');

    if(isset($currencies)) {
        $currencies = [];
        foreach ($query_currencies as $record) array_push($currencies, Currency::from_database($record));
    }else{
        $currencies = GetCurrencies::get(); 
        $insert = new InsertCommand($conn, 'currencies');
        $new_currencies =[];
        foreach ($currencies as $curr) array_push($new_currencies, $curr->to_database());
            
        $insert->execute($new_currencies);    

    }
    
    $conn->close();

?>

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


