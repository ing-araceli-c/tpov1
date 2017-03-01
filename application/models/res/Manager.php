<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
| -------------------------------------------------------------------
| MANAGER-CLASS
| -------------------------------------------------------------------
| This class does following operations:
|
| 1. Get directory structure
| 2. Map array of directory in parent - children structure
| 3. Creates array of media: folder, images and other files
| 4. Short media names to show in thumbs 
| 5. Get image dimensions in ratios of 40*40 and 16*16
| 6. Get image size
| 7. Upload files to selected folder
| 8. Get media manager settings parameter
|
*/
class Manager extends CI_Model {
	public $img_width = '200';	

	// Get Folder tree structure in array form
	public function get_folder_tree()
	{
		$media_map = directory_map(MM_BASE);		
		$folder_map = $this->get_folder_map($media_map);		
doDebugD3D( 'M->' . basename( __FILE__, ".php" ) . '->> ' . 'Get Tree' );		
		if(isset($folder_map['children'])){
			return $folder_map['children'];	
		}
		
		return NULL;
	}	

	// Map folder array according to path level
	public function get_folder_map($media_arr, $path = null)
	{		
		$tree = array();
		
		if($path){	
			$tree['path'] = $path; 
			$path .= '/';
		}

if ($media_arr <> null ) {
		foreach($media_arr as $key => $value)
		{	
			if(is_array($value))
			{	
				if($key !== 'thumb')
				{
					$tree['children'][$key] = $this->get_folder_map($value,$path.$key);
				}					
			}			
		}		
} 

		return $tree;
	}	
	
	// Get media list
	public function get_media_list($path = NULL)
	{	
		if(!empty($path)){
			$path .= '/';
		}				

		$basepath = MM_BASE.$path;
		$media = directory_map(realpath($basepath)); // media path		
		
		$data = array();
		$folder = $image = $file = 0;
		$params = $this->get_params();		
			
		if(!empty($media))
		{
			foreach($media as $key => $value) {							
				if(is_array($value)) { // if folders			
					if($key !== 'thumb') {
						$data['folders'][$folder] = array(
							'name'	=>	$key,							
							'path'	=>	$path.$key
						);			
						$folder++;
					}					
				} else { // if files						
					if(strtolower($value) !== 'index.html')
					{							
						// Get file extension
                                                $trozos = explode(".", $value); 
                                                $extension = end($trozos); 
						$file_ext = strtolower($extension);
//						$file_ext = strtolower(end(explode('.', $value)));
						
						switch($file_ext)
						{
							// Images
							case 'jpg':
							case 'png':
							case 'gif':							
							case 'bmp':
							case 'jpeg':
							case 'ico':
								$img_url = $anchor_url = 'data/'.$this->session->userdata('media_path').'/'.$path.$value;													

								$info = @getimagesize(realpath($basepath.$value));
								
								// get image size in ratio of global variables $img_width * $img_width
								if (($info[0] > $this->img_width) || ($info[1] > $this->img_width))
								{
									$dimensions = $this->image_resize($info[0], $info[1], $this->img_width);
									$width_x = $dimensions[0];
									$height_x = $dimensions[1];
									$url = 'data/'.$this->session->userdata('media_path').'/'.$path.'thumb/'.$value;									
									if(file_exists(realpath($url))) {
										$img_url = $url;
									}

								}
								else {
									$width_x = @$info[0];
									$height_x = @$info[1];									
								}	

								// get image size in ratio of 16 * 16
								if (($info[0] > 16) || ($info[1] > 16))
								{
									$dimensions = $this->image_resize($info[0], $info[1], 16);
									$width_16 = $dimensions[0];
									$height_16 = $dimensions[1];
								}
								else {
									$width_16 = @$info[0];
									$height_16 = @$info[1];
								}						

								$data['images'][$image] = array(
										'name'		 => $value,										
										'path' 		 => $path.$value, // relative path of image or folder									
										'img_url'	 => $img_url, // image url
										'anchor_url' => $anchor_url,
										'size' 		 => $this->format_bytes(filesize(realpath($basepath.$value))), // file size
										'width' 	 => @$info[0], 
										'height' 	 => @$info[1],
										'width_x'  	 => $width_x,
										'height_x'   => $height_x,
										'width_16' 	 => $width_16,
										'height_16'  => $height_16
									);

								$image++;
								break;
							// Other files
							default: 
								// icon image files for file format other than images
								$icon_file = realpath(DIR_FMS . 'icons/mime-icon-16/'.$file_ext.'.png');

								if(!is_file($icon_file)){								
									if(($file_ext == 'html') || ($file_ext == 'htm')){ // if html file
										$file_ext = 'page';
									} else { // default icon image file, if not exists for file extension
										$file_ext = 'blank';
									}
								}

								$data['docs'][$file] = array(
										'name'	      =>	$value,										
										'path'		  =>	$path.$value,									
										'doc_url'	  =>	'data/'.$this->session->userdata('media_path').'/'.$path.$value,
										'icon_url-16' =>	'icons/mime-icon-16/'.$file_ext.'.png',
										'icon_url-32' =>	'icons/mime-icon-32/'.$file_ext.'.png',
										'size' 		  => 	$this->format_bytes(filesize(realpath($basepath.$value))) // file size
									);
								$file++;
						}
					}
				}
			}
		}		

		return $data;
	}	
	
	// Get image dimensions with specified size ratio 
	public function image_resize($width, $height, $size)
	{		
		if($width > $height){
			$percentage = ($size / $width);
		} else {
			$percentage = ($size / $height);
		}
		
		$width  = round($width * $percentage);
		$height = round($height * $percentage);
                
                $salida = array($width, $height);

		return $salida;
	}
	
	// Get file sizes
	function format_bytes($bytes)
    {
        if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' Bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' Byte';
        } else {
            $bytes = '0 Bytes';
        }

        return $bytes;
	}
	
	// Upload files
	public function upload_files($files)
	{		
		$basepath = MM_BASE;
		
		if($this->session->userdata('path')){
			$basepath .= $this->session->userdata('path').'/'; 
		}				

		// Get settings
		$params = $this->get_params();
		$allowed_types = explode(',',$params->allowed_types);
		$allowed_types = implode('|',$allowed_types);

		// Get configration		
		$config['upload_path'] = realpath($basepath);
		$config['allowed_types'] = $allowed_types;
		$config['overwrite'] = $params->overwrite;
		$config['max_size']	= $params->max_size * 1024;
		$config['max_width']  = $params->max_width;
		$config['max_height']  = $params->max_height;
		$config['max_filename']  = $params->max_filename;
		$config['encrypt_name']  = $params->encrypt_name;				
		$config['remove_spaces']  = $params->remove_spaces;
		$config = $this->crossBrowserHacks($config);
		
		$this->load->library('upload');
		
		$errors = array();
		$count = 0;
		$_FILES['filedata'] = '';
		
		// Upload files one by one
		foreach($files['name'] as $key => $file) 
		{	
			if($files['size'][$key]) 
			{
				$_FILES['filedata']['name'] = strip_tags($files['name'][$key]);
				$_FILES['filedata']['type'] = $files['type'][$key];
				$_FILES['filedata']['tmp_name'] = $files['tmp_name'][$key];
				$_FILES['filedata']['error'] = $files['error'][$key];
				$_FILES['filedata']['size'] = $files['size'][$key];										
				
				$this->upload->initialize($config);

				// Set errors message if files unable to upload
				if(!$this->upload->do_upload('filedata')) {										
					$errors[$key] = $this->upload->display_errors('<p><strong>'.$_FILES['filedata']['name'].': </strong>', '</p>');				
				} else {
					$return = $this->create_thumb($this->upload->data());
					if($return != TRUE){
						$errors[$key] = $return;
					}					
					$count++;			
				}
			} else {
				$errors[$key] = '<p><strong>'.$files['name'][$key].':</strong> file size set to 0.</p>';
			}												
		}		

		$data['errors'] = $errors;		

		$cn = (int) $this->input->post('count'); // check if file uploaded by dropzone
		if($cn) {			
			$upload_count = (int) $this->session->userdata('uploadcount');
			$count += $upload_count;
			$this->session->set_userdata('uploadcount',$count);

			$notifications = $this->session->userdata('notifications');
			if(isset($notifications['errors'])) {
				$data['errors'] = array_merge($data['errors'],$notifications['errors']);
			}
		}		

		// Success message for no. of files upload		
		if($count){
			$no_files = ($count > 1) ? 'files' : 'file';
			$client = $this->input->post('client');							
			$data['success'] = array('<p>'.$count.' '.$no_files.' uploaded successfully</p>');			
		}

		// Set notifications				
		$this->session->set_userdata('notifications',$data);	
		return TRUE;
	}

	// Create thumbnail for large images
	public function create_thumb($data)
	{
		if($data['is_image'])
		{			
    		if (($data['image_width'] > $this->img_width) || ($data['image_height'] > $this->img_width))
			{
				$dimensions = $this->image_resize($data['image_width'], $data['image_height'], $this->img_width);
				$width_x = $dimensions[0];
				$height_x = $dimensions[1];

				// Get configration
				$config['source_image'] = $data['full_path'];
				$config['new_image'] = $data['file_path'].'thumb/'.$data['file_name'];				
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $width_x;
				$config['height'] = $height_x;

				$this->load->library('image_lib');
				$this->image_lib->initialize($config); 				

				if(!$this->image_lib->resize()){
					$return = $this->image_lib->display_errors('<p><strong>'.$data['orig_name'].': </strong>', '</p>');
					return $return;
				}
			}
		}

		return TRUE;
	}

	public function crossBrowserHacks($config)
	{
		$client = $this->input->post('client');					
		$client = json_decode($client,true);
		$os = $client['os'];						
		$tmp = explode('.',$client['osVersion']);
		$osVersion = $tmp[0];
		$browser = $client['browser'];						
		$tmp = explode('.',$client['browserVersion']);
		$browserVersion = $tmp[0];
		$mobile = $client['mobile'];
		
		if(($os == 'iOS') && ($browser == 'Safari') && ($mobile == 1))
		{				
			$config['overwrite'] = 0; // possible bug of codeigniter
			$config['encrypt_name'] = 1;
		}
		
		return $config;
	}		

	// Get saved params
	public function get_params()
	{
		$params = json_decode(read_file(realpath(DIR_FMS . 'params.json')));		
		$default_params = json_decode(read_file(realpath(DIR_FMS . 'default.json')));	
		
		// Get default param if some params are null
		foreach($params as $key => $value){			
			if(is_null($params->$key)){
				$params->$key = $default_params->$key;
			}
		}
		
		return $params;
	}	
}

/* End of file manager.php */
/* Location: ./application/models/manager.php */
