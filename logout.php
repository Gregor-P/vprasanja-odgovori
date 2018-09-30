<?php
    session_start();
    
    include_once 'gpConfig.php';

    if($_SESSION['google'] == 'google'){
        //Unset token and user data from session
        
        unset($_SESSION['token']);
        unset($_SESSION['userData']);
        //Reset OAuth access token
        
        $gClient->revokeToken();
    }
    
    session_destroy();
    
    header("Location: login.php");
    
?>