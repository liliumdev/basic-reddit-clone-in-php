<?php 
$_customTitle = 'create post in ' . $subreddit->title;
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Create new post in /r/<?php echo $subreddit->title; ?></h1>

	    			<?php
	    			$this->printErrorsForForms();
	    			?>
	    			
	    			<form class="centered-form" id="registerform" action="/subs/create_post/<?php echo $subreddit->id; ?>" method="POST">
	    				<p>Title</p>
	    				<p class="form-error" id="title-error">Title must not contain disallowed symbols!</p>
	    				<input type="text" name="title" id="title">
	    				<p>Content</p>
	    				<p class="form-error" id="description-error">Content must not contain disallowed symbols!</p>
	    				<textarea type="text" name="content" id="content" style="width: 100%; height: 200px;"></textarea>
	    				
	    				<button type="submit" class="green-btn" value="create">Create</button>
	    			</form>

	    			<div class="clearfix"></div>


    			</div>
    		</div>

    		
    	</div>
	</div>


    <script src="/static/js/post-validation.js"></script>


<?php 
include('footer.php'); 
?>