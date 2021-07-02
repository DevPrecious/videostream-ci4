<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


 <div class="container-lg my-4">

<div class="row justify-content-center">
    <div class="col-md-5">
       <?php if(empty($user->avatar)) : ?>
        <img width="250" height="250" class="rounded-circle" src="/uploads/profile/devp.jpg" alt="">
        <?php else: ?>
        <img width="250" height="250" class="rounded-circle" src="/uploads/profile/<?= $user->avatar ?>" alt="">
        <?php endif; ?>
    </div>

    <div class="col-md-5">
            <h1>
                <div class="text-dark"><?= esc($user->username) ?></div>
                <div class="font-monospace text-muted"><?= esc($user->email) ?></div>
            </h1>
            <hr>
            <?php if(session()->get('success')) : ?>
            <div class="alert alert-success">
                <?= session()->get('success') ?>
            </div>
            <?php endif; ?>
            <?php if(isset($validation)) : ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= esc($user->username) ?>" class="form-control" id="">
                </div>

                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" name="email" value="<?= esc($user->email) ?>" class="form-control" id="">
                </div>

                <div class="form-group">
                    <label for="username">Image</label>
                    <input type="file" name="image" class="form-control" id="">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="">
                </div>

                <div class="form-group pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
    </div>
</div>

 </div>



<?= $this->endSection() ?>