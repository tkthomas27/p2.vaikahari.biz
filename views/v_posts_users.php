<?php foreach($users as $user): ?>

    <!-- Print this user's name -->
<div class='prohead'>
    <?=$user['first_name']?> <?=$user['last_name']?><br>
</div>
<div class='prodetail'>
    Hometown: <?=$user['home']?><br>
    Favorite Season: <?=$user['season']?><br>
    Favorite Thing: <?=$user['favorite']?><br>
    Best Friends: <?=$user['friends']?><br>
</div>
    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
    <div class='unfollow'>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
    </div>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
    <div class='follow'>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    </div>
    <?php endif; ?>

    <br><br>

<?php endforeach; ?>