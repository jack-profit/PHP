<?php
session_start();
if(isset($_SESSION['user']))
{
	header('location:/web/index.php');
	exit();
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
				<p class="lead">Hello hello hello.</p>
			</div>
			<!-- register -->
			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="register" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Register</h4>
						</div>
						<form action="/web/admin/register.php" method="post" accept-charset="utf-8" class="form-horizontal">
							<div class="modal-body">
								<div class="form-group">
									<label for="username" class="col-sm-4 control-label">Name:</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="username" id="username" minlength="2" maxlength="20" placeholder="username" required="">
									</div>
									<!-- ?????? -->
									<h6 style="color: red;" id="dis_un"></h6>
								</div>

								<div class="form-group">
									<label for="email" class="col-sm-4 control-label">Email:</label>
									<div class="col-sm-6">
										<input type="email" class="form-control" name="email" id="remail" placeholder="Email" required="">
									</div>
									<!-- ?????? -->
									<h6 style="color: red;" id="dis_em"></h6>
								</div>

								<div class="form-group">
									<label for="password" class="col-sm-4 control-label">Password:</label>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="password" id="password" placeholder="password" minlength="6" maxlength="20" required="">
									</div>
									<!-- ?????? -->
									<h6 style="color: red;" id="dis_pwd"></h6>
								</div>

								<div class="form-group">
									<label for="confirm" class="col-sm-4 control-label">Confirm password:</label>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="confirm" id="confirm" placeholder="confirm" minlength="6" maxlength="20" required="">
									</div>
									<!-- ?????? -->
									<h6 style="color: red;" id="dis_con_pwd"></h6>
								</div>

								<div class="form-group">
									<label for="code" class="col-sm-4 control-label"> verification code :</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="code" id="code" placeholder="verification code" required="" maxlength="4" size="100">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" style="text-align: center;">
										<img src="/web/admin/captcha.php" alt="" id="codeimg" onclick="javascript:this.src='/web/admin/captcha.php?'+Math.random();">
										<a href="#" title="Switch">Click to Switch</a>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Close</button>
								<input type='hidden' name='type' value='all'>
								<input type="reset" class="btn btn-warning" value ="reset" />
								<button type="submit" class="btn btn-primary" id="reg">register</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- / register -->

			<!-- login -->
			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="login" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Login</h4>
						</div>
						<form action="/web/admin/login.php" method="post" accept-charset="utf-8" class="form-horizontal">
							<div class="modal-body">
								<div class="form-group">
									<label for="email" class="col-sm-4 control-label">Email:</label>
									<div class="col-sm-6">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="col-sm-4 control-label">Password:</label>
									<div class="col-sm-6">
										<input type="password" class="form-control" name="password" placeholder="password" minlength="6" maxlength="20" required="">
									</div>
								</div>

								<!-- <div class="form-group">
									<label for="code" class="col-sm-4 control-label"> verification code :</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="code" id="code" placeholder="verification code" required="" maxlength="4">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" style="text-align:center">
										<img src="#" alt="" id="codeimg">
										<span>Click to Switch</span>
									</div>
								</div> -->

								<div class="form-group">
									<label for="password" class="col-sm-4 control-label"> remember me </label>
									<div class="col-sm-3">
										<label class="checkbox-inline">
											<input type='radio' name='rem' id='yes' value='1' checked> Yes
										</label>
										<label class="checkbox-inline">
											<input type='radio' name='rem' id='no' value='1' checked> No
										</label>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Close</button>
								<input type="reset" class="btn btn-warning" value ="reset" />
								<button type="submit" class="btn btn-primary" name="login">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div><!-- / register -->
		</div>
	</div><!-- / container -->

	<?php require_once 'public/layouts/footer.php' ?>

	<!-- Bootstrap core JavaScript ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>