<?php
class ModelModuleGenerator extends Model {
	
	public function getLastOrderID() {
        $query = $this->db->query("SELECT MAX(order_id) AS order_id FROM `" . DB_PREFIX . "order`");

		return $query->row['order_id'];
	}

	public function getNextOrderID() {
		$query = $this->db->query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '" . DB_PREFIX . "order' AND table_schema = DATABASE()");

		return $query->row['AUTO_INCREMENT'];
	}

	public function getInvoicePrefix() {
        $query = $this->db->query("SELECT DISTINCT invoice_prefix FROM `" . DB_PREFIX . "order`");

		return $query->rows;
	}

	public function getLastInvoiceNo($invoice_prefix) {
        $query = $this->db->query("SELECT MAX(invoice_no) AS invoice_no FROM `" . DB_PREFIX . "order` WHERE invoice_prefix = '" . $invoice_prefix . "'");

		return $query->row['invoice_no'];
	}

	public function setNextOrderID($order_id) {
        $this->db->query("ALTER TABLE " . DB_PREFIX . "order AUTO_INCREMENT = " . (int)$order_id . "");

        $next_order_id = $this->getNextOrderID();

		return $next_order_id;
	}

}
?>
