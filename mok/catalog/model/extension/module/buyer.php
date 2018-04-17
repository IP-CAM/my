<?php
class ModelExtensionModuleBuyer extends Model {
	public function addBuyerInfo($user_id,$data) {

		foreach ($data['buyer_info'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "buyer_info SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', nickname = '" . $this->db->escape($value['nickname']) . "', intro = '" . $this->db->escape($value['intro']) . "',  introduce = '" . $this->db->escape($value['introduce']) . "', head_image = '" . $value['head_image'] . "', show_image = '" . $value['show_image'] . "', modified_date = NOW()");
		}

        return $this->db->getLastId();
	}

    public function editBuyerInfo($user_id,$data , $buyer_id) {

        foreach ($data['buyer_info'] as $language_id => $value) {

            $this->db->query("UPDATE " . DB_PREFIX . "buyer_info SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', nickname = '" . $this->db->escape($value['nickname']) . "', intro = '" . $this->db->escape($value['intro']) . "',  introduce = '" . $this->db->escape($value['introduce']) . "', head_image = '" . $this->db->escape($value['head_image']) . "', show_image = '" . $this->db->escape($value['show_image']) . "', modified_date = NOW() WHERE buyer_info_id='".(int)$buyer_id."'");
        }

        return $this->db->getLastId();
    }

    public function getBuyerInfo($buyer_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_info WHERE buyer_info_id = '".(int)$buyer_id ."'");

        return $query->row;
    }

    public function getBuyerBlog($user_id ,$blog_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog WHERE user_id = '".(int)$user_id ."' AND buyer_blog_id ='".(int)$blog_id ."'");

        return $query->row;
    }

    public function addBuyerblog($user_id,$data) {

        foreach ($data['buyer_blog'] as $language_id => $value) {

            $this->db->query("INSERT INTO " . DB_PREFIX . "buyer_blog SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', image = '" . $value['image'] . "', product_id = '" . $data['product_related'][0] . "', add_date = NOW()");
        }

        return $this->db->getLastId();
    }

    public function getBuyerBlogTotal($user_id) {
        $query = $this->db->query("SELECT  count(*) as total FROM " . DB_PREFIX . "buyer_blog WHERE buyer_info_id = '".(int)$user_id ."'");

        return $query->row['total'];
    }

    public function getBuyerBlogs($user_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog WHERE buyer_info_id = '".(int)$user_id."'");

        return $query->rows;
    }

    public function editBuyerblog($user_id,$data , $blog_id) {

        foreach ($data['buyer_blog'] as $language_id => $value) {

            $this->db->query("UPDATE " . DB_PREFIX . "buyer_blog SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', image = '" . $value['image'] . "', product_id = '" . $data['product_related'][0] . "', add_date = NOW() WHERE buyer_blog_id='".$blog_id."'");
        }

        return $this->db->getLastId();
    }

    public function getAllBuyerBlogs() {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog ORDER BY buyer_blog_id DESC LIMIT 5");

        return $query->rows;
    }
	
}