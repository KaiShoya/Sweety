<nav class="navbar is-dark">
	<div id="navbarExampleTransparentExample" class="navbar-brand">
		<div class="navbar-item">Sweety</div>
		<a class="navbar-item <?= ($_SESSION["title"] == PRICE_LIST) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/price_list.php' ?>"><?= PRICE_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == HOTEL_LIST) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/hotel_list.php' ?>"><?= HOTEL_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == TOS) ? "is-active" : ""; ?>" href="<?= PUBLIC_TOP . '/tos.php' ?>"><?= TOS ?></a>
		<?php if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["user_role"])) : ?>
			<?php if ($_SESSION["user_role"] === "user") : ?>
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
						<div>
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
</nav>

<?php if (gethostname() == "s1008.xrea.com") : ?>
	<div align="center">
		<!--nobanner-->
		<script type="text/javascript" src="https://cache1.value-domain.com/xa.j?site=sweetyhotel.s1008.xrea.com"></script>
	</div>
<?php endif; ?>

<?php include_once PUB_PATH . '/parts/notice.php'; ?>