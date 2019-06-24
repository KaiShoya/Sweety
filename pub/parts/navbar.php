<nav class="navbar is-dark">
	<div id="navbarExampleTransparentExample" class="navbar-brand">
		<div class="navbar-item">Sweety</div>
		<a class="navbar-item <?= ($_SESSION["title"] == PRICE_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/price_list.php' ?>"><?= PRICE_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == HOTEL_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/hotel_list.php' ?>"><?= HOTEL_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == TOS) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/tos.php' ?>"><?= TOS ?></a>

	<div class="navbar-end">
		<div class="navbar-item">
			<div class="field is-grouped">
				<p class="control">
					<?php if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])): ?>
						<div>
							<span><?= $_SESSION["user_name"] ?></span>様
						</div>
						<a class="button is-primary" href="<?= PUBLIC_TOP . '/api/logout.php' ?>">
							<span><?= LOGOUT ?></span>
						</a>
					<?php else: ?>
						<a class="button is-primary" href="<?= PUBLIC_TOP . '/login.php'?>">
							<span><?= LOGIN ?></span>
						</a>
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
</nav>
