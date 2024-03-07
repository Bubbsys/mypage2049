//username.js
function get_username() {
    let cookie = document.cookie;
    let pair = cookie.split("; "); //begins spliting each name value pair
    let username = '';
    let found = false; // if username is found, username value will be printed. If no username found, "" will be printed.
    for (let i = 0; i < pair.length; i++) { //loop through string
        let equals = pair[i].indexOf("=");
        let name = pair[i].substring(0, equals);
        let value = pair[i].substring(equals + 1); //split name value at last equal sign, solves problem of having an equal sign as a username
        if (name === 'username') {
            found = true;
            username = value;
            break;
        }
    }
    //if (!found) {
        // if we are not on login page, go to login
       // if (!window.location.href.includes("login.php")) {
      //      window.location.href = 'login.php';
      //  }
      //  username = "";
       //console.log("");
       
   // }
    console.log(username);
    return username;
  
}