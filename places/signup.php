<?php
	include '../header.php';
    include '../footer.php';
?>
<div class="cell medium-10 large-10">
    <div class="grid-x grid-padding-x">
        <div class="cell" id = "pagetitle">
            <h3>Sign up</h3>
        </div>

        <div class="cell large-8 medium-6 small-4">    
            <form onsubmit="return(signup())">
    		    <label>Username
                    <input type="text" id="user" required>
                </label>

                <span class="form-error">
                    You need a username!
                </span>
		
                <label>Password
                    <input type="password" id="pass" required>
                </label>
        
                <span class="form-error">
                    You must set a password!
                </span>

                <label>E-mail
                    <input type="email" id="email" required>
                </label>
        
                <span class="form-error">
                    Please provide an e-mail
                </span>

                <label>Birthday 
                    <input type="date" id="dob" required>
                </label>
        
                <div class = "callout alert" id="message"></div>
    
                <button class = "submit button">Sign up</button>
                <a href = "/artshare/places/login.php" class="button secondary">Login</a>
	        </form>
        </div>
    </div>
</div>
<?php
    send_footer();
?>