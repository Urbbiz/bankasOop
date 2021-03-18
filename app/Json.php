<?php

class Json
{

    private static $jsonObj;
    private $data;


    public static function getDB()    //funkcija kuri mums grazins sukurta json objekta
    {
        return self::$jsonObj ?? self::$jsonObj = new self;  //jeigu nera suurto objeti, tai ji sukuriam
    }

    private function __construct()
    {
        if (!file_exists(DIR . 'data/accounts.json')) {    // pirma karta sukuriam json faila, jeigu jo dar nera
            $data = json_encode([]); //uzkoduojam sita faila i json kaip masyva, ojame yra objektai
            file_put_contents(DIR . 'data/accounts.json', $data); //irasom i json faila.
        }
        $data = file_get_contents(DIR . 'data/accounts.json'); // jeigu jau egzistuoja, pasiimu faila
        $this->data = json_decode($data); //iraso objekta this data i json faila.
    }


    public function __destruct()     //pasileidzia tada, kai objektas buna istrintas is atminties   
    {
        file_put_contents(DIR . 'data/accounts.json', json_encode($this->data));  //tiesiog irasom i sita faila ir nieko negrazinam  
    }

    public function readData(): array  // sita funkcija nuskaito json failus, ir privalomai turi grazinti masyva (:array)
    {
        return $this->data; //grazinu iskoduoda json faila
    }

    public function writeData(array $data): void //void del to, kad funkcija nieko nereturnins, bet reikalausim, kad argumentas butu arejus(array $data)
    {
        $this->data = json_encode($data);
    }


    public function getAccount( $id): ?object //paduodu saskaitos $id, o funkcija man grazina OBJEKTA su saskaitos informacija.
    {
        foreach ($this->data as $user) {
            if ($user->id == $id) { // jeigu $user[id] sutama su mano iieskoma $id
                return $user;   // tada ir grazinu to sutampancio id user masyva
            }
        }
        return null;  //jeigu tokios saskaitos neranda, tuomet grazina null.
    }

    public function store(User $user): void // paima User objekta CREATE funkcija.
    {
        $id = $this->getNextId();
        
         $user->id = $id; //pridedu i sita objekta ID
        $this->data[] = $user;   // i masyva irasom saskaita kaip objekta
    }

    public function updateAdd(object $updateUser): void // nieko negrazina, bet paima kieki ir prideda pinigus
    {
        foreach ($this->data as $key => $user) {     // jeigu yra $user, tada  foreachinam per user
            if ($user->id == $updateUser) {         // jeigu $user[id] sutama su mano ieskoma $id
                // $user = ['id' => $id, 'name' => $name, 'surname' => $surname, 'acc' => $acc, 'personalId' => $personalId, 'balance' => $balance];    // ji surades pakeiciu.
                $this->data[$key] = $updateUser;
                return;
            }
        }
    }


    public function delete(int $id): void //nurodom kokia saskaita deletinam, buvusi deleteAccount funkcija
    {

       

        foreach ($this->data as $key => $user) {
            if ($user->id == $id & $user->balance == 0 ) { // jeigu $user[id] sutama su mano iieskoma $id
                unset($this->data[$key]);   // tada ir istrinu to sutampancio id user masyva
                // normalizuojam masyva iki normalaus masyvo be "skyliu"
                $this->data = array_values($this->data);
                //
                /*
                pvz indeksai pries trynima 0 1 2 3 4
                trinam 2 elementa
                indeksai po trynimo 0 1 3 4
                indeksai po normalizavimo 0 1 2 3
                */
                return;
            } else
            $_SESSION['message'] = 'Operacija nutraukta! Ištrinti galima tik tuščią sąskaitą!';
            header('Location: '.URL.'');
               die;
        }
    }

    private function getNextId(): int  //privalomai turi grazinti skaiciu (:int)
    {
        if (!file_exists(DIR . 'data/indexes.json')) {    // pirma karta sukuriam json faila, jeigu jo dar nera
            $index = json_encode(['id' => 1]); //uzkoduojam sita faila i json su pirmu indexu.,
            file_put_contents(DIR . 'data/indexes.json', $index); //irasom i json faila.
        }
        $index = file_get_contents(DIR . 'data/indexes.json');
        $index = json_decode($index, 1);
        $id = (int) $index['id'];  // paverciam ji i (int), kad gautume skaiciu.
        $index['id'] = $id + 1; // sukuriam nauja masyva ir pridedam jam +1
        $index = json_encode($index);
        file_put_contents(DIR . 'data/indexes.json', $index);
        return $id;
    }

    public static function accountNumber()   // Saskaiton Nr. generatorius
    {
        $checkedNum = '01';
        $bankCode = '88000';
        $randNumb = '';
        for ($i = 0; $i <= 10; $i++) {
            $rand = (string) rand(0, 9);
            $randNumb .= $rand;
        }
        $accNumber = 'LT' . $checkedNum . $bankCode . $randNumb;
        $accNumber = (string) $accNumber;
        return $accNumber;
    }
}
