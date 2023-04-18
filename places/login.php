<?php
	include '../header.php';
    include '../footer.php';
?>
<div class="cell medium-10 large-10">
    <div class="grid-x grid-padding-x" id="inv">
        <div class="cell" id="pagetitle">
            <h3>Login</h3>
        </div>
    
        <div class="cell">  
            <form onsubmit="return(login())">
		        <label>Username
                    <input type="text" id="user" required>
                </label>

                <span class="form-error">
                    You need a username to login!
                </span>

                <label>Password
                    <input type="password" id="pass">
                </label>

                <span class="form-error">
                    You need a password to login!
                </span>
        
                <div class = "callout alert" id="message"></div>
            
                <button class = "submit button">Login</button>
                <a href = "/artshare/places/signup.php" class="button secondary">Sign up</a>
	        </form>
        </div>
    </div>
</div>

<?php
    send_footer();
?>