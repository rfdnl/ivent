<?php
	class Util{
		
		// show alert box and direct to another page
		static function alert($msg, $url){
			echo '<script type="text/javascript">
					alert("' . $msg . '");
					window.location.href = "' . $url . '";
				</script>';
		}
		
		// direct user to another page
		static function redirect($url){
			header('Location: ' . $url);
		}
	}
?>
