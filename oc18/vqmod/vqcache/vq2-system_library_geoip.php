<?php
require_once(VQMod::modCheck(modification(DIR_SYSTEM . 'library/geo/reader.php'), DIR_SYSTEM . 'library/geo/reader.php'));
require_once(VQMod::modCheck(modification(DIR_SYSTEM . 'library/geo/reader/decoder.php'), DIR_SYSTEM . 'library/geo/reader/decoder.php'));
require_once(VQMod::modCheck(modification(DIR_SYSTEM . 'library/geo/reader/invaliddatabaseexception.php'), DIR_SYSTEM . 'library/geo/reader/invaliddatabaseexception.php'));
require_once(VQMod::modCheck(modification(DIR_SYSTEM . 'library/geo/reader/metadata.php'), DIR_SYSTEM . 'library/geo/reader/metadata.php'));
require_once(VQMod::modCheck(modification(DIR_SYSTEM . 'library/geo/reader/util.php'), DIR_SYSTEM . 'library/geo/reader/util.php'));
use MaxMind\Db\reader;

class Geoip {
	public function get($ip, $language = 'en') {
		$filename = DIR_SYSTEM.'library/geo/database/geolite2-city.mmdb';
		
		$reader = new reader($filename);
		
		$data = $reader->get($ip);
		
		$reader->close();
		
		if (isset($data['country'])) {
			$data['country']['name'] = $data['country']['names'][$language];
			
			return $data['country'];
		} else {
			return false;
		}
	}
}
?>