<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
<div class="pt-3"></div>
	<div class="row">
		<?php foreach($videos as $video) : ?>
			<div class="col">
			<div class="card" style="width: 18rem;">
			<img src="/uploads/thumbnails/<?= esc($video['thumbnail']) ?>" class="card-img-top" alt="...">
			<div class="card-body">
				<p class="card-text"><?= esc($video['description']) ?></p>
				<a href="/edit/<?= esc($video['upload_id']) ?>" class="btn btn-primary">Edit</a>
				<a href="/delete/<?= esc($video['upload_id']) ?>" class="btn btn-danger">Delete</a>
			</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>


<?= $this->endSection() ?>