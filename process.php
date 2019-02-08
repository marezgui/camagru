<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
	        $errors = [];
	        $path = './public/images/filtre/';
		$extensions = ['png'];
			
	    $all_files = count($_FILES['files']['tmp_name']);
	    for ($i = 0; $i < $all_files; $i++) {
			$file_name = $_FILES['files']['name'][$i];
			$file_tmp = $_FILES['files']['tmp_name'][$i];
			$file_type = $_FILES['files']['type'][$i];
			$file_size = $_FILES['files']['size'][$i];
			$file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));
			$file = $path . $file_name;
			if (!in_array($file_ext, $extensions)) {
				$errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
			}
			if ($file_size > 2097152) {
				$errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
			}
			if (empty($errors)) {
				move_uploaded_file($file_tmp, $file);
			}
		}
		
			$dir = array_diff(scandir("public/images/filtre"), array('..', '.'));
			foreach ($dir as $key => $value) 
			{
				$filtre = explode('.', $value);
				echo "<li>";
				echo "<a>";
				echo "<img class='filtre' id='" . $filtre[0] . "' src='./public/images/filtre/". $value ."' alt>";
				echo "</a>";
				echo "</li>";	
			}
	}		
}