<?php 
$_customHeadContent = '<link rel="stylesheet" href="/static/css/forms.css">';
$_customTitle = $subreddit->title;
include('header.php'); 

?>
	<div id="subMenu">
		<div class="container">
			<div class="row">
				<div class="column grid-12">
					<ul>
						<li <?php $this->isNotPartlyActive('new'); ?>><a href="/subs/sub/<?php echo $subreddit->title;?>">Top</a></li>
						<li <?php $this->isPartlyActive('new'); ?>><a href="/subs/sub/<?php echo $subreddit->title;?>/new">New</a></li>
						<li <?php $this->isPartlyActive('comments'); ?>><a href="/subs/sub/<?php echo $subreddit->title;?>/comments">Most discussed</a></li>
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
	    					<h1 class="no-border" style="text-align: center;"><?php echo $subreddit->description; ?><br>(<?php echo $subreddit->subscribers; ?> subscribers)</h1>
	    					<?php
	    					if($_loggedIn)
	    					{
	    					?>
							<p style="color: #cb4346; text-align: center;">
	    						<a href="/subs/create_post/<?php echo $subreddit->id; ?>">create post</a>
    						</p>
	    					<?php 
	    					}
	    					?>
    					</div>
    				</div>
		    				<div class="clearfix"></div>

    				<?php
    				foreach($posts as $post)
    				{
    				?>
						<div class="thread">
		    				<div class="vote-count">
		    					<a href="javascript:;" onclick="vote('post', <?php echo $post->id; ?>, 'up', this.parentElement.getElementsByTagName('span')[0]);" class="vote-up">&#x25B2;</a> <!-- ▲ -->
		    					<span><?php echo $post->votes; ?></span>
		    					<a href="javascript:;" onclick="vote('post', <?php echo $post->id; ?>, 'down', this.parentElement.getElementsByTagName('span')[0]);" class="vote-down">&#x25BC;</a> <!-- ▼ -->
		    				</div>
		    				<div class="thread-info">
								<a href="/subs/sub_post/<?php echo $post->id; ?>/" class="title"><b><?php echo $post->title; ?></b></a>
								<p class="subtitle">
									<a href="/subs/sub_post/<?php echo $post->id; ?>/"><?php echo $post->comments; ?> comments | <?php echo $this->time_since(strtotime($post->created_at)); ?></a> | by <?php echo $post->username; ?>
		    					<?php
		    					if($_loggedIn && $post->author_id == $_SESSION['user_id'])
		    					{
		    					?>
		    						| <a href="/subs/delete_post/<?php echo $post->id; ?>">delete</a>
		    					<?php 
			    				}
			    				?>

			    				</p>
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