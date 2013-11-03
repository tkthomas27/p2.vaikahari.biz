<?php foreach($posts as $post): ?>

	<strong><?=$post['first_name']?> posted on <?=Time::display($post['created'])?></strong>
	<?=$post['content']?><br><br>

<?php endforeach;?>