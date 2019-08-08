<nav class="navbar is-dark">
	<div class="navbar-brand">
		<div class="navbar-item">Sweety</div>
		<a class="navbar-item <?= ($_SESSION["title"] == PRICE_LIST) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/price_list.php' ?>"><?= PRICE_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == HOTEL_LIST) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/hotel_list.php' ?>"><?= HOTEL_LIST ?></a>

		<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>

	<div class="navbar-menu" id="navMenu">
		<div class="navbar-start">
			<a class="navbar-item <?= ($_SESSION["title"] == TOS) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/tos.php' ?>"><?= TOS ?></a>
			<?php if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_role"])) : ?>
				<?php if ($_SESSION["user_role"] === "admin") : ?>
					<a class="navbar-item <?= ($_SESSION["title"] == AVAILABILITY) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/admin/availability.php' ?>"><?= AVAILABILITY ?></a>
				<?php elseif ($_SESSION["user_role"] === "user") : ?>
					<a class="navbar-item <?= ($_SESSION["title"] == PRICE_CHANGE) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/user/price_change.php' ?>"><?= PRICE_CHANGE ?></a>
					<a class="navbar-item <?= ($_SESSION["title"] == AVAILABILITY) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/user/availability.php' ?>"><?= AVAILABILITY ?></a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="navbar-end">
			<div class="navbar-item">
				<div class="field is-grouped">
					<p class="control">
						<?php if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) : ?>
							<div class="navbar-item">
								<span><?= $_SESSION["user_name"] ?></span>様
							</div>
							<a class="button is-primary" href="<?= PUBLIC_TOP . '/api/logout.php' ?>">
								<span><?= LOGOUT ?></span>
							</a>
						<?php else : ?>
							<a class="button is-primary" href="<?= PUBLIC_TOP . '/login.php' ?>">
								<span><?= LOGIN ?></span>
							</a>
						<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</nav>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
		if ($navbarBurgers.length > 0) {
			$navbarBurgers.forEach(el => {
				el.addEventListener('click', () => {
					const target = document.getElementById(el.dataset.target);
					el.classList.toggle('is-active');
					target.classList.toggle('is-active');
				});
			});
		}
	});
</script>

<?php if (gethostname() == "s1008.xrea.com") : ?>
	<div align="center">
		<!--nobanner-->
		<script type="text/javascript" src="https://cache1.value-domain.com/xa.j?site=sweetyhotel.s1008.xrea.com"></script>
	</div>
<?php endif; ?>

<?php include_once PUB_PATH . '/parts/notice.php'; ?>