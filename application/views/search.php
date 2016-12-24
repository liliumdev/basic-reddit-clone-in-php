<?php 
$_customTitle = 'login';
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
include('header.php'); 
?>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12">
    			<div class="white-round-box">
	    			<h1 style="text-align: center;">Search</h1>
	    			
	    			<form class="centered-form" id="searchform" action="/main/search/-1" method="POST">
	    				<p>Search term</p>
	    				<div class="row">
		    					<input type="text" name="query" id="query">
	    						<button type="submit" class="green-btn" value="search" >Search</button>
	    				</div>

						<div class="row">
		    				<div class="column grid-12 split-1">
		    					<p><b id="suggestionsTitle">Suggestions</b></p>
		    					<ul id="quickRezultati">
		    					</ul>
		    				
		    				</div>
	    				</div>

	    			</form>

	    			<div class="clearfix"></div>


    			</div>
    		</div>

    		
    	</div>
	</div>


    <script src="/static/js/search-live.js"></script>

<?php 
include('footer.php'); 
?>