//Listen for auth status changes
// auth.onAuthStateChanged(user => {
//     const loginBtn = document.querySelector('#login-btn');
//     const userMenu = document.querySelector('#user-menu');
//     if(user){
//         console.log("user logged in: ", user)
//         loginBtn.style.display = "none";
//         userMenu.style.display = "block";
//     } else {
//         console.log("user logged out");
//         loginBtn.style.display = "block";
//         userMenu.style.display = "none";
//     }
// })

if(document.querySelector('#signup-form')){
    const signupForm = document.querySelector('#signup-form');
    signupForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // get user info
        //user name, email, password, full name, phone, city, street, created_time
        const username = signupForm['username'].value;
        const email = signupForm['email'].value;
        const password = signupForm['password'].value;
        const fullname = signupForm['fullname'].value;
        const phone = signupForm['phone'].value;
        const city = signupForm['city'].value;
        const street = signupForm['street'].value;
        const terms = signupForm['terms'].checked;
        
            $.ajax({
                type: "POST",
                url: "../../php_classes/register.php",		
                data: {
                    action: 'register',
                    username: username,
                    email: email,
                    password: password,
                    fullname: fullname,
                    phone: phone,
                    city: city,
                    street:	street,
                    terms: terms
                },
                success: function(data){
                    if(data) {
                        document.querySelector('#error_list').innerHTML = data;
                    }
                    else {
                            auth.createUserWithEmailAndPassword(email, password).then(cred => {
                            window.location.replace("../../index.php"); 
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("error in ajax request");
                    console.log(errorThrown);
                 }
            });
    });
}
//logout
if(document.querySelector('#logout')){
    const logout = document.querySelector('#logout');
    logout.addEventListener('click', (e) => {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/urbanspace/php_classes/general.php",		
            data: {
                action: "logout"
            },
            success: function(data){
                window.location.replace("/urbanspace/index.php"); 
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("error in ajax request");
                console.log(errorThrown);
            }
        })
        auth.signOut().then(() => {
            console.log("logged out");
        });
    });
}

//login
if(document.querySelector('#login-form')){
    const loginForm = document.querySelector('#login-form');
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        //get user info
        const email = loginForm['login-email'].value;
        const password = loginForm['login-password'].value;
        $.ajax({
            type: "POST",
            url: "/urbanspace/php_classes/general.php",		
            data: {
                action: "login",
                email: email,
                password: password
            },
            success: function(data){
                if(data) {
                    console.log(data);
                    document.querySelector('#error_list').innerHTML = data;
                }
                else {
                    auth.signInWithEmailAndPassword(email, password).then(cred => {
                        window.location.replace("/urbanspace/index.php");
                    })
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("error in ajax request");
                console.log(errorThrown);
            }
        })    
        
    })
}

//Check if user logged in
function CheckIfLoggedIn() {
    document.onreadystatechange = function() {
        const page = document.querySelector('html');
        const header = document.querySelector('#header_menu');
        page.style.visibility = "hidden";
        header.style.visibility = "hidden";
        auth.onAuthStateChanged(user => {
            if(!user){
                window.location.href = "components/Panel/login.html";
            }
            else {
                $.ajax({
                        type: "POST",
                        url: "/urbanspace/components/Firebase/auth.php",		
                        data: {
                            action: "login",
                            fullname: user.displayName
                        },
                        success: function(data){
                            if(data == "False") {
                                auth.signOut().then(() => {
                                    console.log("logged out");
                                });
                            }
                            else {
                                page.style.visibility = "visible";
                                header.style.visibility = "visible";
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.log("error in ajax request");
                            console.log(errorThrown);
                        }
                    })
            }
        return false;
    });
    return;
}}