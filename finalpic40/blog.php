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
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="styles.css?v=<?php echo rand() ?>">
        <title>Our Posts</title>
    </head>
    <body>
        <header>
            <h1 id = "posth1">Our Posts</h1>
            <div id="greet">
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
        </header>

        <main>
            <form method = "POST" action = "post.php">
                <label for = "textbox">Author: </label>
                <input id = "textbox" type = "text" name = "author" value = <?php echo $_COOKIE['username']?>>
                <br>
                <label for = "textbox">Content: </label>
                <textarea id = "textarea" name = "post" value = "post"></textarea><input type="submit" value = "Post">
            </form> 
            <section id = 'userposts'>
                <h2>Post by other users:</h2>
                <?php
                if(file_exists("posts.txt")){
                    readfile("posts.txt");
                }
                ?>
            </section>
        </main>
        <footer>
  	        <small>
  		        &copy;H.DOG INC
  	         </small>
        </footer>
    </body>
</html>