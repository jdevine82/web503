
<?php

session_start();
//Expire the session if user is inactive for 1 week
$expireAfter = 60*24*7;
 
//Check to see if our "last action" session
//variable has been set.
if(isset($_SESSION['last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = $expireAfter * 60;
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        session_unset();
        session_destroy();
    }
    
}

//this is used to override the http header to reset the locatio of the url. this will redirect the user to the
//login page after timeout.
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
  <link rel="stylesheet" href='/custom.scss'/>
  <!-- Compressed JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
</head>
<body>
<div class="grid-x">
 <div class="cell large-offset-4 large-4 medium-6 medium-offset-3 small-12 ">
 <?php 
  
 if ($shoppinglist===null)  $shoppinglist= array(); //initialise the array
  $b=&$_SESSION['cart'];  //create a pointer at the session arra to manipulate
  $a=0; //initilise the index for the new shopping list array
  if ($b!=null) {foreach ($b as $item) { //build the shopping list array from the session array
     $shoppinglist[$a]['item_name'] = $item['name']; 
     $shoppinglist[$a]['item_qty']= $item['quantity'];
     $a++;
   }}
 $new_item_number=count($shoppinglist);
 
  //work out whole number of days,hours,minutes and seconds the session has been open for.
  $days=floor($secondsInactive/(60*60*24));
  $hours=floor(($secondsInactive-($days*60*60*24))/(60*60)); 
  $mins=floor(($secondsInactive-($hours*60*60+$days*60*60*24))/(60));
  $secs=$secondsInactive-$mins*60-$hours*60*60-$days*60*60*24;


  if ($_SESSION['client']!=null) {echo 'Hi '.$_SESSION['client']; //grab the login name from the session variable.
    echo '<br>You have been logged in for:'.$days.' days '.$hours.' hours '.$mins.' minutes '.$secs.' seconds ';
    echo '<br> <a href="destroy.php" class="button">Logout</a>';}
  else {
    Redirect('/index.php', false);
  } //if session has expired we need to redirect to main login.
   ?>
 <fieldset class="fieldset">
  <legend>Add Items to your cart</legend>
  <form method="post" action="/additem.php"> 
  <label>Item: 
  <input type="text" name="item_name"> 
  </label>
  <input  type="hidden" name="item_index" value=<?php echo $new_item_number ?> >
  <label>Qty
   <div class="grid-x grid-margin-x">
   <div class="cell small-5 large-4">
    <input type="number" min=1 value=1 name="item_qty">
   </label>
   </div>
   <div class="cell small-5 large-4">
    <input type="submit" name="submit" value="Add Item" class="button "> </input>
   </div>
  </div>
 </form>
</fieldset>
<h2 > Cart: </h2>
 <?php 
  if (shoppinglist!=null) 
  { 
    foreach ($shoppinglist as $x => $x_value) 
      {
       echo '<div class="grid-x"> <div class="cell small-2 large-3"> <form method="post" action="remove.php">';
       echo  $x_value['item_name'].'</div><div class="cell small-1 large-1"> x </div> <div class="cell small-1 large-2">';
       echo $x_value['item_qty'];
       echo '</div><div class="cell small-2 large-3"><input  type="hidden" name="item_index" value='.$x.' >';
       echo '<button class="button" type="submit">Remove</button></form> </div></div>';
       }
   }
 ?>
 </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation-essential/6.2.2/css/app.css"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>