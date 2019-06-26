<div class="notice">
	<?php if (isset($_SESSION["notice"])) : ?>
		<?php if ($_SESSION["notice"] != "") : ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?= $_SESSION["notice"] ?>
			</div>
			<?php $_SESSION["notice"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (isset($_SESSION["warning"])) : ?>
		<?php if ($_SESSION["warning"] != "") : ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?= $_SESSION["warning"] ?>
			</div>
			<?php $_SESSION["warning"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (isset($_SESSION["error"])) : ?>
		<?php if ($_SESSION["error"] != "") : ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?= $_SESSION["error"] ?>
			</div>
			<?php $_SESSION["error"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>