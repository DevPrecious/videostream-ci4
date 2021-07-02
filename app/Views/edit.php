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
		<form action="" method="POST">
			<div class="pt-2"></div>
			<div class="form-group">
				<label for="description">Video Description</label>
				<textarea name="description" id="" cols="30" rows="10" class="form-control"><?= esc($video['description']) ?></textarea>
			</div>
			<div class="pt-2"></div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
	</div>
</div>


<?= $this->endSection('content') ?>