<?php
  session_start();
	if(!isset($_SESSION['islogin']))
	{
		header('location: login.php');
		exit();
	}
	
	include_once('database.php');
	$list = getAllRecords();
	
	$dress_id= '';	$dress_desc = '';	$success = false;
	
	if(isset($_GET['no']))
	{
		$dress_id = intval($_GET['no']);
		$record = getRecord($dress_id);
		if($record)
			$dress_desc = $record['dress_desc'];
			if(isset($_POST['yes']))
			{
				$success = deleteRecord($dress_id);
			}
	}
	
	if(isset($_POST['no']))
	{
		header('location: Recordlist.php');
		exit();
	}
?>
<html>
<head>
	<title>All Records</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jinji Gomez">
	<meta name="description" content="Home Page">
	
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
</head>
<body>
<?php include('header.php'); ?>
<div class="container">

	<h1>All Records</h1>
	<form method="post">
	
		<?php if (($success==true) && isset($_POST["yes"])) { ?>
			<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<h5>Record has been successfully deleted</h5></div> 
			<?php unset($success); } ?>
	
	<?php if($list) { ?>
	<table  class="table table-hover table-condensed"  style="word-wrap:break-word;">
		<thead>
		<tr>
			<th>#</th>
			<th >Description</th>
			<th>Category</th>
			<th>Price</th>
			<th>Qty</th>
			<th>Filename</th>
			<th>Active</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<?php foreach($list as $t) { ?>
		<tbody>
		<tr>
			<td><?php echo $t['dress_id']; ?></td>
			<td><?php echo htmlentities($t['dress_desc']); ?></td>
			<td><?php echo $t['category']; ?></td>
			<td><?php echo htmlentities($t['dress_price']); ?></td>
			<td><?php echo htmlentities($t['dress_qty']); ?></td>
			<td><?php echo $t['filename']; ?></td>
			<td><?php echo $t['active']; ?></td>
			<td>
				<a class="btn btn-success" href="editRecord.php?no=<?php echo $t['dress_id']; ?>"><i class="icon-pencil icon-large"></i>Edit</a>
				<a class="btn btn-danger" name="delete" href="#myModal?no=<?php echo $t['dress_id']; ?>"  role="button" class="btn" data-toggle="modal"><i class="icon-trash icon-large"></i>Delete</a>
			</td>
		</tr>
		<div id="myModal?no=<?php echo $t['dress_id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Delete Record?</h3>
			  </div>
			  <div class="modal-body">
				<p>You are about to delete <?php echo $dress_desc; ?> ?</p>
				<p>Do you want to proceed?</p>
			  </div>
			  <div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true" name="no" value="No">NO</button>
				<button href="Recordlist.php" class="btn btn-primary"name="yes" value="Yes">Yes</button>
			 </div>
		</div>
		
		<tbody>
		<?php } ?>
	</table>
	
	
	<?php } else { ?>
	<div>No Records created yet.</div>
	<?php } ?>
	
	</form>
	
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
</body>
</html>
