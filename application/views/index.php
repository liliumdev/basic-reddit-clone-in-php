<?php 
$_customTitle = 'index';
include('header.php'); 


?>
	<div class="container" id="mainContent">
    	<div class="row">
    		<div class="column grid-8 split-1">
    			<div class="white-round-box">
	    			<h1>Welcome to sub/<b>all</b>! Just a regular community with lots of things to say.</h1>
	    			
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
								<a href="/subs/sub_post/<?php echo $post->id; ?>/" class="title"><?php echo $post->title; ?></a>
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

    		<div class="column grid-4 split-1">
    			<div class="invisible-box">
    				<a href="#" class="green-btn">Did you know<br><span class="thin">that brcip launched on 01.01.2017?</span></a>


    				<div class="simple-list">
    					<p class="title">Latest posts</p>

    					<?php
							foreach($latestPosts as $post)
							{
						?>
						<div class="item">
    						<a href="/subs/sub_post/<?php echo $post->id; ?>" class="item-title"><?php echo $post->title; ?></a>
    						<div class="item-subtitle"><?php echo $this->time_since(strtotime($post->created_at)); ?></div>
    					</div>
						<?php
							}
						?>
    				</div>

    				<div class="simple-list">
    					<p class="title">Newest users</p>


						<?php
							foreach($latestUsers as $user)
							{
						?>
						<div class="item">
    						<a href="#" class="item-title"><?php echo $user->username; ?></a>
    					</div>
						<?php
							}
						?>
    				</div>

    			</div>
    		</div>
    	</div>
	</div>

<?php include('footer.php'); ?>