<?php

require_once 'Offers.php';
$offers = new Offers();


if(isset($_POST['whichTab']) && !empty($_POST['whichTab'])) {
    $action = $_POST['whichTab'];
    switch($action) {
        case 'tab1' : 
            echo($offers->retrieveA());
            break;
        case 'tab2' : 
            echo($offers->retrieveB());
            break;
        case 'tab3' : 
            echo($offers->retrieveC());
            break;
    }
}

?>
