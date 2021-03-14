<?php
require __DIR__.'/bootstrap.php';








$uri = explode('/',str_replace(INSTALL_DIR,'',$_SERVER['REQUEST_URI']));  // kelias, arba direktorija i papildomus puslapius.



// ROUTING

if ('' == $uri[0])      // anksciau buvo table, bet pakeiciau i index.
{
    // $pageTitle = 'Sąskaitos';
    (new BankController)->index();    // pasidarau nauja objekta ir iskvieciu index.
}

elseif ('create' == $uri[0])      // anksciau buvo newAcc, bet pakeiciau i index.
{
    // $pageTitle = 'Sukurti naują sąskaitą';
    (new BankController)->create();    // pasidarau nauja objekta ir iskvieciu index.
}

elseif ('store' == $uri[0])      //
{
    (new BankController)->store();    //  issaugome nauja sasaita i musu aplikacija
}
elseif ('incoming' == $uri[0])      //   jo pavadinta yra edit
{
    (new BankController)->edit((int)$uri[1]);    // 
}
elseif ('cashOut' == $uri[0])      //  
{
    (new BankController)->minusMoney((int)$uri[1]);    // 
}
elseif ('update' == $uri[0])      //
{
    (new BankController)->update((int)$uri[1]);    // 
}
elseif ('updateNegative' == $uri[0])      //
{
    (new BankController)->updateNegative((int)$uri[1]);    // 
}

elseif ('delete' == $uri[0])      //
{
    
    (new BankController)->delete((int)$uri[1]);    //  
}


echo 'durys';
?>
