<?php

class MessageController
{
    function showMessageVerify($type, $message)
    {
        if (isset($_GET[$type]) && $_GET[$type] == 'correcto') {
            // Si se cumple la condición, muestra un div con la clase 'mensaje_correcto' y muestra el mensaje especificado en message
            echo "<div class='alert alert-success w-75 mx-auto text-center'role='alert'>$message</div>";
        }
    }

    function show_messages_error($type, $message)
    {
        if (isset($_GET[$type]) && $_GET[$type] == 'error') {
            // Si se cumple la condición, muestra un div con la clase 'mensaje_error' y muestra el mensaje especificado en message
            echo "<div class='alert alert-danger w-75 mx-auto text-center'role='alert'>$message</div>";
        }
    }
}
