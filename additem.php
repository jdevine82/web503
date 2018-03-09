<?php
session_start();

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item = test_input($_POST["item_name"]);
  $index = (int)test_input($_POST["item_index"]);
  $item_amount = test_input($_POST["item_qty"]);
  if (is_null($index)) {} else{ $_SESSION['cart'] [$index] = array('name' => $item, 'quantity' => $item_amount);
  //Assign the current timestamp as the user's

  
Redirect('/shoppinglist.php', false);
    
    }
    
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>




