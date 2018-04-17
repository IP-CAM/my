<?php
class ModelCmsBuyer extends Model {
	public function addBuyerInfo($user_id,$data) {

		foreach ($data['buyer_info'] as $language_id => $value) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "buyer_info SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', nickname = '" . $this->db->escape($value['nickname']) . "', intro = '" . $this->db->escape($value['intro']) . "',  introduce = '" . $this->db->escape($value['introduce']) . "', head_image = '" . $value['head_image'] . "', show_image = '" . $value['show_image'] . "', modified_date = NOW()");
		}

        return $this->db->getLastId();
	}

    public function editBuyerInfo($user_id,$data ,$buyer_id) {

        foreach ($data['buyer_info'] as $language_id => $value) {

            $this->db->query("UPDATE " . DB_PREFIX . "buyer_info SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', nickname = '" . $this->db->escape($value['nickname']) . "', intro = '" . $this->db->escape($value['intro']) . "',  introduce = '" . $this->db->escape($value['introduce']) . "', head_image = '" . $this->db->escape($value['head_image']) . "', show_image = '" . $this->db->escape($value['show_image']) . "', modified_date = NOW() WHERE buyer_info_id='".$buyer_id."'");
        }

        return $this->db->getLastId();
    }

    public function getBuyerInfo($buyer_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_info WHERE buyer_info_id = '".(int)$buyer_id ."'");

        return $query->row;
    }

    public function getBuyerBlog($blog_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog WHERE buyer_blog_id ='".(int)$blog_id ."'");

        return $query->row;
    }

    public function getBuyerBlogByBuyer($buyer_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog WHERE buyer_info_id ='".(int)$buyer_id ."'");

        return $query->row;
    }

    public function addBuyerblog($user_id,$data) {

        foreach ($data['buyer_blog'] as $language_id => $value) {

            $this->db->query("INSERT INTO " . DB_PREFIX . "buyer_blog SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', image = '" . $value['image'] . "', product_id = '" . $value['product_related'][0] . "', buyer_info_id ='".(int)$data['buyer_info_id']."' , add_date = NOW()");
        }

        return $this->db->getLastId();
    }

    public function getBuyerBlogTotal($user_id) {
        $query = $this->db->query("SELECT  count(*) as total FROM " . DB_PREFIX . "buyer_blog WHERE user_id = '".(int)$user_id ."' ORDER BY buyer_blog_id DESC");

        return $query->row['total'];
    }

    public function getBuyerBlogs($user_id) {
        $query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "buyer_blog WHERE user_id = '".(int)$user_id."' ORDER BY buyer_blog_id DESC");

        return $query->rows;
    }

    public function getAllBuyerBlogTotal() {
        $query = $this->db->query("SELECT  count(*) as total FROM " . DB_PREFIX . "buyer_blog");

        return $query->row['total'];
    }

    public function getAllBuyerBlogs($data = array()) {
        $sql = "SELECT  * FROM " . DB_PREFIX . "buyer_blog  WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_title'])) {
            $sql .= " AND title LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
        }

        $sql .= " ORDER BY buyer_blog_id DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getBuyerInfoTotal() {
        $query = $this->db->query("SELECT  count(*) as total FROM " . DB_PREFIX . "buyer_info");

        return $query->row['total'];
    }

    public function getAllBuyerInfo($data=array()) {
        $sql = "SELECT  * FROM " . DB_PREFIX . "buyer_info WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (!empty($data['filter_title'])) {
            $sql .= " AND nickname LIKE '%" . $this->db->escape($data['filter_title']) . "%'";
        }

        $sql .= " ORDER BY buyer_info_id DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function editBuyerblog($user_id,$data , $blog_id) {

        foreach ($data['buyer_blog'] as $language_id => $value) {

            $this->db->query("UPDATE " . DB_PREFIX . "buyer_blog SET user_id = '" . (int)$user_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', image = '" . $value['image'] . "', product_id = '" . $value['product_related'][0]  . "', add_date = NOW() WHERE buyer_blog_id='".$blog_id."'");
        }

        return $this->db->getLastId();
    }

    public function deleteBuyerBlog($blog_id) {

        $this->db->query("DELETE FROM " . DB_PREFIX . "buyer_blog WHERE buyer_blog_id = '" . (int)$blog_id . "'");

        $this->cache->delete('buyer_blog');

    }

    public function deleteBuyerInfo($buyer_id) {

        $this->db->query("DELETE FROM " . DB_PREFIX . "buyer_info WHERE buyer_info_id = '" . (int)$buyer_id . "'");

        $this->cache->delete('buyer_info');

    }
	
}