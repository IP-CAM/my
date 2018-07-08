<?php
class ModelCatalogCustomPage extends Model {
	public function updateViewed($product_id) {
		$sql = "SELECT * FROM ".DB_PREFIX."product";

		$this->db->query($sql);
	}

	public function getProducts($data) {
		$product_data = false;

		if (isset($data['type'])) {
			$this->load->model('catalog/product');

			switch ($data['type']) {
				case 'featured':
					$product_data = $this->getFeaturedResults($data);
					break;
				case 'latest':
					$product_data = $this->getLatestResults($data);
					break;
				case 'bestseller':
					$product_data = $this->getBestsellerResults($data);
					break;
			}
		}

		return $product_data;
	}

	public function getProductsId($products) {
		$filter_id = array();

		if ($products && is_array($products)) {
			foreach ($products as $id) {
				$filter_id[] = (int)$id;
			}

			$filter_id = implode(',', $filter_id);
		}

		return $filter_id;
	}

	/*
		推荐商品
	*/
	public function getFeaturedResults($data) {
		$start = !empty($data['start'])?(int)$data['start']:0;
		$limit = !empty($data['limit'])?(int)$data['limit']:20;

		$key = 'product.custom_page.featured.'.(int)$this->config->get('config_language_id').'.'.(int)$this->config->get('config_store_id').'.'.$this->config->get('config_customer_group_id').'.'.$start.$limit;

		$product_data = $this->cache->get($key);

		if (isset($data['product'])) {
			$filter_id = $this->getProductsId($data['product']);
		}

		if (!$product_data && $filter_id) {
			$product_data = array();

			$sql = "SELECT p.product_id FROM " . DB_PREFIX . "product p 
						LEFT JOIN " . DB_PREFIX . "product_to_store p2s
								ON (p.product_id = p2s.product_id)
						WHERE p.status = '1'
							AND p.date_available <= NOW()
							AND p2s.store_id = '".(int)$this->config->get('config_store_id')."'
							AND p.product_id IN($filter_id)
						ORDER BY p.date_added DESC
						LIMIT ".$start.", ".$limit;

			$query = $this->db->query($sql)->rows;

			foreach ($query as $result) {
				$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
			}

			$this->cache->set($key, $product_data);
		}

		return $product_data?$product_data:array();
	}

	/*
		热销商品
	*/
	public function getBestsellerResults($data) {
		$start = !empty($data['start'])?(int)$data['start']:0;
		$limit = !empty($data['limit'])?(int)$data['limit']:20;

		$key = 'product.custom_page.bestseller.'.(int)$this->config->get('config_language_id').'.'.(int)$this->config->get('config_store_id').'.'.$this->config->get('config_customer_group_id').'.'.$start.$limit;

		$product_data = $this->cache->get($key);

		if (!$product_data) {
			$product_data = array();

			$sql = "SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op
						LEFT JOIN `" . DB_PREFIX . "order` o
							ON (op.order_id = o.order_id)
						LEFT JOIN `" . DB_PREFIX . "product` p
							ON (op.product_id = p.product_id)
						LEFT JOIN " . DB_PREFIX . "product_to_store p2s
							ON (p.product_id = p2s.product_id)
					WHERE o.order_status_id > '0'
						AND p.status = '1'
						AND p.date_available <= NOW()
						AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
					GROUP BY op.product_id
					ORDER BY total DESC
					LIMIT ".$start.", ".$limit;

			$query = $this->db->query($sql)->rows;

			foreach ($query as $result) {
				$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
			}

			$this->cache->set($key, $product_data);
		}

		return $product_data;
	}

	/*
		最新商品
	*/
	public function getLatestResults($data) {
		$start = !empty($data['start'])?(int)$data['start']:0;
		$limit = !empty($data['limit'])?(int)$data['limit']:20;

		$key = 'product.custom_page.latest.'.(int)$this->config->get('config_language_id').'.'.(int)$this->config->get('config_store_id').'.'.$this->config->get('config_customer_group_id').'.'.$start.$limit;

		$product_data = $this->cache->get($key);

		if (!$product_data) {
			$product_data = array();

			$sql = "SELECT p.product_id FROM " . DB_PREFIX . "product p 
						LEFT JOIN " . DB_PREFIX . "product_to_store p2s
								ON (p.product_id = p2s.product_id)
						WHERE p.status = '1'
							AND p.date_available <= NOW()
							AND p2s.store_id = '".(int)$this->config->get('config_store_id')."'
						ORDER BY p.date_added DESC
						LIMIT ".$start.", ".$limit;

			$query = $this->db->query($sql)->rows;

			foreach ($query as $result) {
				$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
			}

			$this->cache->set($key, $product_data);
		}

		return $product_data;
	}

	public function getTotal($data = array()) {
		if (!isset($data['type'])) {
			return false;
		}

		if (isset($data['product'])) {
			$filter_id = $this->getProductsId($data['product']);
		} else {
			$filter_id = '';
		}

		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if ($data['type'] == 'featured') {
			$sql .= " AND p.product_id IN ($filter_id)";

			$sql = $filter_id?$sql:'';
		}

		$query = $sql?$this->db->query($sql):array();

		if ($data['type'] == 'featured' && !$filter_id) {
			return 0;
		} else {
			return $query->row['total'];
		}
	}
}

?>