<?php

	$session = new Session;
	$session->requirePrivilege('File Manager', true);
	if(request('filename',false)){
		$filename = request('filename');

		$filepath = DOCUMENT_ROOT.'/res/uploads/media/'.$filename;
		$debug = array(print_r($_POST,true),$filepath);
		if(file_exists(DOCUMENT_ROOT.'/res/uploads/media/'.$filename)){
			$debug[] = 'we got here';
			$sql = 'INSERT INTO media_library (filename) VALUES ("'.Db::escape($filename).'")';
			$debug[] = $sql;
			Db::query($sql);
			if(Db::insert_id() != 0){
				echo json_encode(array('error' => 0));
				die();
			}
		}
	}

	echo json_encode(array('error' => 1, 'debug' => $debug));
