<?php 
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
$_customTitle = $post->title;
include('header.php'); 

?>
	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li><a href="/subs/sub/<?php echo $subreddit->title; ?>">/sub/<?php echo $subreddit->title; ?></a></li>
				</div>
			</div>
		</div>
	</div>
	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-12 split-1">
    			<div class="white-round-box">
    				<div class="border-bottom row" style="margin-bottom: 15px;">
    					<div class="column grid-12">
	    					<h1 class="no-border" style="text-align: center;"><?php echo $post->title; ?></h1>	    					
							<p style="color: #cb4346; text-align: center;">
	    						<?php echo $post->content; ?>
    						</p>
    					</div>
    				</div>
		    				<div class="clearfix"></div>

    				<?php
    				$i = 0;
    				for($i = 0; $i < count($comments); $i++)    					
    				{
    					$comment = $comments[$i];
    				?>
						<div class="thread">
		    				<div class="vote-count">
		    					<a href="javascript:;" onclick="vote('comment', <?php echo $comment['id']; ?>, 'up', this.parentElement.getElementsByTagName('span')[0]);" class="vote-up">&#x25B2;</a> <!-- ▲ -->
		    					<span><?php echo $comment['votes']; ?></span>
		    					<a href="javascript:;" onclick="vote('comment', <?php echo $comment['id']; ?>, 'down', this.parentElement.getElementsByTagName('span')[0]);" class="vote-down">&#x25BC;</a> <!-- ▼ -->
		    				</div>
		    				<div class="thread-info">
								<p><?php echo $comment['content']; ?></p>
								<p class="subtitle">
									by <?php echo $comment['username']; ?> | <?php echo $this->time_since(strtotime($comment['created_at'])); ?>
			    				</p>
	    					</div>
		    				<div class="clearfix"></div>
		    			</div>
    				<?php
    				}
    				?>

					<div class="thread">					
		    			<?php
		    			if($_loggedIn)
		    			{
	    				?>
	    				<form class="centered-form" id="registerform" action="/subs/create_comment/<?php echo $post->id; ?>" method="POST">
		    				<p>Reply</p>
		    				<textarea type="text" name="content" id="content" style="width: 100%; height: 150px;"></textarea>
		    				
		    				<button type="submit" class="green-btn" value="create">Reply</button>
		    			</form>
		    			<?php
		    			} else {
	    				?>
							<p style="text-align: center; color: #999;">You must be logged in to comment.</p>
	    				<?php 
	    				}
	    				?>

	    				<div class="clearfix"></div>
	    			</div>
    			</div>

    			
    		</div>

    		
    	</div>
	</div>

	<script src="/static/js/main.js"></script>

<?php 
include('footer.php'); 
?>