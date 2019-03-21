<?php
function dwUpload($file,$path="./img-sentmasage/"){
	if(@copy($file['tmp_name'],$path.$file['name'])){
		@chmod($pash.$file,0777);
		return $file['name'];
	}else{
		return false;
	}
	}


?>