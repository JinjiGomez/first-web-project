
<head>
  	<link rel="stylesheet" href="css/bootstrap.css" />
	

		<link rel="stylesheet" href="css/font-awesome.css">
</head>
<div class="navbar navbar-inverse navbar-static-bottom">
	<div class="navbar-inner">
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span> </a>
			 
				<div class="nav-collapse collapse">
					<ul class="nav">
						<li>
							<a href="#" rel="tooltip" data-placement="top" title="Gothic" class="curtain-links">Gothic</a>
						</li>
						<li>
							<a href="#" rel="tooltip" data-placement="top" title="Princess"  class="curtain-links">Princess</a>
						</li>
						<li>
							<a href="#" rel="tooltip" data-placement="top" title="StemPunk" class="curtain-links">SteamPunk</a>
						</li>
						<li>
							<a href="#" rel="tooltip" data-placement="top" title="Sweet"  class="curtain-links">Sweet</a>
						</li>
					</ul>
					<ul class="nav pull-right">
					<li>
						<a href="#" rel="tooltip" data-placement="top" title="Back to top"  class="curtain-links">Back to top</a>
					</li>
					<li class="dropdown">
					  
						<?php
								if(isset($_SESSION['islogin']))
								{
									$user = $_SESSION['user'];
									$fullname = $user['firstname']; ?>
						<a class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><?php echo $fullname; }?>
						<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="addRecord.php"><i class="icon-upload-alt"></i> Add</a></li>
							<li><a href="Recordlist.php"><i class="icon-pencil"></i> Edit</a></li>
							<li><a href="Recordlist.php"><i class="icon-trash"></i> Delete</a></li>
							<li><a href="Recordlist.php"><i class="icon-th"></i> View All</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
						</ul>
						
					</li>
					</ul>
			</div>
		</div>
	</div>
</div>
		<script src="js/jquery.js"></script>
		<script src="js/curtain.js"></script>
		<script src="js/bootstrap.js"</script>
		<script src="js/bootstrap-affix.js"</script>
		<script src="js/bootstrap-alert.js"</script>
		<script src="js/bootstrap-button.js"</script>
		<script src="js/bootstrap-carousel.js"</script>
		<script src="js/bootstrap-collapse.js"</script>
		<script src="js/bootstrap-dropdown.js"</script>
		<script src="js/bootstrap-modal.js"</script>
		<script src="js/bootstrap-popover.js"</script>
		<script src="js/bootstrap-scrollspy.js"</script>
		<script src="js/bootstrap-tab.js"</script>
		<script src="js/bootstrap-tooltip.js"</script>
		<script src="js/bootstrap-transition.js"</script>
		<script src="js/bootstrap-typeahead.js"</script>
