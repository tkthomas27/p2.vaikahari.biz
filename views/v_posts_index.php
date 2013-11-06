<?php foreach($posts as $post): ?>

<article>

	<span class='posthead'><?=$post['first_name']?> <?=$post['last_name']?> says:</span>
	
	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	<?=Time::display($post['created'])?>


	</time>

</article>

<?php endforeach; ?>
