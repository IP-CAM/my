<?php
class ControllerInformationGeoAd extends Controller {	
	public function index() {
		if (isset($this->request->get['id'])) {
			$geo_ad_id = $this->request->get['id'];
		} else {
			$geo_ad_id = '';
		}
		
		if ($geo_ad_id) {
			if (isset($this->request->cookie['geoAd']) && is_array($this->request->cookie['geoAd'])) {
				foreach ($this->request->cookie['geoAd'] as $key => $value) {
					setcookie('geoAd['.$key.']', '', (int)time() - (24 * 60 * 60 * 15));
				}
				
				setcookie('geoAd', '', (int)time() - (24 * 60 * 60 * 15));
			}
			
			$this->load->language('information/geo_ad');
			$this->load->model('localisation/geo_ad');
			$this->load->model('tool/image');

			$geoAd = $this->model_localisation_geo_ad->getGeoAd($geo_ad_id);
			
			$html = '';
			
			if ($geoAd) {
				$dot = '';
				$images = '';
				$row = 0;
				
				if ($geoAd['images']) {
					shuffle($geoAd['images']);
					foreach ($geoAd['images'][0]['geo_ad_image_description'] as $ad) {
						if ($row < 1) {
							$dot .= '<li class="thistitle"></li>';
						} else {
							$dot .= '<li></li>';
						}
						
						$images .= '<li>';
						
						if ($ad['image']) {
							$thumb = $this->model_tool_image->resize($ad['image'][$this->config->get('config_language_id')], $geoAd['width'], $geoAd['height']);
							
							$thumb = '<img src="'.$thumb.'" alt="'.$ad['title'][$this->config->get('config_language_id')].'" />';
						} else {
							$thumb = $ad['title'][$this->config->get('config_language_id')];
						}
						
						if ($ad['link'][$this->config->get('config_language_id')]) {
							$link = $this->url->link('information/geo_ad/redirect', 'id='.$ad['geo_ad_image_description_id'], 'SSL');
							$images .= '<a href="'.$link.'" title="'.$ad['title'][$this->config->get('config_language_id')].'">'.$thumb.'</a>';
						} else {
							$images .= $thumb;
						}
						
						$images .= '</li>';
						
						$row++;
					}
				} else {
					$dot .= '<li class="thistitle"></li>';
					$images .= '<li><img src="'.$geoAd['path'].'" /></li>';
				}
				
				$html .= '<link href="'.HTTP_SERVER.'goe/css.css" rel="stylesheet" type="text/css">';
				$html .= '<script src="'.HTTP_SERVER.'goe/goe.js" type="text/javascript"></script>';
				$html .= '<div id="playBox">';
				
				$html .= '<div class="pre"></div>';
				$html .= '<div class="next"></div>';
				if ($row > 1) {
				$html .= '<div class="smalltitle">';
				} else {
				$html .= '<div class="smalltitle" style="display:none;">';
				}
				$html .= '<ul>';
				$html .= $dot;
				$html .= '</ul>';
				$html .= '</div>';
				$html .= '<ul class="oUlplay">';
				$html .= $images;
				$html .= '</ul>';
				$html .= '</div>';
			}
				
			$js = '(function(){function l(){var html=\'' . $html . '\';document.write(html)};try{l()}catch(t){alert(t)}})();';
			
			$this->response->addHeader('Content-type: application/x-javascript');
			$this->response->setOutput($js);
		}
	}
	
	public function redirect() {
		if (isset($this->request->get['id'])) {
			$geo_ad_image_description_id = $this->request->get['id'];
		} else {
			$geo_ad_image_description_id = '';
		}
		
		if ($geo_ad_image_description_id) {
			$this->load->model('localisation/geo_ad');
	
			$geo_ad_image = $this->model_localisation_geo_ad->getGeoAdImageLink($geo_ad_image_description_id);
			
			if ($geo_ad_image) {
				$referer = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:0;
				
				setcookie('geoAd[geo_ad_id]', $geo_ad_image['geo_ad_id'], (int)time() + (24 * 60 * 60 * 15));
				setcookie('geoAd[name]', $geo_ad_image['name'], (int)time() + (24 * 60 * 60 * 15));
				setcookie('geoAd[title]', $geo_ad_image['title'][$this->config->get('config_language_id')], (int)time() + (24 * 60 * 60 * 15));
				setcookie('geoAd[url]', $referer, (int)time() + (24 * 60 * 60 * 15));
				
				$this->response->redirect($geo_ad_image['link']);
			}
		} else {
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}
	}
}