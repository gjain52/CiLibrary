<!DOCTYPE html>
<html>
	<head>
		<title>Central Library</title>
		<link rel="stylesheet" href="asset/library.css">
	</head>
	<body>
		<input id="base_url" value="<?php echo base_url(); ?>" hidden>
		<fieldset>
			<legend style="background:#ffff">
				<h2>&#128218; Central Library</h2>
			</legend>
			<div class="filter">
				<input type="checkbox" value="0"/><span>Show Available Only</span>
			</div>
			<div>
				<div class="response"></div>
				<div id="book_list">
					<?php include('libraryBookDeatils.php'); ?>
				</div>
		</fieldset>
	</body>
</html>