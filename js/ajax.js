const account = "/artshare/ajax/accountnajax.php";

// Login functions

function login() {
    user = $("#user").val();
    pass = $("#pass").val();
    err = "";

    if( user != "" && pass != "") {
        $.post(account, {"cmd": "login", "user": user, "pass": pass },function(data) {
            if(data == '1') {
                window.location.href = "/artshare/index.php";
            } else {
                err = "Invalid login";

                $("#message").html(err);
                $("#message").css("display", "block");
            }
        });
        return(false);
    }
}

function logout() {
    $.post(account, {"cmd": "logout"}, function(data) {
        if(data == '1') {
            window.location.href = "/artshare/index.php";
        } else {
            console.error('something weird happened');
        }
    });
}

function signup() {
    newuser = $("#user").val();
    newpass = $("#pass").val();
    email = $("#email").val();
    dob = $("#dob").val();
    err = "";

    if( user != "" && pass != "") {
        $.post(account, {"cmd": "signup", "newuser": newuser, "newpass": newpass, "emai": email, "dob": dob}, function(data) {
            if(data == '0') {
                err = "Invalid birthday input";

            } else if(data == '1') {
                err = "Username taken";

            } else if(data == '2') {
                err = "Signup failed";

            } else if(data == '3') {
                window.location.href = "/artshare/index.php";

            } else {
                err = "Signup failed";
            }
            
            $("#message").html(err);
            $("#message").css("display", "block");
        });
        return(false);
    }
}