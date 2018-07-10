<?php
class ControllerModuleCheckSma extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/check_sma');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('check_sma', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->session->data['success'])) {
			$data['error_warning'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/check_sma', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/check_sma', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['export'] = $this->url->link('module/check_sma/download', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['check_sma_status'])) {
			$data['check_sma_status'] = $this->request->post['check_sma_status'];
		} else {
			$data['check_sma_status'] = $this->config->get('check_sma_status');
		}
			
		
		$this->load->model( 'tool/export_sma' );
		$results = $this->model_tool_export_sma->getProductByStatus();
		$head = [
				'code' => 'Code',
				'name' => 'Product Name'
			];
			array_unshift($results,$head);
		$data['results'] = $results;
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/check_sma.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/check_sma')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function download() {
		$this->load->language( 'tool/export_import' );
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('tool/export_sma');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$results = $this->model_tool_export_sma->getProductByStatus();
			
		if(empty($results)){
			$this->session->data['success'] = 'No Data';

			$this->response->redirect($this->url->link('module/check_sma', 'token=' . $this->session->data['token'], 'SSL'));
		
		}
			
			$head = [
				'code' => 'SMA Code',
				'quantity' => 'SMA Quantity',
				'name' => 'SMA Product Name'
			];
			array_unshift($results,$head);
			
			
			$cwd = getcwd();
		chdir( DIR_SYSTEM.'PHPExcel' );
		require_once( 'Classes/PHPExcel.php' );
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_ExportImportValueBinder() );
		chdir( $cwd );
			
			// Memory Optimization
		if ($this->config->get( 'export_import_settings_use_export_cache' )) {
			$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
			$cacheSettings = array( 'memoryCacheSize'  => '16MB' );  
			PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);  
		}
		
		try {
			// set appropriate timeout limit
			set_time_limit(0);
			
			// create a new workbook
			$workbook = new PHPExcel();
			// set some default styles
			$workbook->getDefaultStyle()->getFont()->setName('Arial');
			$workbook->getDefaultStyle()->getFont()->setSize(10);
			$workbook->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$workbook->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$workbook->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
			// create the worksheets
			$worksheet_index = 0;
			// creating the Products worksheet
					$workbook->setActiveSheetIndex($worksheet_index++);
					$worksheet = $workbook->getActiveSheet();
					$worksheet->setTitle( 'Products' );
					
					$workbook->setActiveSheetIndex(0);
					
					
				
		$column = ord('A'); 			
		foreach ($results as $row=>$col) {
        $i=0;
        foreach ($col as $k=>$v ) {
            $workbook->getActiveSheet()->setCellValue(chr($column+$i).($row+1), $v);
            $i++;
        }
		}
					

			
			// redirect output to client browser
			$datetime = date('Y-m-d');
			$filename = 'products-'.$datetime;
			$filename .= '.xlsx';
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');	
			$objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
			$objWriter->setPreCalculateFormulas(false);
			$objWriter->save('php://output');
			
		} catch (Exception $e) {
			$errstr = $e->getMessage();
			$errline = $e->getLine();
			$errfile = $e->getFile();
			$errno = $e->getCode();
			$this->session->data['export_import_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );
			if ($this->config->get('config_error_log')) {
				$this->log->write('PHP ' . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
			}
			return;
		}
		
		
		
				
			
		}
	}
	
	
}