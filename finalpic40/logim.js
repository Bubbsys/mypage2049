//logim.js

//logim.js
let submitButton = document.getElementById("submit");
submitButton.addEventListener("click", function() {

  let passwordInput = document.getElementById("email");
  let password = passwordInput.value;
  mock(password);
});


let keyListen = document.getElementById("email")
keyListen.addEventListener("keyup", function(e) {
  let password = keyListen.value;
  let enter = "Enter";
  
  if (e.key === enter) {
    mock(password);
  }
});

let startHeader = document.querySelector("header h1");
let mockText = "HA";


function mock(password) {
  //console.log("Somebody knows the password you like to use is " + password);
  startHeader.innerHTML = mockText;
  mockText += "HA";

  let mainSec = document.getElementById("mainSection");
  let mockPara = document.createElement("p");
  mainSec.appendChild(mockPara);
  mockPara.innerHTML = `Somebody knows the password you like to use is <b>${password}</b>`;
 
}
