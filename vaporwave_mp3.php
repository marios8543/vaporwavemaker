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
			$tmp = exec('sox.exe'.' '.'E:\wamp64\www\songs\\'.$song_id.'.mp3'.' '.'E:\wamp64\www\songs_final\\'.$song_id.'.mp3'.' '.'speed 0.8 reverb 80 50 100 100 0 0' );
			$errors = $tmp;
			echo "Success";
			$songexist_name = 'E:\wamp64\www\songs_final\\'.$song_id.'.mp3';
            $song_exists = file_exists($songexist_name);
			if($song_exists === true){
			$playpage_template = file_get_contents("players\\playpage_template.html");	
            $playpage = str_replace('SSONGIDD', $song_id, $playpage_template);
            file_put_contents("players\\".$song_id.'.html', $playpage);
			//The pinnacle of pajeet coding. Will fix some other time. Was supposed to give cross-vps support (?) but why the fuck even...
			$redir_link = '\players\\'.$song_id.'.html';
			header("Location:".' '.$redir_link);

		
            exit();
			}
			else{
					header("Location:/error.html");
			}
		}else{
				header("Location:/error.html");
				echo $errors;
		}
	}
?>
