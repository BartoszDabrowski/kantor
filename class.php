<?php


class Currency {
    private $curr;
    private $code;
    private $bid;
    private $ask;


    function __construct($curr, $code, $bid, $ask)
    {
        $this->curr = $curr;
        $this->code = $code;
        $this->bid = $bid;
        $this->ask = $ask;
    }

    function to_database()
    {
        return "'$this->curr','$this->code','$this->bid','$this->ask'";
    }

    static function from_database($array)
    {
        return new Currency ($array[0], $array[1], $array[2], $array[3]);
    }

}

class GetCurrencies{
   private static $url = 'https://api.nbp.pl/api/exchangerates/tables/C?format=json';
   static function get()
   {
    $response = file_get_contents(GetCurrencies::$url);
    $data = json_decode($response, true);
    if (empty($data)) return array();
    $currencies_to_return = [];

    $currencies = $data[0]['rates'];
    foreach ($currencies as $currency) {
        
        $actual_curr = new Currency($currency['currency'], $currency['code'], $currency['bid'], $currency['ask']);
        array_push($currencies_to_return,$actual_curr);
    } 
    return $currencies_to_return;
   }
}

abstract class DatabaseCommand{
    protected $connection;
    protected $table;
    function __construct($connection, $table){
        $this->connection = $connection;
        $this->table = $table;
    }

    abstract function execute($data);
}

class InsertCommand extends DatabaseCommand{
    function execute($data){
        //do rozbudowania żeby przyjął tablice
        if(is_array($data))
        {
            $command = "INSERT INTO ".$this->table." VALUES";
            foreach($data as $query) $command .= " (".$query."),";

            $command = substr($command,0,-1);
        }
        else $command = "INSERT INTO ".$this->table." VALUES (".$data.")";
        //$this->connection -> query($command);
        echo $command;
    }
}

class SelectCommand extends DatabaseCommand{
    function execute($data){
        //data akceptuje klauzule where
        $command = "SELECT * FROM ".$this->table;
        //$aaa = ;
        return $this->connection -> query($command)-> fetch_all();
    }
}
?>