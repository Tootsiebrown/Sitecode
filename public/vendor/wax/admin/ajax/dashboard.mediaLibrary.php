<?php

use App\Wax\Admin\Cms\Cms;
use URL;
use Wax\Core\Contracts\ImageProcessorContract;


	/***
	 * INSTRUCTIONS
	 *
	 * To get total number of records to insert:
	 * thisfile.php?info=numRecords
	 *
	 * To get the total number of record as well as the page of the current
	 * thisfile.php?info=numRecords&per_page=5&filename=urlencoded
	 *
	 * To get a set of (htmo) options
	 * thisfile.php?info=options&offset=0&number=20
	 ***/

	$mediaLibrary = new Cms('media_library');
	$uploadPath = $mediaLibrary->field('filename')['path'].'/';
	$image_filter_params = 'WHERE LOWER(RIGHT(filename,4)) in (".jpg","jpeg",".gif",".png",".svg") ORDER BY id ASC';

	switch(request('info',false)){
		case 'numRecords':
			$number = $mediaLibrary->recordCount($image_filter_params);
			$ret_arr = array('numRecords' =>  $number);
			if(request('per_page',false) > 0 && request('filename',false)){
				$per_page = request('per_page');
				$filename = urldecode(request('filename'));
				$all_records = $mediaLibrary->getRecords($image_filter_params);
				$page_i = 1;
				$on_page_i = 1;
				$found_page = null;
				foreach($all_records as $record){
					if($on_page_i > $per_page){
						$page_i ++;
						$on_page_i = 1;
					}

					if($filename == $record['filename']){
						$found_page = $page_i;
						break;
					}

					$on_page_i ++;
				}
				$ret_arr['page'] = $found_page;
			}
			echo json_encode($ret_arr);
			break;

		case 'options':
			if(request('offset',false)===false || request('number',false)===false)
				die('Error: insufficient information');
			$images = $mediaLibrary->getRecords($image_filter_params,(int)request('offset'),(int)request('number'));
			$html = '';
			$html .= "<option value='' data-img-src=''></option>";
			foreach ($images as $image) {
				$image_rel_path = $uploadPath.$image['filename'];
				$image_abs_path = DOCUMENT_ROOT.$image_rel_path;
				$image_url = URL::to($image_rel_path);
				$imageProcessor = app()->make(ImageProcessorContract::class);
				$image_info = $imageProcessor->readImageProperties($image_abs_path);
				$thumb_url = $imageProcessor->getThumbnail($image_rel_path,190,0);
				$html .= "<option data-img-src=\"{$thumb_url}\" value=\"{$image_url}\">{$image_info[0]} x {$image_info[1]}</option>";
			}
			echo $html;
			break;

		default:
			die('Error: Please specify an accepted value for "info".');
	}
