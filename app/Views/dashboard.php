<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container pt-4">
	<?php if(isset($validation)) : ?>
		<div class="alert alert-danger">
			<?= $validation->listErrors() ?>
		</div>
	<?php endif; ?>
	<?php if(session()->get('success')) : ?>
		<div class="alert alert-success">
			<?= session()->get('success') ?>
		</div>
	<?php endif; ?>
	<dic class="row">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="video">Video File</label>
				<input type="file" required class="form-control" name="video" id="">
			</div>
			<div class="pt-2"></div>
			<div class="form-group">
				<label for="video">Video Thumbnail</label>
				<input type="file" class="form-control" name="image" id="">
			</div>
			<div class="pt-2"></div>
			<div class="form-group">
				<label for="description">Video Description</label>
				<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
			</div>
			<div class="pt-2"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Upload</button>
			</div>
		</form>
	</dic>
	<div class="pt-3"></div>
	<div class="row">
		<?php foreach($videos as $video) : ?>
			<div class="col">
			<div class="card" style="width: 18rem;">
			<img src="/uploads/thumbnails/<?= esc($video['thumbnail']) ?>" class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text"><?= esc($video['description']) ?></p>
				<a href="/video/<?= esc($video['upload_id']) ?>" class="btn btn-primary">Watch</a>
			</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>


<?= $this->endSection('content') ?>