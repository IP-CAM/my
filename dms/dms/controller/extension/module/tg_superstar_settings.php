<?php

class ControllerExtensionModuleTgsuperstarSettings extends Controller {
	
	private $error = array(); 
	
	public function index() {   
	
		//Load the language file for this module
		$this->language->load('extension/module/tg_superstar_settings');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle('TG superstar Settings');
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		$config_data = array(
			'max_width',
			'add_to_compare_text',
			'add_to_wishlist_text',
			'add_to_cart_text',
			'mycart_text',
			'more_details_text',
			'category_text',
			'search_text',
			'sale_text',
			'welcome_text',
			'clfixed_text',
			'menu_text',
			'hotline_text',
			'hotdeal_text',
			'confirmation_text',
			'continue_shopping_text',
			'checkout_text',
			'product_per_pow',
			'product_per_pow2',
			'product_scroll_latest',
			'product_scroll_featured_category',
			'product_scroll_featured',
			'product_scroll_bestsellers',
			'product_scroll_specials',
			'product_scroll_related',
			'display_text_sale',
			'type_sale',
			'display_rating',
			'display_add_to_compare',
			'display_add_to_wishlist',
			'display_add_to_cart',
			'quick_view',
			'category_page_display_quickview',
			'category_page_display_add_to_wishlist',
			'category_page_display_add_to_compare',
			'category_page_display_rating',
			'category_page_display_add_to_cart',
			'default_list_grid',
			'refine_search_style',
			'refine_image_width',
			'refine_image_height',
			'refine_search_number',
			'product_image_zoom',
			'position_image_additional',
			'product_social_share',	
			'colors_status',
			'primary_color',
			'product_scroll_latest',
			'product_scroll_featured',
			'product_scroll_bestsellers',
			'product_scroll_specials',
			'product_scroll_related',	
			'custom_code_css_status',
			'custom_code_css',
			'custom_code_javascript_status',
			'custom_code_js',
			'refine_image_width',
			'refine_image_height',
			'payment_status',
			'social_status',
			'payment',
			'widget_facebook_status',
			'widget_facebook_id',
			'widget_facebook_position',
			'widget_twitter_status',
			'widget_twitter_id',
			'widget_twitter_user_name',
			'widget_twitter_position',
			'widget_twitter_limit',
			'widget_custom_status',
			'widget_custom_content',
			'widget_custom_position',
			'custom_footer1_status',
			'custom_footer1_content',
			'custom_footer2_status',
			'custom_footer2_content',
			'compressor_code_status'
		);
		
		foreach ($config_data as $conf) {
			$data[$conf] = false;
		}

		function removeDir($path) { 
			$dir = new DirectoryIterator($path); 
			foreach ($dir as $fileinfo) { 
				if ($fileinfo->isFile() || $fileinfo->isLink()) { 
					unlink($fileinfo->getPathName()); 
				} elseif (!$fileinfo->isDot() && $fileinfo->isDir()) { 
					removeDir($fileinfo->getPathName()); 
				} 
			} 
			rmdir($path); 
		}
		
  		// superstar MUTLI STORE
  		
			if (isset($this->request->post['store_id'])) {
				$data['store_id'] = $this->request->post['store_id'];
			} else {
				$data['store_id'] = $this->config->get('d_store_id');
			}

			$data['stores'] = array();
			
			$this->load->model('setting/store');
			
			$results = $this->model_setting_store->getStores();
			
			$data['stores'][] = array(
				'name' => 'Default',
				'href' => '',
				'store_id' => 0
			);
				
			foreach ($results as $result) {
				$data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url'],
					'store_id' => $result['store_id']
				);
			}		
			
			
			if(isset($_GET['store_id'])) {
				$data['store_id'] = $_GET['store_id'];
			} else {
				if (isset($_GET['submit'])) {
					$data['store_id'] = $data['store_id'];
				} else {
					if (isset($this->request->post['store_id'])) {
						$data['store_id'] = $this->request->post['store_id'];
					} else {
						$data['store_id'] = 0;
					}
				}
			}
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				$data['array'] = array(
					'd_store_id' => $this->request->post['store_id']
				);
				$this->model_setting_setting->editSetting('d_id_store', $data['array']);	
			}
			
		// END MULTISTORE
		
		$data['setting_skin'] = $this->model_setting_setting->getSetting('superstar_skin', $data['store_id']);
		
		if($data['store_id'] == 0) {
			$data['edit_skin_store'] = 'default';
		} else {
			$data['edit_skin_store'] = $data['store_id'];
		}

		if(isset($data['setting_skin']['superstar_skin'])) {
			$data['active_skin'] = $data['setting_skin']['superstar_skin'];
		} else {
			$data['active_skin'] = 'default';
		}
		
		if(!file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin'].'')) {
			$data['active_skin'] = false;
		}

		if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/')) {
			$data['skins'] = array();
			$dir = opendir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/');
			while(false !== ($file = readdir($dir))) {
				if(is_dir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$file) && $file != '.' && $file != '..')  {
					$data['skins'][] = $file;
				}
			}
		}

		if(isset($data['setting_skin']['superstar_skin'])) {
			$data['active_skin_edit'] = $data['setting_skin']['superstar_skin'];
		} else {
			$data['active_skin_edit'] = 'default';
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-edit']) || isset($_POST['button-delete'])){
				$data['active_skin_edit'] = $this->request->post['skin'];
			}
		}
		
		if(isset($this->request->post['save_skin']) && !isset($_POST['button-edit']) && !isset($_POST['button-delete'])) {
			$data['active_skin_edit'] = $this->request->post['save_skin'];
		}
		
		if(isset($_GET['skin_edit'])) {
			$data['active_skin_edit'] = $_GET['skin_edit'];
		}
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-active'])){
				$save_superstar_skin = array(
					'superstar_skin' => $this->request->post['skin']
				);
				$this->model_setting_setting->editSetting('superstar_skin', $save_superstar_skin, $this->request->post['store_id']);	
				$this->session->data['success'] = $this->language->get('text_success');
	            $this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
            }
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['add-skin'])){
				if(is_writable(DIR_CATALOG . 'view/theme/superstar/skins/') && (is_writable(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') || !file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'))) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') == 'dir') {
					} else {
						mkdir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/', 0777);
					}
					
			
					if($this->request->post['add-skin-name'] != '') {	
						if(!file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/')) {
							mkdir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/settings.json', json_encode($config_data));
							mkdir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/js/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/js/custom_code.js', ' ');
							mkdir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/css/', 0777);
							file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$this->request->post['add-skin-name'].'/css/custom_code.css', ' ');
							$this->session->data['success'] = $this->language->get('text_success');
							$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
						}
					}  
				}

				$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/superstar/skins!';
		        $this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
		    }
		}
		
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-save'])){
				if(is_writable(DIR_CATALOG . 'view/theme/superstar/skins') && is_writable(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store']) && is_writable(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'])) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') == 'dir' && file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'')) {
						
						file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json', json_encode($this->request->post));  
						
						// Custom js
						file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js', $this->request->post['custom_code_js']);  
						
						// Custom css
						file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css', $this->request->post['custom_code_css']);  
						file_put_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css',str_replace("&gt;", ">", $this->request->post['custom_code_css'])) ; 

						$this->session->data['success'] = $this->language->get('text_success');
						$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true&skin_edit=' . $data['active_skin_edit'] . '', 'token=' . $this->session->data['token'], true));
					}
				}
				
				$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/superstar/skins!';
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
			}
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if(isset($_POST['button-delete'])){
				if(is_writable(DIR_CATALOG . 'view/theme/superstar/skins')) {
				
					if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') && filetype(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/') == 'dir' && file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'')) {
						
						if($data['active_skin_edit'] != $data['active_skin']) {
							removeDir(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'');
							
							$this->session->data['success'] = $this->language->get('text_success');
							$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));		
						}
					}
				} else {
					$this->session->data['error_warning'] = 'You need to set CHMOD 777 for all folder and subfolder in catalog/view/theme/superstar/skins!';
					$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
				}
				
				$this->session->data['error_warning'] = $this->language->get('text_warning2');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings&submit=true', 'token=' . $this->session->data['token'], true));
			}
		}
		
		if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json')) {
			$template = json_decode(file_get_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/settings.json'), true);
			if(isset($template)) {
				foreach ($template as $option => $value) { 
					if($option != 'store_id') {
						$data[$option] = $value;
					}
				}
			}
		}
				
		if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js')) {
			$data['custom_code_js'] = file_get_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/js/custom_code.js');
		}
		
		if(file_exists(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css')) {
			$data['custom_code_css'] = file_get_contents(DIR_CATALOG . 'view/theme/superstar/skins/store_'.$data['edit_skin_store'].'/'.$data['active_skin_edit'].'/css/custom_code.css');
		}
		
		$data['text_image_manager'] = 'Image manager';
		$data['token'] = $this->session->data['token'];		
		
		$text_strings = array('heading_title');
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {	
			// All Modules
			
			if(isset($_POST['install_tg_superstar_all_module'])){
			
				$output = array();
				$output["tg_superstar_revolution_slider_module"] = array (
				  0 => 
				  array (
				    'slider_id' => '1',
				    'layout_id' => '1',
				    'position' => 'slideshow',
				    'sort_order' => '',
				    'status' => '1',
				  ),
				); 
				$this->model_setting_setting->editSetting( "tg_superstar_revolution_slider", $output );	
				
				include '../data_sample/superstar/tg_superstar_revolution_slider_query.php'; 
				
				// All Modules Megamenu 
				
				$output = array();
				$output["tg_superstar_megamenu_module"] = array (
				  0 => 
				  array (
				    'layout_id' => '99999',
				    'position' => 'menu',
				    'status' => '1',
				    'sort_order' => 0,
				    'animation' => 'none',
				    'animation_time' => 300,
				  ),
				); 
				$this->model_setting_setting->editSetting( "tg_superstar_megamenu", $output );	
				
				include '../data_sample/superstar/tg_superstar_megamenu_query.php'; 
				
				// All Modules News & Blog  
				
				$this->model_setting_setting->deleteSetting( "ncategory");
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = 15;
						");	
				
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout` (`layout_id`, `name`) VALUES
							(15, 'Blogs');
							");		
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = 15;
						");		
				
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
							(NULL, 15, 0, 'news/ncategory');
							");		
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'ncategory';
						");					
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 15, 'ncategory', 'column_left', 0);
							");
								
				
				include '../data_sample/superstar/tg_superstar_news_blog.php'; 
				
				// All Modules HTML CONTENT
						$this->model_setting_setting->deleteSetting( "special");
					$this->model_setting_setting->deleteSetting( "html");	
					$this->model_setting_setting->deleteSetting( "category");
					$this->model_setting_setting->deleteSetting( "information");
					
					// HTML CONTENT
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code IN ('html.30', 'html.31', 'html.32', 'html.33', 'html.35', 'carousel.36', 'special.37');
						");	
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'category';
						");	
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'information';
						");
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module WHERE module_id IN (30, 31, 32, 33, 35, 36, 37 );
						");	
						
						$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."module` (`module_id`, `name`, `code`, `setting`) VALUES
						(30, 'Top Left', 'html', '{\"name\":\"Top Left\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner1.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(31, 'Column Left', 'html', '{\"name\":\"Column Left\",\"module_description\":{\"1\":{\"title\":\"Fashion\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner2.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(32, 'Middle Top Left', 'html', '{\"name\":\"Middle Top Left\",\"module_description\":{\"1\":{\"title\":\"Technology\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner3.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(33, 'Middle Center Left', 'html', '{\"name\":\"Middle Center Left\",\"module_description\":{\"1\":{\"title\":\"Home &amp; Life\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner4.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(35, 'Column Left Fixed', 'html', '{\"name\":\"Column Left Fixed\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner6.jpg&quot; style=&quot;padding-bottom: 50px;&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(36, 'Carousel', 'carousel', '{\"name\":\"Carousel\",\"banner_id\":\"8\",\"width\":\"100\",\"height\":\"100\",\"status\":\"1\"}'),
						(37, 'Top Right', 'special', '{\"name\":\"Top Right\",\"limit\":\"12\",\"width\":\"130\",\"height\":\"130\",\"status\":\"1\"}');
						");
						
						
						
						
						
						$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
						(NULL, 1, 'html.30', 'top_left', 0),
						(NULL, 1, 'html.31', 'column_left', 0),
						(NULL, 1, 'html.32', 'middle_topleft', 0),
						(NULL, 1, 'html.33', 'mcenterleft', 0),
						(NULL, 1, 'html.35', 'clfixed', 3),
						(NULL, 2, 'html.35', 'clfixed', 3),
						(NULL, 3, 'html.35', 'clfixed', 3),
						(NULL, 1, 'carousel.36', 'content_bottom', 0),
						(NULL, 1, 'special.37', 'top_right', 0);
						");	
			
					
					// CATEGORY INSTALL
					$output["category_status"] = 1; 
					$this->model_setting_setting->editSetting( "category", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 1, 'category', 'clfixed', 0),
							(NULL, 2, 'category', 'clfixed', 0),
							(NULL, 3, 'category', 'clfixed', 0);
							");	
							
					// INFORMATION INSTALL
					$output["information_status"] = 1; 
					$this->model_setting_setting->editSetting( "information", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 1, 'information', 'clfixed', 1),
							(NULL, 2, 'information', 'clfixed', 1),
							(NULL, 3, 'information', 'clfixed', 1);
							");			
			
				
				// tg_superstar_filter_product
					$this->model_setting_setting->deleteSetting( "tg_superstar_filter_product");
					
					include '../data_sample/superstar/tg_superstar_filter_product.php'; 
					$this->session->data['success'] = $this->language->get('text_success');
					$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
				
				
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
				
				
			
			
			}
		
		
			// Revolution slider
			if(isset($_POST['install_tg_superstar_revolution_slider'])){
				$output = array();
				$output["tg_superstar_revolution_slider_module"] = array (
				  0 => 
				  array (
				    'slider_id' => '1',
				    'layout_id' => '1',
				    'position' => 'slideshow',
				    'sort_order' => '',
				    'status' => '1',
				  ),
				); 
				$this->model_setting_setting->editSetting( "tg_superstar_revolution_slider", $output );	
				
				include '../data_sample/superstar/tg_superstar_revolution_slider_query.php'; 

				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
			}
			
			// tg_superstar_megamenu
			if(isset($_POST['install_tg_superstar_megamenu'])){
				$output = array();
				$output["tg_superstar_megamenu_module"] = array (
				  0 => 
				  array (
				    'layout_id' => '99999',
				    'position' => 'menu',
				    'status' => '1',
				    'sort_order' => 0,
				    'animation' => 'none',
				    'animation_time' => 300,
				  ),
				); 
				$this->model_setting_setting->editSetting( "tg_superstar_megamenu", $output );	
				
				include '../data_sample/superstar/tg_superstar_megamenu_query.php'; 
				
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
			}
			
			
			
			
			// tg_superstar_filter_product
			if(isset($_POST['install_tg_superstar_filter_product'])){
				$this->model_setting_setting->deleteSetting( "tg_superstar_filter_product");
				
				include '../data_sample/superstar/tg_superstar_filter_product.php'; 
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
			}
			
			// tg_superstar_news_blog
			if(isset($_POST['install_tg_superstar_news_blog'])){
				$this->model_setting_setting->deleteSetting( "ncategory");
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = 15;
						");	
				
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout` (`layout_id`, `name`) VALUES
							(15, 'Blogs');
							");		
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = 15;
						");		
				
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
							(NULL, 15, 0, 'news/ncategory');
							");		
				
				$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'ncategory';
						");					
				$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 15, 'ncategory', 'column_left', 0);
							");
								
				
				include '../data_sample/superstar/tg_superstar_news_blog.php'; 
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
			}
			
			
			
			// OpenCart Default Module
			if(isset($_POST['install_tg_other_module'])){
	
					$this->model_setting_setting->deleteSetting( "special");
					$this->model_setting_setting->deleteSetting( "html");	
					$this->model_setting_setting->deleteSetting( "category");
					$this->model_setting_setting->deleteSetting( "information");
					
					// HTML CONTENT
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code IN ('html.30', 'html.31', 'html.32', 'html.33', 'html.35', 'carousel.36', 'special.37');
						");	
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'category';
						");	
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module WHERE code = 'information';
						");
						
						$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module WHERE module_id IN (30, 31, 32, 33, 35, 36, 37 );
						");	
						
						$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."module` (`module_id`, `name`, `code`, `setting`) VALUES
						(30, 'Top Left', 'html', '{\"name\":\"Top Left\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner1.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(31, 'Column Left', 'html', '{\"name\":\"Column Left\",\"module_description\":{\"1\":{\"title\":\"Fashion\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner2.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(32, 'Middle Top Left', 'html', '{\"name\":\"Middle Top Left\",\"module_description\":{\"1\":{\"title\":\"Technology\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner3.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(33, 'Middle Center Left', 'html', '{\"name\":\"Middle Center Left\",\"module_description\":{\"1\":{\"title\":\"Home &amp; Life\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner4.jpg&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(35, 'Column Left Fixed', 'html', '{\"name\":\"Column Left Fixed\",\"module_description\":{\"1\":{\"title\":\"\",\"description\":\"&lt;a href=&quot;index.php?route=product\/special&quot;&gt;&lt;img src=&quot;http:\/\/oc.themeglobal.com\/images\/superstar\/banner6.jpg&quot; style=&quot;padding-bottom: 50px;&quot;&gt;&lt;\/a&gt;\"}},\"status\":\"1\"}'),
						(36, 'Carousel', 'carousel', '{\"name\":\"Carousel\",\"banner_id\":\"8\",\"width\":\"100\",\"height\":\"100\",\"status\":\"1\"}'),
						(37, 'Top Right', 'special', '{\"name\":\"Top Right\",\"limit\":\"12\",\"width\":\"130\",\"height\":\"130\",\"status\":\"1\"}');
						");
						
						
						
						
						
						$query = $this->db->query("
						INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
						(NULL, 1, 'html.30', 'top_left', 0),
						(NULL, 1, 'html.31', 'column_left', 0),
						(NULL, 1, 'html.32', 'middle_topleft', 0),
						(NULL, 1, 'html.33', 'mcenterleft', 0),
						(NULL, 1, 'html.35', 'clfixed', 3),
						(NULL, 2, 'html.35', 'clfixed', 3),
						(NULL, 3, 'html.35', 'clfixed', 3),
						(NULL, 1, 'carousel.36', 'content_bottom', 0),
						(NULL, 1, 'special.37', 'top_right', 0);
						");	
			
					
					// CATEGORY INSTALL
					$output["category_status"] = 1; 
					$this->model_setting_setting->editSetting( "category", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 1, 'category', 'clfixed', 0),
							(NULL, 2, 'category', 'clfixed', 0),
							(NULL, 3, 'category', 'clfixed', 0);
							");	
							
					// INFORMATION INSTALL
					$output["information_status"] = 1; 
					$this->model_setting_setting->editSetting( "information", $output );
					$query = $this->db->query("
							INSERT INTO `".DB_PREFIX."layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
							(NULL, 1, 'information', 'clfixed', 1),
							(NULL, 2, 'information', 'clfixed', 1),
							(NULL, 3, 'information', 'clfixed', 1);
							");			
					
				
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true));
				
			}
		}
		
		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
 		} elseif(isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
        if (isset($this->session->data['success'])) {
        	$data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
			$data['success'] = '';
        }

		$data['action'] = $this->url->link('extension/module/tg_superstar_settings', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		
		$data['breadcrumbs'][] = array(
			'text' => 'Modules',
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
		);
				
		$data['breadcrumbs'][] = array(
			'text' => 'TG superstar Settings',
			'href' => $this->url->link('module/beamstore', 'token=' . $this->session->data['token'], true)
		);
		
		// Multilanguage
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		
		// No image
		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		//Send the output.
		$this->response->setOutput($this->load->view('extension/module/tg_superstar_settings', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/tg_superstar_settings')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	
	public function install() {
		$this->load->model('extension/extension');
		$this->load->model('setting/setting');
		$this->load->model('design/layout');
		$this->load->model('user/user_group');
		$this->model_extension_extension->uninstall('module', 'slideshow');
		$this->model_extension_extension->uninstall('module', 'banner');
		$this->model_extension_extension->uninstall('module', 'featured');
		$this->model_extension_extension->uninstall('module', 'account');
		$this->model_extension_extension->uninstall('module', 'latest');
		$this->model_extension_extension->install('module', 'carousel');
		$this->model_extension_extension->install('module', 'tg_superstar_revolution_slider');
		$this->model_extension_extension->install('module', 'tg_superstar_megamenu');
		$this->model_extension_extension->install('module', 'tg_superstar_filter_product');
		$this->model_extension_extension->install('module', 'information');
		$this->model_extension_extension->install('module', 'special');
		$this->model_extension_extension->install('module', 'category');
		$this->model_extension_extension->install('module', 'html');
		$this->model_extension_extension->install('module', 'ncategory');
		$this->model_extension_extension->install('module', 'news');

		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module
						");	
		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module
						");	

		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_thumb_width', 400);	
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_thumb_height', 400);	
		
			$this->model_setting_setting->editSettingValue('config', 'theme_default_image_popup_width', 500);
		$this->model_setting_setting->editSettingValue('config', 'theme_default_image_popup_height', 500);
		
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_category_width', 200);	
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_category_height', 200);	
		
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_product_width', 200);	
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_product_height', 200);	
		
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_related_width', 200);
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_image_related_height', 200);
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_directory', 'superstar');
		
		$this->model_user_user_group->addPermission(1,'modify','extension/module/tg_superstar_revolution_slider');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/tg_superstar_revolution_slider');
		
		$this->model_user_user_group->addPermission(1,'modify','extension/module/tg_superstar_megamenu');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/tg_superstar_megamenu');
		
		$this->model_user_user_group->addPermission(1,'modify','extension/module/tg_superstar_filter_product');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/tg_superstar_filter_product');
		$this->model_user_user_group->addPermission(1,'modify','extension/module/html');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/html');

		$this->model_user_user_group->addPermission(1,'modify','extension/module/ncategory');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/ncategory');
		
		$this->model_user_user_group->addPermission(1,'modify','extension/module/news');	
		$this->model_user_user_group->addPermission(1,'access','extension/module/news');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/nauthor');	
		$this->model_user_user_group->addPermission(1,'access','catalog/nauthor');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/ncategory');	
		$this->model_user_user_group->addPermission(1,'access','catalog/ncategory');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/ncomments');	
		$this->model_user_user_group->addPermission(1,'access','catalog/ncomments');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/news');	
		$this->model_user_user_group->addPermission(1,'access','catalog/news');
		
		$this->model_user_user_group->addPermission(1,'modify','common/newspanel');	
		$this->model_user_user_group->addPermission(1,'access','common/newspanel');
		
		$this->model_user_user_group->addPermission(1,'modify','extension/newsletter');	
		$this->model_user_user_group->addPermission(1,'access','extension/newsletter');
		
		$this->model_user_user_group->addPermission(1,'modify','feed/articles_google_base');	
		$this->model_user_user_group->addPermission(1,'access','feed/articles_google_base');
		
		$this->model_user_user_group->addPermission(1,'modify','feed/articles_google_sitemap');	
		$this->model_user_user_group->addPermission(1,'access','feed/articles_google_sitemap');

		
		$this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."newsletter");
		$this->db->query("CREATE TABLE ".DB_PREFIX."newsletter (
		email varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '', 
		PRIMARY KEY (`email`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getId(),'access','extension/newsletter');
		$this->model_user_user_group->addPermission($this->user->getId(),'modify','extension/newsletter');
		
		
		
		
		$this->model_user_user_group->addPermission(1,'modify','module/ncategory');	
		$this->model_user_user_group->addPermission(1,'access','module/ncategory');
		
		$this->model_user_user_group->addPermission(1,'modify','module/news');	
		$this->model_user_user_group->addPermission(1,'access','module/news');

		
		$this->model_user_user_group->addPermission(1,'modify','catalog/nauthor');	
		$this->model_user_user_group->addPermission(1,'access','catalog/nauthor');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/ncategory');	
		$this->model_user_user_group->addPermission(1,'access','catalog/ncategory');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/ncomments');	
		$this->model_user_user_group->addPermission(1,'access','catalog/ncomments');
		
		$this->model_user_user_group->addPermission(1,'modify','catalog/news');	
		$this->model_user_user_group->addPermission(1,'access','catalog/news');
		
		$this->model_user_user_group->addPermission(1,'modify','common/newspanel');	
		$this->model_user_user_group->addPermission(1,'access','common/newspanel');

		
		$this->model_user_user_group->addPermission(1,'modify','feed/articles_google_base');	
		$this->model_user_user_group->addPermission(1,'access','feed/articles_google_base');
		
		$this->model_user_user_group->addPermission(1,'modify','feed/articles_google_sitemap');	
		$this->model_user_user_group->addPermission(1,'access','feed/articles_google_sitemap');
		

		
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_archive (
						`news_archive_id` int(11) NOT NULL AUTO_INCREMENT,
						`store_id` int(3) NOT NULL,
						`year` int(4) NOT NULL,
						`months` varchar(1024) DEFAULT NULL,
						PRIMARY KEY (`news_archive_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory (
							`ncategory_id` int(11) NOT NULL AUTO_INCREMENT,
							`image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
							`parent_id` int(11) NOT NULL DEFAULT '0',
							`top` tinyint(1) NOT NULL,
							`column` int(3) NOT NULL,
							`sort_order` int(3) NOT NULL DEFAULT '0',
							`status` tinyint(1) NOT NULL,
							`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							PRIMARY KEY (`ncategory_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=59");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_description (
							`ncategory_id` int(11) NOT NULL,
							`language_id` int(11) NOT NULL,
							`name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
							`description` text COLLATE utf8_bin NOT NULL,
							`meta_description` varchar(255) COLLATE utf8_bin NOT NULL,
							`meta_keyword` varchar(255) COLLATE utf8_bin NOT NULL,
							PRIMARY KEY (`ncategory_id`,`language_id`),
							KEY `name` (`name`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_to_layout (
							`ncategory_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							`layout_id` int(11) NOT NULL,
							PRIMARY KEY (`ncategory_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncategory_to_store (
							`ncategory_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							PRIMARY KEY (`ncategory_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_ncomments (
							`ncomment_id` int(11) NOT NULL AUTO_INCREMENT,
							`news_id` int(11) NOT NULL,
							`language_id` int(2) NOT NULL,
							`reply_id` int(11) NOT NULL DEFAULT '0',
							`author` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
							`text` text COLLATE utf8_bin NOT NULL,
							`status` tinyint(1) NOT NULL DEFAULT '0',
							`date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							`date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
							PRIMARY KEY (`ncomment_id`),
							KEY `news_id` (`news_id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news (
							`news_id` int(11) NOT NULL AUTO_INCREMENT,
							`nauthor_id` int(11) NOT NULL,
							`status` int(1) NOT NULL DEFAULT '0',
							`image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
							`acom` int(1) NOT NULL DEFAULT '0',
							`date_added` datetime DEFAULT NULL,
							`date_updated` datetime DEFAULT NULL,
							`image2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
							`sort_order` int(11) DEFAULT NULL,
							`gal_thumb_w` int(5) NOT NULL,
							`gal_thumb_h` int(5) NOT NULL,
							`gal_popup_w` int(5) NOT NULL,
							`gal_popup_h` int(5) NOT NULL,
							`gal_slider_h` int(4) NOT NULL,
							`gal_slider_t` int(1) NOT NULL,
							`date_pub` datetime DEFAULT NULL,
							`gal_slider_w` int(4) NOT NULL,
							PRIMARY KEY (`news_id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_description (
							`news_id` int(11) NOT NULL DEFAULT '0',
							`language_id` int(11) NOT NULL DEFAULT '0',
							`title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`ctitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`description2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`meta_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
							`meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
							`ntags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							`cfield1` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield3` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							`cfield4` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
							PRIMARY KEY (`news_id`,`language_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_related (
							`news_id` int(11) NOT NULL,
							`product_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`product_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_layout (
							`news_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL,
							`layout_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_ncategory (
							`news_id` int(11) NOT NULL,
							`ncategory_id` int(11) NOT NULL,
							PRIMARY KEY (`news_id`,`ncategory_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_to_store (
							`news_id` int(11) NOT NULL,
							`store_id` int(11) NOT NULL DEFAULT '0',
							PRIMARY KEY (`news_id`,`store_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_nauthor (
							`nauthor_id` int(11) NOT NULL AUTO_INCREMENT,
							`adminid` varchar(64) NOT NULL,
							`name` varchar(64) NOT NULL,
							`image` varchar(255) DEFAULT NULL,
							PRIMARY KEY (`nauthor_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
		$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_nauthor_description (
							`nauthor_id` int(11) NOT NULL,
							`language_id` int(11) NOT NULL,
							`ctitle` varchar(255) NOT NULL,
							`description` text NOT NULL,
							`meta_description` varchar(255) NOT NULL,
							`meta_keyword` varchar(255) NOT NULL,
							PRIMARY KEY (`nauthor_id`,`language_id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin");
	$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_gallery (
						`news_image_id` int(11) NOT NULL AUTO_INCREMENT,
						`news_id` int(11) NOT NULL,
						`image` varchar(512) DEFAULT NULL,
						`text` text NOT NULL,
						`sort_order` int(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`news_image_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
	$this->db->query("CREATE TABLE IF NOT EXISTS ". DB_PREFIX . "sb_news_video (
						`news_video_id` int(11) NOT NULL AUTO_INCREMENT,
						`news_id` int(11) NOT NULL,
						`text` text COLLATE utf8_bin NOT NULL,
						`video` varchar(255) COLLATE utf8_bin DEFAULT NULL,
						`width` int(11) NOT NULL,
						`height` int(11) NOT NULL,
						`sort_order` int(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`news_video_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1");
		$this->db->query('DELETE FROM '. DB_PREFIX . 'url_alias WHERE `query` = "news/headlines"');
		$this->db->query("INSERT INTO ". DB_PREFIX ."url_alias (query, keyword) VALUES ('news/headlines', 'blogspage')");
		

	}
	

	
	public function uninstall() {
		$this->load->model('extension/extension');
		$this->load->model('setting/setting');
		$this->model_extension_extension->uninstall('module', 'tg_superstar_revolution_slider');
		$this->model_extension_extension->uninstall('module', 'tg_superstar_megamenu');
		$this->model_extension_extension->uninstall('module', 'tg_superstar_filter_product');
		$this->model_extension_extension->uninstall('module', 'account');
		$this->model_extension_extension->uninstall('module', 'category');
		$this->model_extension_extension->uninstall('module', 'information');
		$this->model_extension_extension->uninstall('module', 'featured');
		$this->model_extension_extension->uninstall('module', 'special');
		$this->model_extension_extension->uninstall('module', 'carousel');
		$this->model_extension_extension->uninstall('module', 'html');
		$this->model_extension_extension->uninstall('module', 'banner');
		$this->model_extension_extension->uninstall('module', 'ncategory');
		$this->model_extension_extension->uninstall('module', 'news');
		$this->model_setting_setting->editSettingValue('theme_default', 'theme_default_directory', 'default');
		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "layout_module
						");	
		
		$query = $this->db->query("
						DELETE FROM " . DB_PREFIX . "module
						");	
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "tg_superstar_revolution_slider
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "mega_menu
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_nauthor
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_nauthor_description
		");
		
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_ncategory
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_ncategory_description
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_ncategory_to_layout
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_ncategory_to_store
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_ncomments
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_archive
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_description
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_gallery
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_related
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_to_layout
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_to_ncategory
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_to_store
		");
		$query = $this->db->query("
			DROP TABLE IF EXISTS " . DB_PREFIX . "sb_news_video
		");
		
						
		$this->model_setting_setting->deleteSetting( "tg_superstar_filter_product");
		$this->model_setting_setting->deleteSetting( "featured");	
		$this->model_setting_setting->deleteSetting( "account");
		$this->model_setting_setting->deleteSetting( "special");
		$this->model_setting_setting->deleteSetting( "html");
		$this->model_setting_setting->deleteSetting( "information");		
		$this->model_setting_setting->deleteSetting( "tg_superstar_megamenu");
		$this->model_setting_setting->deleteSetting( "tg_superstar_revolution_slider");
		$this->model_setting_setting->deleteSetting( "category");
		$this->model_setting_setting->deleteSetting( "banner");
		$this->model_setting_setting->deleteSetting( "ncategory");
		$this->model_setting_setting->deleteSetting( "news");

		
	}

}
?>