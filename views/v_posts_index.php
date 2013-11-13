<h1>Latest Posts </h1> 
        
<?php foreach($posts as $post): ?>

<article>

	<div class="news">
		<div class="news_content">    
			<span><?=$post['first_name']?> <?=$post['last_name']?> posted:</span><br />
			<p><?=$post['content']?></p>			
		</div>
	</div>  
        
	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	    <?=Time::display($post['created'])?>
    </time>

</article>

<?php endforeach; ?>
