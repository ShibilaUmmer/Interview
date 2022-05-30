<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">   
	<a href="#"><strong><span class="fa fa-dashboard"></span> My Dashboard</strong></a>
	<hr>		
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body bk-primary text-light">
							<div class="stat-panel text-center">
								<div class="stat-panel-number h1 "><?php echo $user->totalUsers(""); ?></div>
								<div class="stat-panel-title text-uppercase">Subscribers</div>
							</div>
						</div>											
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body bk-success text-light">
							<div class="stat-panel text-center">
								<div class="stat-panel-number h1 "><?php echo $user->totalUsers('active'); ?></div>
								<div class="stat-panel-title text-uppercase">Total Active Subscribers</div>
							</div>
						</div>											
					</div>
				</div>		
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body bk-success text-light">
							<div class="stat-panel text-center">
								<div class="stat-panel-number h1 "><?php echo $user->totalUsers('pending'); ?></div>
								<div class="stat-panel-title text-uppercase">Total Pending Subscribers</div>
							</div>
						</div>											
					</div>
				</div>																				
			</div>
		</div>
	</div>		
</div>