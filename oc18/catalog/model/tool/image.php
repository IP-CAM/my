<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height) {
		if (strstr($filename, 'http://')) {
			$filename = str_replace('http://', '', $filename);
			
			return $this->http($filename, $width, $height);
		}
		
		if (!is_file(DIR_IMAGE . $filename)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$old_image = $filename;
		$new_image = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

		if (!is_file(DIR_IMAGE . $new_image) || (filectime(DIR_IMAGE . $old_image) > filectime(DIR_IMAGE . $new_image))) {
			$path = '';

			$directories = explode('/', dirname(str_replace('../', '', $new_image)));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			list($width_orig, $height_orig) = getimagesize(DIR_IMAGE . $old_image);

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $old_image);
				$image->resize($width, $height);
				$image->save(DIR_IMAGE . $new_image);
			} else {
				copy(DIR_IMAGE . $old_image, DIR_IMAGE . $new_image);
			}
		}

		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $new_image;
		} else {
			return $this->config->get('config_url') . 'image/' . $new_image;
		}
	}
	
	public function http($path, $width, $height) {
		$param = array(
			'path'  => $path,
			'width' => $width,
			'height'=> $height
		);
		
		// 动态链接
		//$host = DIR_IMAGEHOST.http_build_query($param, 1);
		
		// 伪静态链接
		$host = DIR_IMAGEHOST.$width.'x'.$height.'/item/'.$path;
		
		// 直链
		//$host = DIR_IMAGEHOST.$path;
		
		return $host;
	}
}