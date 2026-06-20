<?php 
//Initialise the session
session_start();
if (isset($_SESSION['username']))
    {
        //Destroy the whole session
        $_SESSION = array();
        session_destroy();
        echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.html\">";
    }
?>