#!/usr/local/bin/php
<?php
session_save_path(__DIR__ . '/sessions/');
session_name('myWebpage');
session_start();
//start session

$badSubmish = false;

 // If a password has been submitted,
  // we should check it and update
  // $incorr_submiss and $_SESSION['loggedin']
  // accordingly.
  if (isset($_POST['password'])) {
    validate($_POST['password'], $badSubmish);
  }


  function validate($submiss, &$badSubmish) {
    // Using die is not good coding practice, but
    // I don't wish to clutter up our current code
    // by handling this situation more gracefully.
    $file = fopen('h_password.txt', 'r');

    // We obtain the hashed password
    // (removing any surrounding whitespace).
    $hashed_password = fgets($file);
    $hashed_password = trim($hashed_password);
    fclose($file);

    // We hash the submission using the same algorithm
    // as when we hashed the actual password.
    $hashed_submiss = hash('md2', $submiss);

    if ($hashed_submiss !== $hashed_password) {
      $_SESSION['loggedin'] = false;
      $badSubmish = true;
    }
    else {
      $_SESSION['loggedin'] = true;
      header('Location: index.php');
      exit;
    }
  }
?>
<!DOCTYPE html> 
<html lang = "en">
<head>
  <meta charset = "UTF-8">
  <link rel="stylesheet" href="styles.css?v=<?php echo rand() ?>">
  <script src="username.js?v=1" defer></script>
  <script src="login.js?v=1" defer></script>
  <title>Login</title>
</head>

<header><h1>
Welcome! Ready to check out my webpage?
</h1>
</header>
  <body>
    <h2>
      Enter a username.
    </h2>
      <p>
        So that you can make your own posts and purchases, select a username and password.
      </p>
      <section id = "mainS">
   <fieldset>  
   <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="name">Username:</label>
     <input type="text" id="name" name="name">
      <br>
      <label for="password">Password:</label>
     <input type="password" id="password" name="password">
     <button id = "submit" type="submit">Submit</button>
  </form>
</fieldset>
  <?php
          if ($badSubmish) {
            echo '<p>Invalid password!</p>';
          }
        ?>
    </section>
    <footer>
       <p>&copy; H.DOG INC</p>
    </footer>
  </body>

</html>