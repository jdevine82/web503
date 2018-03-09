
<?php
// set time started in the session parameter
$lifetime = (int)time()+3600;
session_set_cookie_params (  $lifetime);
session_start();
//Expire the session if user is inactive for 30
//minutes or more.
$expireAfter = 60*24*7;
 
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
 


?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Session Managment</title>
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css">
    <link rel="stylesheet" href='/custom.scss'/>
    <!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.js"></script>
</head>
<body>
<div class="grid-x  align-center">
  <div class="cell large-3 large-offset-4 ">

<?php 
if ($_SESSION['client']!=null) 
    {Redirect('/shoppinglist.php', false);}
else {
 echo '<form method="post" action="/addname.php" class="log-in-form"> 
<Label class="label">Log in with your name<input type="text" name="client_name"> </label>
<button type="submit" class="button">Login</button>
</form>';
}?>
 </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/css/app.css"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>