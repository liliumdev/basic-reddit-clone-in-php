<?php 
$_customTitle = 'create sub';
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Create new subreddit</h1>

	    			<?php
	    			$this->printErrorsForForms();
	    			?>
	    			
	    			<form class="centered-form" id="registerform" action="/subs/create" method="POST">
	    				<p>Title</p>
	    				<p class="form-error" id="title-error">Title must be alphanumeric!</p>
	    				<input type="text" name="title" id="title">
	    				<p>Description</p>
	    				<p class="form-error" id="description-error">Description can allow only alphanumeric characters and the following: . , ; - ! ?</p>
	    				<input type="text" name="description" id="description">
	    				
	    				<button type="submit" class="green-btn" value="create">Create</button>
	    			</form>

	    			<div class="clearfix"></div>


    			</div>
    		</div>

    		
    	</div>
	</div>


    <script src="/static/js/subreddit-validation.js"></script>


<?php 
include('footer.php'); 
?>