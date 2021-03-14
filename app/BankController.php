<?php


class BankController
{

 public function index()     // anksciau buvo table, bet pakeiciau i index
 {
     $saskaiteles =  Json::getDB()->readData();  // readina data ir ja ideda i $saskaiteles, kuria naudojam foreach table puslapi
     require DIR.'views/index.php';
 }

 public function create()     // buves newAcc, grazins mums create views
 {
     require DIR.'views/create.php';
 }

 public function store()     //  redirektina nes cia bus POST metodas
 {

    
    if(!empty($_POST)){
        if(($_POST['name'] === '') || ($_POST['surname'] === '') /*|| ($_POST['acc'] === '')*/ || ($_POST['personalId'] === '')){
            $_SESSION['message'] = 'Įveskite visus duomenis!';
             header ('Location: ' . URL .'create');
            die;
        }

    $user = new User;
    $user->name = ($_POST['name'] ?? 0);
    $user->surname = ($_POST['surname'] ?? 0);
    $user->acc = ($_POST['acc'] ?? 0);
    $user->personalId = ($_POST['personalId'] ?? 0);
    $user->balance = ($_POST['balance'] ?? 0);
        // $saskaita = (int) $saskaita;
        Json::getDB()->store($user);  //sukurimas
        
        
        $_SESSION['message'] = 'Sąskaita pridėta!';
        header ('Location: ' . URL .'create'); // pasiliekam create puslapyje
        die;
    }

     
 }

    public function edit(int $id)     // i edit funkcija perduodam $id
    {
        $user = Json::getDB()->getAccount($id);
      require DIR.'views/incoming.php';   
    }

    public function minusMoney(int $id)     // i minusMoney funkcija perduodam $id
    {
        $user = Json::getDB()->getAccount($id);
      require DIR.'views/cashOut.php';   
    }

    public function update(int $id)     // PRIDETI  redirektina nes cia bus POST metodas
 {
    if(!empty($_POST)){
        if(($_POST['balance'] === '') || ($_POST['balance'] === '0') || ($_POST['balance'] === '-')){
            $_SESSION['message'] = 'Operacija neįvyko, nes įvedėte neteisingą sumą, bandykite dar kartą!';
             header ('Location: ' . URL .'');
            die;
        }
    $user = Json::getDB()->getAccount($id);   // gaunam id datos duomenis
    
    $user->balance += ($_POST['balance'] ?? 0);
        Json::getDB()->updateAdd($user);  //updeitina
        $_SESSION['message'] = 'Sąskaita pridėta!';
        header ('Location: ' . URL .''); // pasiliekam create puslapyje
        die;
    }
 }

 public function updateNegative(int $id)     //  ATIMTI   redirektina nes cia bus POST metodas
 {

    $user = Json::getDB()->getAccount($id);   // gaunam id datos duomenis

    if(!empty($_POST)){
        if(($_POST['balance'] === '') || ($_POST['balance'] === '0')||($_POST['balance'] > $user->balance)){
            $_SESSION['message'] = 'Operacija neįvyko, nes įvedėte neteisingą sumą, bandykite dar kartą!';
             header ('Location: ' . URL .'');
            die;
        }
    // $user = Json::getDB()->getAccount($id);   // gaunam id datos duomenis
    
    $user->balance -= ($_POST['balance'] ?? 0);
        Json::getDB()->updateAdd($user);  //updeitina
        $_SESSION['message'] = 'Sąskaita minusuota!';
        header ('Location: ' . URL .''); // pasiliekam create puslapyje
        die;
    }
 }

    public function delete(int $id)     // i edit funkcija perduodam $id
    {
        Json::getDB()->delete($id);
        $_SESSION['message'] = 'Sąskaita ištrinta!';
        header ('Location: ' . URL .'');
        die;  
    }

    


}