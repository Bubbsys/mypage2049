#!/usr/local/bin/php
<?php
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
?>

<!DOCTYPE html>
<html lang="en-US">

  <head>
  	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles.css?v=<?php echo rand() ?>">
  	<title>Trad Is Rad</title>
  </head>

  <body>
	<p id = "shop">
		One stop shop
	</p>
    
      <header>
	  <h1 id ="Rules">The Rules of Rock Climbing</h1>
	  <div id = "greet">
	  <span id = "greeting">
	  <?php
		echo "<p>Hello, {$_COOKIE['username']}!</p>";
		?>
		</span>
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
	  <main>
  	  		<section>
  	  			<h2 id="quotes">From the Greats</h2>
  	    		<p>
  		  “There are only three sports: bullfighting, motor racing, and mountaineering; all the rest are merely games” -Ernest Hemingway
  	 			 </p>
  	  <h3>What it takes to succeed</h3>
  	  <ol>
  	  	<li>Strength</li>
  	  	<li>Vibes</li>
  	  	<li>Friends</li>
  	  </ol>
  	  <img src="https://senderoneclimbing.com/wp-content/uploads/2018/03/rachelatc-mp.jpg" alt="Climbing!" id = "creek">

  	</section>
	<section>
		<h3>Some recent posts by other users:</h3>
		<p>malicious666: Hey I cut my <a href="scarf1.html" target = "_blank" rel = "opener">scarf</a> in half, here is the other <a href="scarf2.html" target = "_blank" rel = "opener">part!</a></p>
	</section>
  </main>
  <footer>
 	 <p>&copy; H.DOG INC</p>
  </footer>
  </body>
 </html> 
