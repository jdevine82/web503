<?php
session_start();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["client_name"]);
  $_SESSION['client']=$name;
}

Redirect('/shoppinglist.php', false);
?>