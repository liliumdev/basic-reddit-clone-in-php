<?php 
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
$_customTitle = 'subreddits';
include('header.php'); 
?>

	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li class="active"><a href="#">Top</a></li>
						<li><a href="#">New</a></li>
						<li><a href="#">Most discussed</a></li>
				</div>
			</div>
		</div>
	</div>

	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12 split-1">
    			<div class="white-round-box">
    				<div class="border-bottom row" style="margin-bottom: 15px;">
    					<div class="column grid-8">
	    					<h1 class="no-border">We currently don't have too many subs on brcip! Feel free to join existing or create new ones on our free, non-censored and open community! </h1>
	    					<?php
	    					if($_loggedIn && $_SESSION['user'] == 'admin')
	    					{
	    					?>
							<p style="color: #cb4346; text-align: center;">
	    						<b>admin option</b>:
	    						<a href="/subs/create">create new</a> | 
	    						<a href="/subs/reportcsv">create a csv report</a> |
	    						<a href="/subs/reportpdf">create a pdf report</a> 
    						</p>
	    					<?php 
	    					}
	    					?>
    					</div>
    					<div class="column grid-4">    						
	    					<a href="#" class="green-btn right-floated-btn" style="margin-top: 30px; margin-right: 10px;">contact us</a>
    					</div>
    				</div>

    				<?php
    				foreach($subreddits as $subreddit)
    				{
    				?>
						<div class="thread">
		    				<div class="vote-count">
		    					<span><?php echo $subreddit->subscribers; ?></span><br>
		    					<span style="font-size: 10px;">subscribers</span>
		    				</div>
		    				<div class="thread-info">
		    					<div class="row">
		    						<div class="column grid-8">
				    					<a href="#" class="title">sub/<b><?php echo $subreddit->title; ?></b></a>
				    					<p class="subtitle"><?php echo $subreddit->description; ?></p>
				    					<?php
				    					if($_loggedIn && $_SESSION['user'] == 'admin')
				    					{
				    					?>
				    					<p class="subtitle" style="color: #cb4346;">
				    						<b>admin options</b>:
				    						<a href="/subs/edit/<?php echo $subreddit->id; ?>">edit</a> | 
				    						<a href="/subs/delete/<?php echo $subreddit->id; ?>">delete</a> 
			    						</p>

				    					<?php 
					    				}
					    				?>
			    					</div>
			    					<div class="column grid-4">
			    						<a href="#" class="green-btn right-floated-btn">+ subscribe</a>
			    					</div>
		    					</div>
		    				</div>
		    				<div class="clearfix"></div>
		    			</div>
    				<?php
    				}
    				?>
	    			
	    			    			

    			</div>

    			<br><br><br><br>
    		</div>

    		
    	</div>
	</div>

	<script src="/static/js/main.js"></script>

<?php 
include('footer.php'); 
?>