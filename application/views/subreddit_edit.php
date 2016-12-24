<?php 
$_customTitle = 'create sub';
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Edit a subreddit</h1>

	    			<?php
	    			$this->printErrorsForForms();
	    			?>
	    			
	    			<form class="centered-form" id="registerform" action="/subs/edit/<?php echo $subreddit->id; ?>" method="POST">
	    				<p>Title</p>
	    				<p class="form-error" id="title-error">Title must be alphanumeric!</p>
	    				<input type="text" name="title" id="title" value="<?php echo $subreddit->title; ?>">
	    				<p>Description</p>
	    				<p class="form-error" id="description-error">Description can allow only alphanumeric characters and the following: .,;-</p>
	    				<input type="text" name="description" id="description" value="<?php echo $subreddit->description; ?>">
	    				
	    				<button type="submit" class="green-btn" value="create">Apply</button>
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