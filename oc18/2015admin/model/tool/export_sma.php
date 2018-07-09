<?php

class ModelToolExportSma extends Model {
	
	public function getProductByStatus(){
		$query = $this->db->query("SELECT DISTINCT * FROM product where status = '0'");
	}

	public function export( $offset=null, $rows=null, $min_id=null, $max_id=null) {
		// Use the PHPExcel package from http://phpexcel.codeplex.com/
		$cwd = getcwd();
		chdir( DIR_SYSTEM.'PHPExcel' );
		require_once( 'Classes/PHPExcel.php' );
		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_ExportImportValueBinder() );
		chdir( $cwd );

		// find out whether all data is to be downloaded
		$all = !isset($offset) && !isset($rows) && !isset($min_id) && !isset($max_id);

		// Memory Optimization
		if ($this->config->get( 'export_import_settings_use_export_cache' )) {
			$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
			$cacheSettings = array( 'memoryCacheSize'  => '16MB' );  
			PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);  
		}

		try {
			// set appropriate timeout limit
			set_time_limit(0);

			$languages = $this->getLanguages();
			$default_language_id = $this->getDefaultLanguageId();

			// create a new workbook
			$workbook = new PHPExcel();

			// set some default styles
			$workbook->getDefaultStyle()->getFont()->setName('Arial');
			$workbook->getDefaultStyle()->getFont()->setSize(10);
			//$workbook->getDefaultStyle()->getAlignment()->setIndent(0.5);
			$workbook->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$workbook->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$workbook->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);

			// pre-define some commonly used styles
			$box_format = array(
				'fill' => array(
					'type'      => PHPExcel_Style_Fill::FILL_SOLID,
					'color'     => array( 'rgb' => 'F0F0F0')
				),
			);
			$text_format = array(
				'numberformat' => array(
					'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT
				),
			);
			$price_format = array(
				'numberformat' => array(
					'code' => '######0.00'
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				)
			);
			$weight_format = array(
				'numberformat' => array(
					'code' => '##0.00'
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				)
			);
			
			// create the worksheets
			$worksheet_index = 0;
					// creating the Products worksheet
					$workbook->setActiveSheetIndex($worksheet_index++);
					$worksheet = $workbook->getActiveSheet();
					$worksheet->setTitle( 'Products' );
					$this->populateProductsWorksheet( $worksheet, $languages, $default_language_id, $price_format, $box_format, $weight_format, $text_format, $offset, $rows, $min_id, $max_id );
					$worksheet->freezePaneByColumnAndRow( 1, 2 );
					

			$workbook->setActiveSheetIndex(0);

			// redirect output to client browser
			$datetime = date('Y-m-d');

					$filename = 'products-'.$datetime;
					if (!$all) {
						if (isset($offset)) {
							$filename .= "-offset-$offset";
						} else if (isset($min_id)) {
							$filename .= "-start-$min_id";
						}
						if (isset($rows)) {
							$filename .= "-rows-$rows";
						} else if (isset($max_id)) {
							$filename .= "-end-$max_id";
						}
					}
					$filename .= '.xlsx';
				
			
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
			$objWriter->setPreCalculateFormulas(false);
			$objWriter->save('php://output');

			// Clear the spreadsheet caches
			$this->clearSpreadsheetCache();
			exit;
`
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
	
	
	public function populateProductsWorksheet( &$worksheet, &$languages, $default_language_id, &$price_format, &$box_format, &$weight_format, &$text_format, $offset=null, $rows=null, &$min_id=null, &$max_id=null) {
		// get list of the field names, some are only available for certain OpenCart versions
		$query = $this->db->query("DESCRIBE `".DB_PREFIX."product`");
		$product_fields = array();
		foreach ($query->rows as $row) {
			$product_fields[] = $row['Field'];
		}

		// Opencart versions from 2.0 onwards also have product_description.meta_title
		$sql = "SHOW COLUMNS FROM `".DB_PREFIX."product_description` LIKE 'meta_title'";
		$query = $this->db->query( $sql );
		$exist_meta_title = ($query->num_rows > 0) ? true : false;

		// Set the column widths
		$j = 0;
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('product_id'),4)+1);
		foreach ($languages as $language) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('name')+4,30)+1);
		}
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('categories'),12)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('sku'),10)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('upc'),12)+1);
		if (in_array('ean',$product_fields)) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('ean'),14)+1);
		}
		if (in_array('jan',$product_fields)) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('jan'),13)+1);
		}
		if (in_array('isbn',$product_fields)) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('isbn'),13)+1);
		}
		if (in_array('mpn',$product_fields)) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('mpn'),15)+1);
		}
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('location'),10)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('quantity'),4)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('model'),8)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('manufacturer'),10)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('image_name'),12)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('shipping'),5)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('price'),10)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('points'),5)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_added'),19)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_modified'),19)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('date_available'),10)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight'),6)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('weight_unit'),3)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('length'),8)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('width'),8)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('height'),8)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('length_unit'),3)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('status'),5)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('tax_class_id'),2)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('seo_keyword'),16)+1);
		foreach ($languages as $language) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('description')+4,32)+1);
		}
		if ($exist_meta_title) {
			foreach ($languages as $language) {
				$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_title')+4,20)+1);
			}
		}
		foreach ($languages as $language) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_description')+4,32)+1);
		}
		foreach ($languages as $language) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('meta_keywords')+4,32)+1);
		}
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('stock_status_id'),3)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('store_ids'),16)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('layout'),16)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('related_ids'),16)+1);
		foreach ($languages as $language) {
			$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('tags')+4,32)+1);
		}
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('sort_order'),8)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('subtract'),5)+1);
		$worksheet->getColumnDimensionByColumn($j++)->setWidth(max(strlen('minimum'),8)+1);

		// The product headings row and column styles
		$styles = array();
		$data = array();
		$i = 1;
		$j = 0;
		$data[$j++] = 'product_id';
		foreach ($languages as $language) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'name('.$language['code'].')';
		}
		$styles[$j] = &$text_format;
		$data[$j++] = 'categories';
		$styles[$j] = &$text_format;
		$data[$j++] = 'sku';
		$styles[$j] = &$text_format;
		$data[$j++] = 'upc';
		if (in_array('ean',$product_fields)) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'ean';
		}
		if (in_array('jan',$product_fields)) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'jan';
		}
		if (in_array('isbn',$product_fields)) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'isbn';
		}
		if (in_array('mpn',$product_fields)) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'mpn';
		}
		$styles[$j] = &$text_format;
		$data[$j++] = 'location';
		$data[$j++] = 'quantity';
		$styles[$j] = &$text_format;
		$data[$j++] = 'model';
		$styles[$j] = &$text_format;
		$data[$j++] = 'manufacturer';
		$styles[$j] = &$text_format;
		$data[$j++] = 'image_name';
		$data[$j++] = 'shipping';
		$styles[$j] = &$price_format;
		$data[$j++] = 'price';
		$data[$j++] = 'points';
		$data[$j++] = 'date_added';
		$data[$j++] = 'date_modified';
		$data[$j++] = 'date_available';
		$styles[$j] = &$weight_format;
		$data[$j++] = 'weight';
		$data[$j++] = 'weight_unit';
		$data[$j++] = 'length';
		$data[$j++] = 'width';
		$data[$j++] = 'height';
		$data[$j++] = 'length_unit';
		$data[$j++] = 'status';
		$data[$j++] = 'tax_class_id';
		$styles[$j] = &$text_format;
		$data[$j++] = 'seo_keyword';
		foreach ($languages as $language) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'description('.$language['code'].')';
		}
		if ($exist_meta_title) {
			foreach ($languages as $language) {
				$styles[$j] = &$text_format;
				$data[$j++] = 'meta_title('.$language['code'].')';
			}
		}
		foreach ($languages as $language) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'meta_description('.$language['code'].')';
		}
		foreach ($languages as $language) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'meta_keywords('.$language['code'].')';
		}
		$data[$j++] = 'stock_status_id';
		$data[$j++] = 'store_ids';
		$styles[$j] = &$text_format;
		$data[$j++] = 'layout';
		$data[$j++] = 'related_ids';
		foreach ($languages as $language) {
			$styles[$j] = &$text_format;
			$data[$j++] = 'tags('.$language['code'].')';
		}
		$data[$j++] = 'sort_order';
		$data[$j++] = 'subtract';
		$data[$j++] = 'minimum';
		$worksheet->getRowDimension($i)->setRowHeight(30);
		$this->setCellRow( $worksheet, $i, $data, $box_format );

		// The actual products data
		$i += 1;
		$j = 0;
		$store_ids = $this->getStoreIdsForProducts();
		$layouts = $this->getLayoutsForProducts();
		$products = $this->getProducts( $languages, $default_language_id, $product_fields, $exist_meta_title, $offset, $rows, $min_id, $max_id );
		$len = count($products);
		$min_id = $products[0]['product_id'];
		$max_id = $products[$len-1]['product_id'];
		foreach ($products as $row) {
			$data = array();
			$worksheet->getRowDimension($i)->setRowHeight(26);
			$product_id = $row['product_id'];
			$data[$j++] = $product_id;
			foreach ($languages as $language) {
				$data[$j++] = html_entity_decode($row['name'][$language['code']],ENT_QUOTES,'UTF-8');
			}
			$data[$j++] = $row['categories'];
			$data[$j++] = $row['sku'];
			$data[$j++] = $row['upc'];
			if (in_array('ean',$product_fields)) {
				$data[$j++] = $row['ean'];
			}
			if (in_array('jan',$product_fields)) {
				$data[$j++] = $row['jan'];
			}
			if (in_array('isbn',$product_fields)) {
				$data[$j++] = $row['isbn'];
			}
			if (in_array('mpn',$product_fields)) {
				$data[$j++] = $row['mpn'];
			}
			$data[$j++] = $row['location'];
			$data[$j++] = $row['quantity'];
			$data[$j++] = $row['model'];
			$data[$j++] = $row['manufacturer'];
			$data[$j++] = $row['image_name'];
			$data[$j++] = ($row['shipping']==0) ? 'no' : 'yes';
			$data[$j++] = $row['price'];
			$data[$j++] = $row['points'];
			$data[$j++] = $row['date_added'];
			$data[$j++] = $row['date_modified'];
			$data[$j++] = $row['date_available'];
			$data[$j++] = $row['weight'];
			$data[$j++] = $row['weight_unit'];
			$data[$j++] = $row['length'];
			$data[$j++] = $row['width'];
			$data[$j++] = $row['height'];
			$data[$j++] = $row['length_unit'];
			$data[$j++] = ($row['status']==0) ? 'false' : 'true';
			$data[$j++] = $row['tax_class_id'];
			$data[$j++] = ($row['keyword']) ? $row['keyword'] : '';
			foreach ($languages as $language) {
				$data[$j++] = html_entity_decode($row['description'][$language['code']],ENT_QUOTES,'UTF-8');
			}
			if ($exist_meta_title) {
				foreach ($languages as $language) {
					$data[$j++] = html_entity_decode($row['meta_title'][$language['code']],ENT_QUOTES,'UTF-8');
				}
			}
			foreach ($languages as $language) {
				$data[$j++] = html_entity_decode($row['meta_description'][$language['code']],ENT_QUOTES,'UTF-8');
			}
			foreach ($languages as $language) {
				$data[$j++] = html_entity_decode($row['meta_keyword'][$language['code']],ENT_QUOTES,'UTF-8');
			}
			$data[$j++] = $row['stock_status_id'];
			$store_id_list = '';
			if (isset($store_ids[$product_id])) {
				foreach ($store_ids[$product_id] as $store_id) {
					$store_id_list .= ($store_id_list=='') ? $store_id : ','.$store_id;
				}
			}
			$data[$j++] = $store_id_list;
			$layout_list = '';
			if (isset($layouts[$product_id])) {
				foreach ($layouts[$product_id] as $store_id => $name) {
					$layout_list .= ($layout_list=='') ? $store_id.':'.$name : ','.$store_id.':'.$name;
				}
			}
			$data[$j++] = $layout_list;
			$data[$j++] = $row['related'];
			foreach ($languages as $language) {
				$data[$j++] = html_entity_decode($row['tag'][$language['code']],ENT_QUOTES,'UTF-8');
			}
			$data[$j++] = $row['sort_order'];
			$data[$j++] = ($row['subtract']==0) ? 'false' : 'true';
			$data[$j++] = $row['minimum'];
			$this->setCellRow( $worksheet, $i, $data, $this->null_array, $styles );
			$i += 1;
			$j = 0;
		}
	}
	
	protected function getLayoutsForProducts() {
		$sql  = "SELECT pl.*, l.name FROM `".DB_PREFIX."product_to_layout` pl ";
		$sql .= "LEFT JOIN `".DB_PREFIX."layout` l ON pl.layout_id = l.layout_id ";
		$sql .= "ORDER BY pl.product_id, pl.store_id;";
		$result = $this->db->query( $sql );
		$layouts = array();
		foreach ($result->rows as $row) {
			$productId = $row['product_id'];
			$store_id = $row['store_id'];
			$name = $row['name'];
			if (!isset($layouts[$productId])) {
				$layouts[$productId] = array();
			}
			$layouts[$productId][$store_id] = $name;
		}
		return $layouts;
	}
	
	protected function getStoreIdsForProducts() {
		$sql =  "SELECT product_id, store_id FROM `".DB_PREFIX."product_to_store` ps;";
		$store_ids = array();
		$result = $this->db->query( $sql );
		foreach ($result->rows as $row) {
			$productId = $row['product_id'];
			$store_id = $row['store_id'];
			if (!isset($store_ids[$productId])) {
				$store_ids[$productId] = array();
			}
			if (!in_array($store_id,$store_ids[$productId])) {
				$store_ids[$productId][] = $store_id;
			}
		}
		return $store_ids;
	}
	
	protected function setCellRow( $worksheet, $row/*1-based*/, $data, &$default_style=null, &$styles=null ) {
		if (!empty($default_style)) {
			$worksheet->getStyle( "$row:$row" )->applyFromArray( $default_style, false );
		}
		if (!empty($styles)) {
			foreach ($styles as $col=>$style) {
				$worksheet->getStyleByColumnAndRow($col,$row)->applyFromArray($style,false);
			}
		}
		$worksheet->fromArray( $data, null, 'A'.$row, true );
	}
	
	protected function getDefaultLanguageId() {
		$code = $this->config->get('config_language');
		$sql = "SELECT language_id FROM `".DB_PREFIX."language` WHERE code = '$code'";
		$result = $this->db->query( $sql );
		$language_id = 1;
		if ($result->rows) {
			foreach ($result->rows as $row) {
				$language_id = $row['language_id'];
				break;
			}
		}
		return $language_id;
	}


	protected function getLanguages() {
		$query = $this->db->query( "SELECT * FROM `".DB_PREFIX."language` WHERE `status`=1 ORDER BY `code`" );
		return $query->rows;
	}
	
	protected function getProducts( &$languages, $default_language_id, $product_fields, $exist_meta_title, $offset=null, $rows=null, $min_id=null, $max_id=null ) {
		$sql  = "SELECT ";
		$sql .= "  p.product_id,";
		$sql .= "  GROUP_CONCAT( DISTINCT CAST(pc.category_id AS CHAR(11)) SEPARATOR \",\" ) AS categories,";
		$sql .= "  p.sku,";
		$sql .= "  p.upc,";
		if (in_array( 'ean', $product_fields )) {
			$sql .= "  p.ean,";
		}
		if (in_array('jan',$product_fields)) {
			$sql .= "  p.jan,";
		}
		if (in_array('isbn',$product_fields)) {
			$sql .= "  p.isbn,";
		}
		if (in_array('mpn',$product_fields)) {
			$sql .= "  p.mpn,";
		}
		$sql .= "  p.location,";
		$sql .= "  p.quantity,";
		$sql .= "  p.model,";
		$sql .= "  m.name AS manufacturer,";
		$sql .= "  p.image AS image_name,";
		$sql .= "  p.shipping,";
		$sql .= "  p.price,";
		$sql .= "  p.points,";
		$sql .= "  p.date_added,";
		$sql .= "  p.date_modified,";
		$sql .= "  p.date_available,";
		$sql .= "  p.weight,";
		$sql .= "  wc.unit AS weight_unit,";
		$sql .= "  p.length,";
		$sql .= "  p.width,";
		$sql .= "  p.height,";
		$sql .= "  p.status,";
		$sql .= "  p.tax_class_id,";
		$sql .= "  p.sort_order,";
		$sql .= "  ua.keyword,";
		$sql .= "  p.stock_status_id, ";
		$sql .= "  mc.unit AS length_unit, ";
		$sql .= "  p.subtract, ";
		$sql .= "  p.minimum, ";
		$sql .= "  GROUP_CONCAT( DISTINCT CAST(pr.related_id AS CHAR(11)) SEPARATOR \",\" ) AS related ";
		$sql .= "FROM `".DB_PREFIX."product` p ";
		$sql .= "LEFT JOIN `".DB_PREFIX."product_to_category` pc ON p.product_id=pc.product_id ";
		$sql .= "LEFT JOIN `".DB_PREFIX."url_alias` ua ON ua.query=CONCAT('product_id=',p.product_id) ";
		$sql .= "LEFT JOIN `".DB_PREFIX."manufacturer` m ON m.manufacturer_id = p.manufacturer_id ";
		$sql .= "LEFT JOIN `".DB_PREFIX."weight_class_description` wc ON wc.weight_class_id = p.weight_class_id ";
		$sql .= "  AND wc.language_id=$default_language_id ";
		$sql .= "LEFT JOIN `".DB_PREFIX."length_class_description` mc ON mc.length_class_id=p.length_class_id ";
		$sql .= "  AND mc.language_id=$default_language_id ";
		$sql .= "LEFT JOIN `".DB_PREFIX."product_related` pr ON pr.product_id=p.product_id ";
		$sql .= "WHERE p.status = 0 ";
		if (isset($min_id) && isset($max_id)) {
			$sql .= "WHERE p.product_id BETWEEN $min_id AND $max_id ";
		}
		$sql .= "GROUP BY p.product_id ";
		$sql .= "ORDER BY p.product_id ";
		if (isset($offset) && isset($rows)) {
			$sql .= "LIMIT $offset,$rows; ";
		} else {
			$sql .= "; ";
		}
		$results = $this->db->query( $sql );
		$product_descriptions = $this->getProductDescriptions( $languages, $offset, $rows, $min_id, $max_id );
		foreach ($languages as $language) {
			$language_code = $language['code'];
			foreach ($results->rows as $key=>$row) {
				if (isset($product_descriptions[$language_code][$key])) {
					$results->rows[$key]['name'][$language_code] = $product_descriptions[$language_code][$key]['name'];
					$results->rows[$key]['description'][$language_code] = $product_descriptions[$language_code][$key]['description'];
					if ($exist_meta_title) {
						$results->rows[$key]['meta_title'][$language_code] = $product_descriptions[$language_code][$key]['meta_title'];
					}
					$results->rows[$key]['meta_description'][$language_code] = $product_descriptions[$language_code][$key]['meta_description'];
					$results->rows[$key]['meta_keyword'][$language_code] = $product_descriptions[$language_code][$key]['meta_keyword'];
					$results->rows[$key]['tag'][$language_code] = $product_descriptions[$language_code][$key]['tag'];
				} else {
					$results->rows[$key]['name'][$language_code] = '';
					$results->rows[$key]['description'][$language_code] = '';
					if ($exist_meta_title) {
						$results->rows[$key]['meta_title'][$language_code] = '';
					}
					$results->rows[$key]['meta_description'][$language_code] = '';
					$results->rows[$key]['meta_keyword'][$language_code] = '';
					$results->rows[$key]['tag'][$language_code] = '';
				}
			}
		}
		return $results->rows;
	}

}
?>