<?php
	class ModelPurchasePendingOrders extends Model {
		public function get_all_pending_orders()
		{
			/*$query = $this->db->query("SELECT
			oc_po_order.order_date
			, oc_po_product.quantity
			, oc_po_order.id
			FROM
				oc_po_order
					INNER JOIN oc_po_product 
						ON (oc_po_order.id = oc_po_product.order_id) WHERE delete_bit = 1 AND pending_bit = 1;");
			
			$pending_orders = $query->rows;
			$total_quantity = 0;
			for($i=0; $i<count($pending_orders); $i++)
			{
				if($pending_orders[$i] != "")
				{
					for($j=0; $j<count($pending_orders); $j++)
					{
						if($pending_orders[$j] != "")
						{
							if($pending_orders[$i]['id'] == $pending_orders[$j]['id'])
							{
								$total_quantity += $pending_orders[$j]['quantity'];
								if($i != $j)
								{
									$pending_orders[$j] = "";
								}
							}
						}
					}
				}
				if($total_quantity != 0)
				{
					$pending_orders[$i]['total_quantity'] = $total_quantity;
					$total_quantity = 0;
				}
			}
			$pending_orders = array_values(array_filter($pending_orders));
			return $pending_orders;*/
			$query = "SELECT
			`oc_po_supplier`.`first_name`
			, `oc_po_supplier`.`last_name`
			, SUM(`oc_po_product`.`quantity`) as total_quantity
			, `oc_po_order`.`order_date`
			, `oc_po_order`.`id`
			, oc_po_order.`pre_supplier_bit`
			FROM
			`oc_po_product`
			INNER JOIN `oc_po_receive_details` 
				ON (`oc_po_product`.`id` = `oc_po_receive_details`.`product_id`)
			INNER JOIN `oc_po_order` 
				ON (`oc_po_order`.`id` = `oc_po_product`.`order_id`)
			INNER JOIN `oc_po_supplier` 
				ON (`oc_po_supplier`.`id` = `oc_po_receive_details`.`supplier_id`) WHERE oc_po_order.`pending_bit` = 1 AND `oc_po_order`.`delete_bit` = 1 GROUP BY (oc_po_order.`id`) ORDER BY (oc_po_order.id) DESC;";
			$query = $this->db->query($query);
			
			return $query->rows;
		}
	}
?>