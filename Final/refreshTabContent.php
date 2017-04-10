<?php

require_once 'Offers.php';
$offers = new Offers();


if(isset($_GET['whichTab']) && !empty($_GET['whichTab'])) {
    $action = $_GET['whichTab'];
    switch($action) {
        case 'photowall' : 
            echo($offers->retrieveA());
            break;
        case 'like' : 
            echo($offers->retrieveB());
            break;
        
    }
}

?>
