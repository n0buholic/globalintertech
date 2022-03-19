<nav id="sidebar" class="sidebar">
	<a class="sidebar-brand" href="<?= base_url("backend") ?>">
		GIT Backend
	</a>
	<div class="sidebar-content">
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
				Katalog
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/catalogue") ?>">
					<i class="align-middle me-2 fas fa-fw fa-box"></i> <span class="align-middle">Katalog</span>
				</a>
			</li>
			<li class="sidebar-header">
				Landing
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("backend/promo") ?>">
					<i class="align-middle me-2 fas fa-fw fa-tag"></i> <span class="align-middle">Promo Landing</span>
				</a>
			</li>
		</ul>
	</div>
</nav>