//login.js HW5

let submitButton = document.getElementById("submit");
if (submitButton) {
  submitButton.addEventListener("click", function() {
    let nameInput = document.getElementById("name");
    let username = nameInput.value;
   // validates username
    let validated = validate_username(username);
    console.log(validated);
  });
}

let keyListen = document.getElementById("name")
if(keyListen){
  keyListen.value = get_username()
  keyListen.addEventListener("keyup", function(e){
    let username = keyListen.value;
    let enter = 13;
    
    if(e.keyCode === enter){
      let validated = validate_username(username);
      console.log(validated);
  };
  });
  }

function validate_username(username) {
  let length = username.length;
  let badChar = "=,;& ";
  let goodChar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*()-_+[]{}:'|`~<.>/?";
  let error1 = "Username must be 5 characters or longer.\nUsername cannot contain spaces.\nUsername cannot contain commas.\nUsername cannot contain =.";
  let error2 = "Username can only use characters from the following string:+\nabcdefghijklmnopqrstuvwxyz\nABCDEFGHIJKLMNOPQRSTUVWXYZ\n0123456789\n!@#$%^*()-_+[]{}:'|`~<.>/?";
  if (/^[a-zA-Z0-9!@#$%^*()_+{}:'|`~<.>?\[\]\/\-]{5,40}$/.test (username)){
    
    
    //create cookie
    let nameInput = document.getElementById("name");
    let username = nameInput.value;
    document.cookie = `username=${username}; expires=${hour_in_future()}`;

    //redirect to index if username is valid
    window.location.href = "index.php";
    return;
  }

  if (length < 5) { //returns error if username < 5 characters
    alert(error1);
  
  }

  if (length > 40) { //returns error if username > 40 characters
    alert(error1);
   
  }
  for (let i = 0; i < username.length; i++) {
    if (badChar.includes(username[i])){
      alert(error1);
    
    } 
    if (!goodChar.includes(username[i])){
      alert(error2);
  
    }
  }
}


function hour_in_future(){
  let hour_in_future = new Date();
  hour_in_future.setMinutes(hour_in_future.getMinutes() + 60);
  return hour_in_future.toUTCString();
}