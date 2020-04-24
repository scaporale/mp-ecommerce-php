<?php

    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    header("Location: ".$_POST['back_url']); /* Redirección del navegador */

    /* Asegurándonos de que el código interior no será ejecutado cuando se realiza la redirección. */
    exit;