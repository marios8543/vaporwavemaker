<center>
<font size="6"><font color="4afafc"><h1 style="background-color:#ff67f2">V A P O R W A V E  &nbsp;  M A K E R</h1></font>
<body background="watervap.jpg" bgproperties="fixed">
<?php

	if(isset($_FILES['song'])){
		$errors= array();
		$file_name = $_FILES['song']['name'];
		$file_size =$_FILES['song']['size'];
		$file_tmp =$_FILES['song']['tmp_name'];
		$file_type=$_FILES['song']['type'];
		$file_ext = end((explode(".",$file_name)));
		
		var_dump($_FILES['song']);
		$song_id = '';
        for ($i = 0; $i<10; $i++) 
        {
        $song_id .= mt_rand(0,9);
        }
		$expensions= array("mp3",); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose an mp3 file.";
		}
		if($file_size > 10485760){
		$errors[]='File size must not be larger than 10MB';
		}				
		if(empty($errors)==true){
			$song_name = $song_id.'.'.$file_ext;
			var_dump($song_name);
			move_uploaded_file($file_tmp,"songs/".$song_name);
			setcookie('song_id_str', $song_id);
			file_put_contents("songs_id/".$song_id.'.txt', $file_name);
			var_dump($file_ext);
			$item='example';
			$tmp = exec('sox.exe'.' '.'C:\wamp64\www\songs\\'.$song_id.'.mp3'.' '.'C:\wamp64\www\songs_final\\'.$song_id.'.mp3'.' '.'speed 0.8 reverb 80 50 100 100 0 0' );
			$errors = $tmp;
			$songexist_name = 'C:\wamp64\www\songs_final\\'.$song_id.'.mp3';
            $song_exists = file_exists($songexist_name);
			if($song_exists === true){
			$redir_link = '/player.php?songid='.$song_id;
			header("Location:".' '.$redir_link);

		
            exit();
			}
			else{
				echo $tmp;
				?>
				
                    <h2>Oops that didn't go as planned :/</h2>
<?php					
					echo $errors;
			}
		}else{
			?>
			    <h2>Oops that didn't go as planned :/</h2>
				<?php
				echo $errors;
				echo $tmp;
		}
	}
?>
