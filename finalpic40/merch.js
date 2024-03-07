//merch.js
let credit = 20;
let creditElement = document.getElementById('creditElement');
if (!/\d/.test(creditElement.textContent)) {
  creditElement.innerHTML = `Available credit: $${credit.toFixed(2)}`;
}
//creditElement.innerHTML = `Available credit: $${credit.toFixed(2)}`;

let prices = [100, 13, 16.20, 10.05];
let cartTotal = 0;
let uRbroke = 'You need more $$$ to make that happen';

//loops over images and when you click an image it will checkbox
let images = document.getElementsByTagName('img');
for (let i = 0; i < images.length; i++) {
  images[i].addEventListener('click', function() {
    let checkbox = images[i].nextElementSibling.nextElementSibling;
    checkbox.checked = !checkbox.checked;
    checkbox.dispatchEvent(new Event('click'));
  });
}

//loops over the prices and adds each price to each item, and then adds in the checkbox listener for clicking the checkbox
let spanPrices = document.querySelectorAll('.product-price');
for (let i = 0; i < spanPrices.length; i++) {
  spanPrices[i].innerHTML = "$" + prices[i].toFixed(2);
  let checkbox = spanPrices[i].previousElementSibling;
  checkbox.addEventListener('click', function() {
    if (checkbox.checked) {
      cartTotal += prices[i];
    } else {
      cartTotal -= prices[i];
    }
  });
}



//builds checkout button
let checkoutButton = document.getElementById('checkout');
checkoutButton.addEventListener('click', function() {
  let couponInput = document.getElementById('coupon');
  let code = couponInput.value;
  let validated = validate_coupon_code(code);

  let checkoutPara = document.getElementById('checkoutPara');
  let totalWithTax = sales_total(cartTotal);

  
  if (cartTotal > credit) {
    alert(uRbroke);
  } else if (cartTotal <= credit) {
    checkoutPara.innerHTML = `$${cartTotal.toFixed(2)} + sales tax (7.25%) = $${(totalWithTax).toFixed(2)}`;

    // function update_credit(){
    credit -= sales_total(cartTotal);
    creditElement.textContent = `Available credit: $${credit.toFixed(2)}`;
    cartTotal = 0;

    const request = new XMLHttpRequest();
    let username = get_username('username');
    let userInfo = `username=${username}&credit=${credit}`;

    request.onload = function() {
      if (this.status === 200) {
        console.log("Credit updated");
      }
    }
  
    request.open("POST", "money.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(userInfo);
  // };

    // Sets checkboxes to disabled if they are checked and purchase goes through then they are disabled
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (let i = 0; i < checkboxes.length; i++) {
      let checked = checkboxes[i].checked;
      if (checked === true) {
        checkboxes[i].disabled = true;
      }
    }
  }
});

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


let checkboxes = document.querySelectorAll('input[type="checkbox"]');
for (let i = 0; i < checkboxes.length; i++) {
  if (checkboxes[i].checked) {
    checkboxes[i].checked = false;
    checkboxes[i].disabled = true;
    let image = checkboxes[i].nextElementSibling;
  }
}


function sales_total(totalBeforeTax) {
  const taxRate = 0.0725;
  let salesTax = totalBeforeTax * taxRate;
  let roundedSalesTax = Math.round(salesTax * 100) / 100;
  let centValue = Math.round(roundedSalesTax * 100) % 100;

  if (centValue % 2 === 0) {
    roundedSalesTax = Math.floor(roundedSalesTax * 100) / 100;
  } else {
    roundedSalesTax = Math.ceil(roundedSalesTax * 100) / 100;
  }

  let totalWithTax = totalBeforeTax + roundedSalesTax;
  return totalWithTax;
}

function validate_coupon_code(code) {
  if (code === 'COUPON5') {
    credit += 5;
  }
  if (code === 'COUPON10') {
    credit += 10;
  }
  if (code === 'COUPON20') {
    credit += 20;
  }

  // const request = new XMLHttpRequest();

  // //send username and current credit to money.php when the credit is updated
  // request.open('POST', 'money.php');
  // request.send('username=' + encodeURIComponent(username) + '&credit=' + encodeURIComponent(credit));
}

  


//if they press the enter button then it will trigger the checkout button function
let keyListen = document.getElementById('coupon');
keyListen.addEventListener("keyup", function(e) {
  let code = keyListen.value;
  let enter = 13;
  if (e.keyCode === enter) {
    document.getElementById('checkout').click();
  }
});
