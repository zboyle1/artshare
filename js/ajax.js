const account = "/artshare/ajax/accountajax.php";
const commission = "/artshare/ajax/commissionsajax.php";
const submission = "/artshare/ajax/submissionajax.php";

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
        $.post(account, {"cmd": "signup", "newuser": newuser, "newpass": newpass, "email": email, "dob": dob}, function(data) {
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

// Show commission based on status and commissioner/artist

function showunfinished(userid) {
    $.post(commission, {"cmd": "unfinished", "user": userid},function(data) {
        $("#unfinished").append(data);
    });
    return(false);
}

function showtodo(userid) {
    $.post(commission, {"cmd": "todo", "user": userid},function(data) {
        $("#todo").append(data);
    });
    return(false);
}

function showreceived(userid) {
    $.post(commission, {"cmd": "received", "user": userid},function(data) {
        $("#received").append(data);
    });
    return(false);
}

function showfinished(userid) {
    $.post(commission, {"cmd": "finished", "user": userid},function(data) {
        $("#finished").append(data);
    });
    return(false);
}

// Front page functions

function foryou(userid) {
    $.post(submission, {"cmd": "foryou", "user": userid},function(data) {
        if(data == '0') {
            $("#optional").css("display", "none");
        } else {
            $("#foryou").html(data);
        }
    });
    return(false);
}

function newest() {
    $.post(submission, {"cmd": "newest"},function(data) {
        $("#newest").html(data);
    });
    return(false);
}

function popular() {
    $.post(submission, {"cmd": "popular"},function(data) {
        $("#popular").html(data);
    });
    return(false);
}

function talkedabout() {
    $.post(submission, {"cmd": "talkedabout"},function(data) {
        $("#talkedabout").html(data);
    });
    return(false);
}

// upload

function uploadsub(userid) {
    title = $("#title").val();
    desc = $("#desc").val();
    keywords = $("#keywords").val();
    type = $('input[name=type]:checked').val();
    if(type == 'visual') {
        medium = $('#medium').val();
        wordcount = "";
        bpm = "";
        genre = "";
    } else if(type == 'audio') {
        medium = "";
        wordcount = "";
        bpm = $('#bpm').val();
        genre = $('#genre').val();
    } else if(type == 'written') {
        medium = "";
        wordcount = $('#wordcount').val();
        bpm = "";
        genre = "";
    } else {
        medium = "";
        wordcount = "";
        bpm = "";
        genre = "";
    }

    $.post(submission, {"cmd": "upload", "userid": userid, "title": title, "desc": desc, "keywords": keywords, "type": type, "medium": medium, "wordcount": wordcount, "bpm": bpm, "genre": genre}, function(data){
        if(data == '0') {
            err = "A problem happened";
            $("#message").html(err);
            $("#message").css("display", "block");
        } else {
            window.location.href = "/artshare/index.php"
        }
    });

    return false;
}

// edit

function editsub(userid, picid) {
    title = $("#title").val();
    desc = $("#desc").val();
    keywords = $("#keywords").val();
    $.post(submission, {"cmd": "edit", "userid": userid, "picid": picid, "userid": userid, "title": title, "desc": desc, "keywords": keywords,}, function(data){
        if(data == '0') {
            err = "A problem happened";
            $("#message").html(err);
            $("#message").css("display", "block");
        } else {
            window.location.href = "/artshare/places/submission.php?id=" + picid;
        }
    });
    return false;
}


// submission page

function showsubinfo(userid, picid) {
    $.post(submission,{"cmd": "subpage", "userid": userid, "id": picid}, function(data){
        if(data == '0') {
            err = "Submission not found";
            $("#message").html(err);
            $("#message").css("display", "block");
        } else {
            $("#mainsubcontent").html(data);
        }
    });
}

// favorites
function isfav(userid,picid) {
    $.post(submission,{"cmd":"isfav","userid": userid, "picid": picid}, function(data){
        if(data == '1') {
            $("#un").css("display", "block");
            $("#fav").css("display", "none");
        } else if(data=='0') {
            $("#fav").css("display", "block");
            $("#un").css("display", "none");
        }
    });
}

function fav(userid,picid) {
    $.post(submission,{"cmd":"fav", "userid":userid, "picid": picid}, function(data){
        if(data == '1') {
            $("#un").css("display", "block");
            $("#fav").css("display", "none");
        }
    });
}

function unfav(userid,picid) {
    $.post(submission,{"cmd":"unfav", "userid":userid, "picid": picid}, function(data){
        if(data == '1') {
            $("#fav").css("display", "block");
            $("#un").css("display", "none");
        }
    });
}