<?php 
$_customTitle = 'login';
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li class="active"><a href="/main/login">Login</a></li>
						<li><a href="/main/register">Register</a></li>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Login</h1>
	    			
	    			<?php
	    			$this->printErrorsForForms();
	    			?>

	    			<form class="centered-form" id="loginform" action="/main/login" method="POST">
	    				<p>Username</p>
	    				<p class="form-error" id="username-error">Username can only contain alphanumeric characters, scores and underscores and must be at least 4 characters long!</p>
	    				<input type="text" name="username" id="username">
	    				<p>Password</p>
	    				<p class="form-error" id="password-error">Password must be at least 8 characters long!</p>
	    				<input type="password" name="password" id="password">
	    				<button type="submit" class="green-btn" value="login">Login</button>
	    			</form>

	    			<div class="clearfix"></div>


    			</div>
    		</div>

    		
    	</div>
	</div>


    <script src="/static/js/login-validation.js"></script>

<?php 
include('footer.php'); 
?>