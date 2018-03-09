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
  $item = (int)test_input($_POST["item_index"]);
  $key= array_key_exists($item,$_SESSION['cart']);
    if(array_key_exists($item,$_SESSION['cart'])!==false)
    unset($_SESSION['cart'][$item]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

Redirect('/shoppinglist.php', false);
?>

