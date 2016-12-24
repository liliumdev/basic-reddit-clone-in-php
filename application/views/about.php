<?php 
$_customTitle = 'about';
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li class="active"><a class="ajax-tab" data-file="/static/about_why.html"  href="javascript:;">Why?</a></li>
						<li><a class="ajax-tab" data-file="/static/about_who.html" href="javascript:;">Who?</a></li>
						<li><a class="ajax-tab" data-file="/static/about_where.html" href="javascript:;">Where?</a></li>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
    				<div class="row border-bottom" style="margin-bottom: 15px;">
    					<div class="column grid-10">
    						<h1 class="no-border">Why did you create a basic reddit clone in PHP ? </h1>
    					</div>
    					<div class="column grid-2">
    						<a href="#" class="green-btn right-floated-btn in-header">contact us</a>
    					</div>
    				</div>
	    				    			
	    			<p class="big-centered-text">
	    				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore. 
<br><br>
Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
	    			</p>

    			</div>
    		</div>

    		
    	</div>
	</div>

	<script src="/static/js/main.js"></script>
    <script src="/static/js/ajax-about.js"></script>

<?php 
include('footer.php'); 
?>