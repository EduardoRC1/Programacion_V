<?php
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    if($username == 'Admin' && $password == 'Admin'){
        echo "Welcome $username";
    }

?>