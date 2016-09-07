var form = document.querySelector(".form");
var input = document.querySelector(".email");
var btn = document.querySelector(".btn");
var error_ul = document.querySelector(".errors");
var email_adresses;
var errors = 0;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  

if (form) {
  
  // listen for form submit
  form.addEventListener("submit", function(submit) {
  	submit.preventDefault();

    // remove errors from previous submits
    while (error_ul.hasChildNodes()) {   
        error_ul.removeChild(error_ul.firstChild);
    }

  	// remove white space from input, split email adresses into array
  	email_adresses = input.value.replace(/\s+/g, '').split(',');

    // create error messages
  	for (var i = 0; i < email_adresses.length; i++) {
  		if(!email_adresses[i].match(mailformat)){
        li = document.createElement('li');
  			li.appendChild(document.createTextNode(email_adresses[i] + " is not a valid email address"));
        error_ul.appendChild(li);
        input.classList.add("error");
  			errors++;
  		}
  	}

  	// if no errors, remove duplicates, send input to server
  	if(errors == 0) {
        var uniqueArray = email_adresses.filter(function(elem, pos) {
        return email_adresses.indexOf(elem) == pos;
      });

      $.ajax({
        type: "GET",
        url: "./logic/emails.php",
        data: { data: uniqueArray },
        success: function(){
          error_ul.style.display = "none";
          setTimeout(function (){
            window.location = window.location;
          }, 600);
        }
      })
    }

    // add animation to button, remove after 2 sec 
    btn.classList.add("punched");
    setTimeout(function (){
      btn.classList.remove("punched");
    }, 800);
    errors = 0;
  });
}
