<?php

    session_start();

    session_destroy();

    header("Location: http://localhost/hotel/index.php");
    exit();


?>