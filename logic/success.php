<div class="success">
<?php
if(!empty($_SESSION['emails_sorted'])) {
?>
	<h2>Jokes have been sent to:</h2>
	<?php
		$emails = $_SESSION['emails_sorted'];
		foreach ($emails as $email){
		?>
		<p><?php echo $email ?></p>
	<?php
		}	
}
?>
	<a href="logic/unset_session.php">
		<div class="btn btn-close">close</div>
	</a>
</div>