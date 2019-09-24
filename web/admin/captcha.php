<?php
session_start();
$captcha = new Captcha();
$captcha->show();

class Captcha
{
	private $num;
	private $img_width;
	private $img_height;
	private $img;
	private $flag_line;
	private $flag_point;
	private $code;
	private $string;
	private $font;
	private $purpose; // the code use for what

	function __construct($num = 4, $img_height = 50, $img_width = 150, $fontsize = 20, $flag_line = True, $flag_point = True , $purpose = 'register')
	{
		$this->string = 'abcdefghijkmnpqrstuvwxyz1234567890';
		$this->num = $num;
		$this->img_height = $img_height;
		$this->img_width = $img_width;
		$this->flag_line = $flag_line;
		$this->flag_point = $flag_point;
		$this->font = dirname(__FILE__).'/../public/fonts/consola.ttf';
		$this->fontsize = $fontsize;
		$this->purpose = $purpose;
	}

	public function createImage()
	{
		$this->img = imagecreate($this->img_width, $this->img_height);
		imagecolorallocate($this->img, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
	}

	public function createCode()
	{
		$strlen = strlen($this->string) - 1;
		for ($i=0; $i < $this->num; $i++)
		{
			$this->code .= $this->string[mt_rand(0, $strlen)];
		}

		$margen = $this->img_width / $this->num; // jian ju
		for ($j=0; $j < $this->num; $j++) 
		{
			$txtColor = imagecolorallocate($this->img, mt_rand(100, 255), mt_rand(100, 255), mt_rand(100, 255));
			imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $margen * $j + mt_rand(3, 8), mt_rand(20, $this->img_height - 10), $txtColor, $this->font, $this->code[$j]);
		}
	}

	public function createLines()
	{
		for ($i=0; $i < 4; $i++) 
		{
			$color = imagecolorallocate($this->img, mt_rand(0, 155), mt_rand(0, 155), mt_rand(0, 155));
			imageline($this->img, mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), $color);
		}
	}

	public function createPoint()
	{
		for ($i=0; $i < 100; $i++) 
		{
			$color = imagecolorallocate($this->img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
			imagesetpixel($this->img, mt_rand(0, $this->img_width), mt_rand(0, $this->img_height), $color);
		}
	}

	public function show()
	{
		$this->createImage();
		$this->createCode();
		if($this->flag_line)
		{
			$this->createLines();
		}
		if($this->flag_point)
		{
			$this->createPoint();
		}
		$_SESSION[$this->purpose.'_code'] = $this->code;
		header('Content-type:image/png');
		imagepng($this->img);
		imagedestroy($this->img);
	}

	public function getCode()
	{
		return $this->code;
	}
}

