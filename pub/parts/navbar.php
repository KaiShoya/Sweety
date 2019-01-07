<nav class="navbar is-dark">
	<div id="navbarExampleTransparentExample" class="navbar-menu">
		<div class="navbar-brand">
			<a class="navbar-item">ホテル一覧</a>
		</div>
		<div class="navbar-start">
		<!-- <a class="navbar-item <?= ($_SESSION["title"] == INDEX) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/index.php' ?>"><?= INDEX ?></a> -->
		<a class="navbar-item <?= ($_SESSION["title"] == HOTEL_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/hotel_list.php' ?>"><?= HOTEL_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == PRICE_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/price_list.php' ?>"><?= PRICE_LIST ?></a>
		</div>
	</div>
</nav>
