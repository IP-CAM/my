<?php
class ModelToolLanguage extends Model {
	public function getAL() {
		$language = '';
		
		if ($this->request->server['HTTP_ACCEPT_LANGUAGE']) {
			$language = explode(';', $this->request->server['HTTP_ACCEPT_LANGUAGE']);
			$language = $language[0];
			
			$this->log->write($language);
		}

		return $language;
	}
}