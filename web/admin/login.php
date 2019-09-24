<?php

class Login
{
	private $email;
	private $password;
	private $code;
	private $rem; // is remember me?

	function __construct()
	{
		if(!isset($_POST['login']))
		{
			echo "<script>alert('The page does not exist!');history.go(-1);</script>";
			exit();
		}
		require '../config.php';
		$this->email = trim($_POST['email']);
		$this->pwd = trim($_POST['password']);
		$this->code = trim($_POST['code']);
		$this->rem = trim($_POST['rem']);
	}

	public function checkCode()
	{
		if($this->code != $_SESSION['login_code'])
		{
			echo "<script>alert('Verification code incorrect');history.go(-1);</script>";
			exit();
		}
	}

	public function checkEmail()
	{
		$pattern = "/^([0-9a-zA-Z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if(!preg_match($pattern, $this->email))
		{
			echo "<script>alert('E-mail format incorrect');history.go(-1);</script>";
			exit();
		}
	}

	public function checkPwd()
	{
		$length = strlen(trim($this->pwd));
		if(trim($this->pwd) == '' || $length < 6 || $length > 20)
		{
			echo "<script>alert('Password format incorrect');history.go(-1);</script>";
			exit();
		}
		$this->pwd = md5($this->pwd);
	}

	public function checkUser()
	{
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('SQL connect error');
		$sql = 'SELECT username FROM users WHERE email="'.$this->email.'" AND password="'.$this->pwd.'"';
		$result = mysqli_fetch_row($db->query($sql))[0];
		if(!$result)
		{
			echo "<script>alert('E-mail or password is incorrect');history.go(-1);</script>";
			exit();
		}else{
			$_SESSION['user'] = $result;
			unset($_SESSION['login_code']);
			// remember me
			if($this->rem == 1)
			{
				$_SESSION['rem'] = 1;
			}
			$db->close();
			echo "<script>alert('Success!');location.href='/index.php';</script>";
			exit();
		}
	}

	public function doLogin()
	{
		// $this->checkCode();
		$this->checkEmail();
		$this->checkPwd();
		$this->checkUser();
	}
}

$login = new Login();
$login->doLogin();