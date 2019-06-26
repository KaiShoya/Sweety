<div class="notice">
	<?php if (isset($_SESSION["notice"])) : ?>
		<?php if ($_SESSION["notice"] != "") : ?>
			<div class="notification is-success">
				<button class="delete"></button>
				<?= $_SESSION["notice"] ?>
			</div>
			<?php $_SESSION["notice"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (isset($_SESSION["warning"])) : ?>
		<?php if ($_SESSION["warning"] != "") : ?>
			<div class="notification is-warning">
				<button class="delete"></button>
				<?= $_SESSION["warning"] ?>
			</div>
			<?php $_SESSION["warning"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (isset($_SESSION["error"])) : ?>
		<?php if ($_SESSION["error"] != "") : ?>
			<div class="notification is-danger">
				<button class="delete is-medium" v-on:click=""></button>
				<?= $_SESSION["error"] ?>
			</div>
			<?php $_SESSION["error"] = ""; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>

<script>
	for (const element of document.querySelectorAll('.notification > .delete')) {
		element.addEventListener('click', e => {
			e.target.parentNode.classList.add('is-hidden');
		});
	}
</script>