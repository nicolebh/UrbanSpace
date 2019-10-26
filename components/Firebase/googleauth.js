$(document).ready(function() {
    if(document.referrer == ""){
        document.querySelector('#page_loading').style.display = "block";
    }
    firebase.auth().getRedirectResult().then(function(result) {
        if (result.credential) {
            document.querySelector('#sign_in_btn').innerHTML= 'Loading';
            document.querySelector('#login-email').disabled = true;
            document.querySelector('#login-password').disabled = true;
          // This gives you a Google Access Token. You can use it to access the Google API.
          var token = result.credential.accessToken;
          // ...
        }
        // The signed-in user info.
        var user = result.user;
        
        // const email = user.email;
        
        // // get user info
        // //user name, email, password, full name, phone, city, street, created_time
        const username = user.email;
        const email = user.email;
        // const password = signupForm['password'].value;
        const fullname = user.displayName;
        // const phone = signupForm['phone'].value;
        // const city = signupForm['city'].value;
        // const street = signupForm['street'].value;
        // const terms = signupForm['terms'].checked;
            $.ajax({
                type: "POST",
                url: "../../php_classes/register.php",		
                data: {
                    action: 'google_signin',
                    username: username,
                    email: email,
                    fullname: fullname,
                },
                success: function(data){
                        document.querySelector('#error_list').innerHTML = data;
                        if(document.referrer.substring(0,51) == "http://nimrodba.mtacloud.co.il/urbanspace/order.php")
                            window.location.replace(document.referrer);
                        else
                            window.location.replace("../../index.php"); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error in ajax request");
                    console.log(XMLHttpRequest,textStatus,errorThrown);
                 }
            });
      }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
        // ...
      });
})

if(document.querySelector('#google_signin_btn')){
    const signin_btn = document.querySelector('#google_signin_btn');
    signin_btn.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('#page_loading').style.display = "block";
        var provider = new firebase.auth.GoogleAuthProvider();
        firebase.auth().signInWithRedirect(provider);
    });
}
