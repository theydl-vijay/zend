<?php 

class Core_WC_FileUplode{
	public function FileUplode($image, $saveimg)
	{
		$image_main_file = $_FILES[$image]['name'];
		$image_temp_file = $_FILES[$image]['tmp_name'];
		$image_saveimg = $saveimg/.$image_main_file;
		move_uploaded_file($image_temp_file, $image_saveimg);.
	}
}



?>