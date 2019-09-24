<?php 
session_start();
if(!isset($_SESSION['user']))
{
	if(isset($_COOKIE['user']))
	{
		$_SESSION['user'] = $_COOKIE['user'];
	}else{
		header('location:welcome.php');
		exit();	
	}
}
if(isset($_SESSION['rem']))
{
	setcookie('user', $_SESSION['user'], time()+3600);
	unset($_SESSION['rem']);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

	<?php require_once 'public/layouts/header.php' ?>

<body>

	<?php require_once 'public/layouts/nav.php' ?>

	<div class="container">
		<div class="content">
			<div class="starter-template">
				<h1>Welcome</h1>
				<div class="jumbotron">
					<h1>Hello,<?php echo $_SESSION['user']; ?></h1>
					<p>asdfjkl</p>
					<p>
						<a class="btn btn-primary btn-lg" href='#' role='button'>See something</a>
					</p>
				</div>
				<p class="lead">Hello hello hello.</p>
			</div>
			
		</div>
	</div><!-- / container -->

	<?php require_once 'public/layouts/footer.php' ?>

	<!-- Bootstrap core JavaScript ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>