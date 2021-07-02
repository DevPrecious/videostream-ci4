<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="container pt-4">
    <video src="/uploads/videos/<?= esc($video['video']) ?>" controls width="800" height="400">
    </video>
    <div class="pt-4">
        <?php if(!empty($like_user['user_id'])) : ?>
        <a href="/like/<?= esc($video['upload_id']) ?>" class="btn btn-primary">Like</a>
        <?php endif; ?>
        <?= esc($likes) ?> Likes
        <?php if($video['user_id'] == auth()->user()->id) : ?>
        <?php elseif(!empty($sub_user['user_id']) == auth()->user()->id): ?>

           <?php else: ?>
            <a href="/subscribe/<?= esc($video['upload_id']) ?>" class="btn btn-danger">Subscribe</a>
        <?php endif; ?>
        | <?= esc($sub_count) ?> subscriber
    </div> 
    <div class="pt-2">
        Upload by: <?= esc($video['username']) ?> <br>
        at <?php use CodeIgniter\I18n\Time; 
            $time = $video['video_created_at'];
            $parse = Time::parse($time);
            echo $parse->humanize();
            ?>
    </div>
    <div class="pt-4">
        Description: <br>
        <?= esc($video['description']) ?>
    </div>

    <hr>

    <b>Comments:</b> <br>

    <?php foreach($comments as $comment) : ?>

        <b><?= esc($comment['username']) ?></b> : <?= esc($comment['comment']) ?>
        <br>

    <?php endforeach; ?>

    <hr>

    <div class="pt-4">
    <?php if(session()->get('success')) : ?>
        <div class="alert alert-success">
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
        <?php if(auth()->check()) : ?>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" required name="comment" id="" class="form-control">
                    <input type="hidden" name="user_id" value="<?= auth()->user()->id ?>" id="">
                </div>
                <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary">Comment</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>


<?= $this->endSection() ?>