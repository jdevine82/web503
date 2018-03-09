 <?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();
Redirect('/shoppinglist.php', false);


function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
?>
 