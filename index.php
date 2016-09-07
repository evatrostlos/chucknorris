<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chuck Norris</title>
</head>
<link rel="stylesheet" href="styles/styles.css">
<body>
<?php
if(!empty($_SESSION['emails'])) {
	function sortList(){
		$emails = $_SESSION['emails'];
		usort($emails, function($a, $b){
			preg_match_all("/(.*)@(.*)\./", $a, $m1);
			preg_match_all("/(.*)@(.*)\./", $b, $m2);

			if(($cmp = strcmp($m1[2][0], $m2[2][0])) == 0) {
				return strcmp($m1[1][0], $m2[1][0]);
			} else {
				return ($cmp < 0 ? -1 : 1);
			}
		});
		$_SESSION['emails_sorted'] = $emails;
	}
	sortList();
require("logic/success.php");
} else {
?>
<h1>Chuck Norris Random Jokes</h1>
	<form action="" method="post" class="form">   
		<label for="emails">Enter email addresses (seperate with ',' )</label><br>
		<input type="text" name="email" class="email">
		<br> 
		<div class="block">
			<input type="submit" value="push me" class="btn">	
		</div>
		<ul class="errors"></ul>
	</form>
<?php
}
?>	
<script src="scripts/jquery.js"></script>	
<script src="scripts/scripts.js"></script>	
</body>
</html>