<?php  
	session_start();
	if(!isset($_SESSION['islogin']))
	{
		header('location: login.php');
		exit();
	}
	
	include_once('database.php');
	
	$errmessage = array(); $dress_desc = ''; $category=''; 
	$dress_price = '';$dress_qty = '';$active = '';$filename='';
	
	
	if(isset($_POST['submit']))
	{
		if (!isset($_POST['dress_desc']) || ($_POST['dress_desc'] === ''))
			$errmessage[] = "Dress name is required.";
		else 
			$dress_desc = trim($_POST['dress_desc']);

		if (!isset($_POST['category']) || ($_POST['category'] === ''))
			$errmessage[] = "Category is required.";
		else 
			$category = $_POST['category'];
			
		if (!isset($_POST['dress_price']) || ($_POST['dress_price'] === ''))
			$errmessage[] = "Dress Price is required.";
		else 
			$dress_price = trim($_POST['dress_price']);
		
		if (!isset($_POST['dress_qty']) || ($_POST['dress_qty'] === ''))
			$errmessage[] = "Dress Quantity is required.";
		else 
			$dress_qty = trim($_POST['dress_qty']);
		
		if (!isset($_POST['active']) || ($_POST['active'] === ''))
			$errmessage[] = "Active Button is required.";
		else 
			$active = $_POST['active'];
		
		if (!isset($_FILES) )
			$errmessage[] = "No image chosen.";
		else {
			$file1 = $_FILES['file1'];
			$source = $file1['tmp_name'];
			$filename = $file1['name'];
			$size = $file1['size'];
			$mime = $file1['type'];
		
			 $tmp = explode('.', $filename);
			$ext = array_pop($tmp);
			
			if(strtolower($ext) != 'jpg' || strtolower($ext) != 'jpeg')
				$errmessage[] = "Only .jpg or .jpeg files are allowed";
					
			}
		
		if ((!isset($errmessage) || count($errmessage) === 0) && isset($_POST['submit']) ){
			$message = addRecord($dress_desc, $category, $dress_price, $dress_qty, $filename, $active);
			$destination = 'img/dresses/'.$category.'/'. $filename;
			move_uploaded_file($source, $destination);
			$dress_desc = ''; $category=''; $filename = '';
	        $dress_price = '';$dress_qty = '';$active = '';}
		
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Record</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jinji Gomez">
	<meta name="description" content="Add Record Page">
	
	 <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	 <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">

			<?php if (count($errmessage) !== 0 && isset($_POST['submit'])) { ?>
			<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<ul>
				<?php foreach($errmessage as $error) { ?>
				<li><h6><?php echo $error; ?></h6></li> <?php } ?>
			</ul>
				<?php unset($errmessage); } ?>
			</div> 
			
			
			<?php if (isset($message) && isset($_POST["submit"])) { ?>
			<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
				<h5><?php echo $message; ?></h5></div> 
			<?php unset($message); } ?>
			
	<h1>Add Record</h1>
	<form method="post" class="form-horizontal" enctype="multipart/form-data">
	 <br/>
		<div class="control-group">
			<label class="control-label" for="inputName">Name</label>
			<div class="controls">
				<input type="text" id="inputName" placeholder="Name" name="dress_desc" value="<?php echo htmlentities($dress_desc);?>" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="cat">Category</label>
			<div class="controls">
				<select id ="cat" name="category">
					<option>Gothic</option>
					<option>Princess</option>
					<option>SteamPunk</option>
					<option>Sweet</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="price">Price</label>
			<div class="controls">
				<input type="text" id="price" placeholder="Price" name="dress_price" value="<?php echo htmlentities($dress_price);?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="qty">Quantity</label>
			<div class="controls">
				<input type="text" id="qty" placeholder="Quantity"name="dress_qty" value="<?php echo htmlentities($dress_qty);?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"  >Active</label>
			<div class="controls">
				<input type="radio"  name="active" value="true"> Yes</input>
				<input type="radio"  name="active" value="false"> No </input>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" >Upload</label>
			<div class="controls">
				<input type="file"  name="file1" />
				
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
		  <input type="submit" name="submit" value="Submit" class="btn btn-large btn-primary"/>
		  </div></div>
		 
	
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
