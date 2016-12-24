<?php 
$_customHead = true;
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li><a href="/main/login">Login</a></li>
						<li class="active"><a href="/main/register">Register</a></li>
						<li><a href="#">Forgot password?</a></li>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Register</h1>

	    			<?php
	    			$this->printErrorsForForms();
	    			?>
	    			
	    			<form class="centered-form" id="registerform" action="/main/register" method="POST">
	    				<p>Username</p>
	    				<p class="form-error" id="username-error">Username can only contain alphanumeric characters, scores and underscores and must be at least 4 characters long!</p>
	    				<input type="text" name="username" id="username">
	    				<p>Password</p>
	    				<p class="form-error" id="password-error">Password must be at least 8 characters long!</p>
	    				<input type="password" name="password" id="password">
	    				<p>Confirm password</p>
	    				<p class="form-error" id="password-unmatch-error">Passwords do not match!</p>
	    				<input type="password" name="password2" id="password2">
	    				<p>Email</p>
	    				<p class="form-error" id="email-error">The e-mail must be a valid e-mail address.</p>
	    				<input type="text" name="email" id="email">
	    				<button type="submit" class="green-btn" value="register">Register</button>
	    			</form>

	    			<div class="clearfix"></div>


    			</div>
    		</div>

    		
    	</div>
	</div>


 <!--   <script src="/static/js/register-validation.js"></script> -->

<?php 
include('footer.php'); 
?>