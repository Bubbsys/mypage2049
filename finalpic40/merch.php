#!/usr/local/bin/php
<?php
//merch.php
session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();

if(!isset($_COOKIE['username'])){
	header("Location: login.php");
}

$welcome = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
if(!$welcome){
	header("Location: login.php");
}
    //create database and check if their is a table
    $db = new SQLite3('credit.db');
    $tableExists = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='usersCred'")->fetchArray();
    
    //create table
    if(!$tableExists){
    $statement = 'CREATE TABLE IF NOT EXISTS usersCred(username TEXT, credit REAL)';
    $db->exec($statement);
  }
  //check if user is in database
  $username = $_COOKIE['username'];

  $result = $db->query("SELECT credit FROM usersCred WHERE username='$username'");
  $row = $result->fetchArray(SQLITE3_ASSOC);


  $userExists = $db->query("SELECT username FROM usersCred WHERE username='$username'")->fetchArray();
  
  //add user to database 
  if (!$userExists) {
    $credit = 20;
    $statement = "INSERT INTO usersCred (username, credit) VALUES ('$username', $credit)";
    $db->exec($statement);
}

$db->close();
?>
<!DOCTYPE html>
<html lang = "en">
  <head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css?v=<?php echo rand() ?>">
  <script src="merch.js?=<?php echo rand() ?>" defer></script>
    <title>Our Merchandise</title>
  </head>

  <body>
    <header id = "merchead">
      <h1 id = "merchh1">Our Merchandise</h1>
      <div id = "greet">
		<nav>
  			<ul>
   				 <li><a href="https://www.pic.ucla.edu/~hwbubb/Final/index.php">Home</a></li>
					<li><a href="https://www.pic.ucla.edu/~hwbubb/Final/login.php">Login</a></li>
  				  <li><a href="https://www.pic.ucla.edu/~hwbubb/Final/merch.php">Our Products</a></li>
  				  <li><a href="https://www.pic.ucla.edu/~hwbubb/Final/blog.php">Our Posts</a></li>
 			 </ul>
		</nav>
	</div>
    </header>
    <section id="mainSection">
      <header>
        <h2>Available Items</h2>
      </header>
      <p>Please have a look around. Our new members are awarded with $20,00 in credit.
        You can add credit at anytime with a coupon code. When you want to make
        a purchase, please select the checkboxes of the items you wish to purchase and
        click the "Checkout" button below.
      </p>
      <p id = 'creditElement'><?echo "Available credit: $" . $row['credit'];?></p>
      <table>
        <tbody>
          <tr>
            <td>
              <img src="prod1.jpg" alt="Product 1" id = "prod">
              <h3>Girl staring intently</h3>
              <input type="checkbox" name="product">
               <span class="product-price"></span>
              <p>Get cha stoked.</p>
            </td>
            <td>
              <img src="prod2.jpg" alt="Product 2" id = "prod">
              <h3>Pushing friend off cliff</h3>
              <input type="checkbox" name="product">
               <span class="product-price"></span>
              <p>Friends in high places.</p>
            </td>
          </tr>
          <tr>
            <td>
              <img src="prod3.jpg" alt="Product 3" id = "prod">
              <h3>Lonely dude</h3>
              <input type="checkbox" name="product">
              <span class="product-price"></span>
              <p>That sweet office decor.</p>
            </td>
            <td>
              <img src="prod4.jpg" alt="Product 4" id = "prod">
              <h3>SOLO</h3>
              <input type="checkbox" name="product">
             <span class="product-price"></span>
              <p>Courage.</p>
            </td>
          </tr>
        </tbody>
      </table>
      <fieldset>
        <label for="coupon">Coupon code:</label>
        <input type="text" id="coupon" name="coupon">
        <br>
        <button id = 'checkout' type="submit">Checkout</button>
       <p id = 'checkoutPara'></p>
      </fieldset>
    </section>
    <footer>
      <p>&copy; H.Dog INC</p>
    </footer>
  </body>

</html>

