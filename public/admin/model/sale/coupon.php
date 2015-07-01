<?php
class ModelSaleCoupon extends Model {


	public function bulkAddCoupon($sample) {

		foreach ($sample as $key => $data) {
			
	        if($data['discount'] < 0) {
	            $data['discount'] = 0;  
	        }

	        $coupon_info = $this->getCouponByCode($data['code']);
	        
	        if (empty($coupon_info)) {

		        $this->db->query("INSERT INTO " . DB_PREFIX . "coupon SET name = '" . $this->db->escape($data['name']) . "', code = '" . $this->db->escape($data['code']) . "', discount = '" . (float)$data['discount'] . "', type = '" . $this->db->escape($data['type']) . "', total = '" . (float)$data['total'] . "', logged = '" . (int)$data['logged'] . "', shipping = '" . (int)$data['free-shipping'] . "', date_start = '" . $this->db->escape(date('Y-m-d', strtotime(str_replace('/', '-', $data['date_start'])))) . "', date_end = '" . $this->db->escape(date('Y-m-d', strtotime(str_replace('/', '-', $data['date_end'])))) . "', uses_total = '" . (int)$data['uses_total'] . "', uses_customer = '" . (int)$data['uses_customer'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		        $coupon_id = $this->db->getLastId();

		        if(!empty($data['product_id'])){

		            $products = explode(',', $data['product_id']);
		            
		            foreach($products as $productId) {
		                $sql = "INSERT INTO `" . DB_PREFIX . "coupon_product` (coupon_id, product_id) VALUES
		                        ('" . (int)$coupon_id . "', '" . (int)$productId. "')";
		                $this->db->query($sql);
		        	}   
		        }

		        if(!empty($data['category_id'])){

		            $categories = explode(',', $data['category_id']);
		            
		            foreach($categories as $category_id) {
		                $sql = "INSERT INTO `" . DB_PREFIX . "coupon_category` (coupon_id, category_id) VALUES
		                        ('" . (int)$coupon_id . "', '" . (int)$category_id. "')";
		                $this->db->query($sql);
		        	}   
		        }

	       }
	    }  
	}
	
	public function deleteallCoupon() {
      	$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "coupon");
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "coupon_product");		
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "coupon_history");	
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "coupon_category");		
	}

	public function getCoupon($coupon_id) {
      	$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coupon WHERE coupon_id = '" . (int)$coupon_id . "'");
		
		return $query->row;
	}

	public function getlastid() {
      	$query = $this->db->query("SELECT coupon_id FROM " . DB_PREFIX . "coupon ORDER by coupon_id DESC LIMIT 1");
		
		return isset($query->row['coupon_id'])?$query->row['coupon_id']:0;
	}

	public function getCouponByCode($code) {
      	$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coupon WHERE code = '" . $this->db->escape($code) . "'");
		
		return $query->row;
	}

		
}
?>