

<?php 
    session_start ();

    if (! isset($_SESSION ['language']) ){
        $_SESSION ['language'] = 'en';
    }
    
    if ( isset($_GET ['language']) ){
        if ( $_GET ['language'] == 'nl') {
            $_SESSION ['language'] = 'nl';
        } else {
            $_SESSION ['language'] = 'en';
        }
    }
    $chosenLanguage = $_SESSION ['language'];
    
    if ( $chosenLanguage == 'nl') {
        require_once 'PHP/Webshop/nlbasket.php';
    } else {
        require_once 'PHP/Webshop/enbasket.php'; 
    }



    
    

