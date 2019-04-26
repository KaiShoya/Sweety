<nav class="navbar is-dark">
	<div id="navbarExampleTransparentExample" class="navbar-brand">
		<div class="navbar-item">Sweety</div>
		<a class="navbar-item <?= ($_SESSION["title"] == HOTEL_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/hotel_list.php' ?>"><?= HOTEL_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == PRICE_LIST) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/price_list.php' ?>"><?= PRICE_LIST ?></a>
		<a class="navbar-item <?= ($_SESSION["title"] == TOS) ? "is-active" : "" ; ?>" href="<?= PUBLIC_TOP.'/tos.php' ?>"><?= TOS ?></a>
	</div>
</nav>
