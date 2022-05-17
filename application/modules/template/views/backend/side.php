<nav id="sidebar" class="sidebar">
	<a class="sidebar-brand" href="<?= base_url("backend") ?>">
		GIT Backend
	</a>
	<div class="sidebar-content">
		<div class="sidebar-user">
			<img src="<?= base_url("assets/backend/images/no-photo.png") ?>" class="img-fluid rounded-circle mb-2" alt="<?= $myInfo->name ?>">
			<div class="fw-bold"><?= $myInfo->name ?></div>
		</div>
		<ul class="sidebar-nav mt-2">
			<li class="sidebar-header">
				Main
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/dashboard") ?>">
					<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>
			<li class="sidebar-header">
				Katalog & Pesanan
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/catalogue") ?>">
					<i class="align-middle me-2 fas fa-fw fa-box"></i> <span class="align-middle">Katalog</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/order") ?>">
					<i class="align-middle me-2 fas fa-fw fa-shopping-bag"></i> <span class="align-middle">Pesanan</span>
					<span class="sidebar-badge badge rounded-pill bg-danger"><?= $available_order ?></span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/sales-quote") ?>">
					<i class="align-middle me-2 fas fa-fw fa-scroll"></i> <span class="align-middle">Sales Quote</span>
				</a>
			</li>
			<!--
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/sort-catalogue") ?>">
					<i class="align-middle me-2 fas fa-fw fa-box"></i> <span class="align-middle">Urut Katalog</span>
				</a>
			</li>
			-->
			<li class="sidebar-header">
				Landing
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/promo") ?>">
					<i class="align-middle me-2 fas fa-fw fa-tag"></i> <span class="align-middle">List Promo</span>
				</a>
			</li>
		</ul>
	</div>
</nav>