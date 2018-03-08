
<?php
// set
$expiry = time()+3600;
 session_name("mysession");
session_start( "mysessionvalue|$expiry", $expiry);
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Session Managment</title>
<!-- Compressed CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css" integrity="sha256-itWEYdFWzZPBG78bJOOiQIn06QCgN/F0wMDcC4nOhxY=" crossorigin="anonymous" />

<!-- Compressed JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js" integrity="sha256-Nd2xznOkrE9HkrAMi4xWy/hXkQraXioBg9iYsBrcFrs=" crossorigin="anonymous"></script>
</head>
<body>
<?php 
if ($shoppinglist===null)  $shoppinglist= array(); //initialise the array

$b=&$_SESSION['cart'];
$a=0;

 if ($b!=null) {foreach ($b as $item) {
 $shoppinglist[$a]['item_name'] = $item['name'];
 $shoppinglist[$a]['item_qty']= $item['quantity'];
  $a++;
 }}
 $new_item_number=count($shoppinglist);
 ?>


<?php 
// get
if (isset($_SESSION["mysession"])) {
   echo list($value, $expiry) = explode("|", $_SESSION["mysession"]);
}

if ($_SESSION['client']!=null) {echo 'Hi '.$_SESSION['client']; }
else {
 echo '<form method="post" action="/addname.php"> 
Plase Enter Your Name: <input type="text" name="client_name"> 
<button type="submit">Add Name</button>
</form>';}?>



<form method="post" action="/additem.php">  
Item: <input type="text" name="item_name"> 
 Qty: <input type="number" name="item_qty">
 <input  type="hidden" name="item_index" value=<?php echo $new_item_number ?> >
 
  <input type="submit" name="submit" value="Add Item">  
   <button type="submit" formaction="/destroy.php">destroy session</button>
</form>



 
 <?php
 echo "<h2> Shopping List </h2>";
if (shoppinglist!=null) { foreach ($shoppinglist as $x => $x_value) {
   echo '<form method="post" action="remove.php">';
    echo  "Item=".$x_value['item_name']." x ".$x_value['item_qty'];
    echo '<input  type="hidden" name="item_index" value='.$x.' >';
    echo '<button type="submit">Remove</button></form>';
    echo "<br>";
}}
 



?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.min.js"></script>
   <script>
    $(document).foundation();
  </script>

</body>
</html>