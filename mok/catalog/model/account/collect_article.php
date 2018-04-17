<?php
class ModelAccountCollectArticle extends Model {
	public function addArticle($article_id) {
        $query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->rows) {
            $data = json_decode($query->row['article_id'], true);

            if(!$data){
                $data = array();
            }
            $index = array_search($article_id,$data);

            if($index !== false){
                unset($data[$index]);
                //删除
                $status = 2;
            }else{
                $data[] = $article_id;
                //增加
                $status = 1;
            }
            $this->db->query("UPDATE " . DB_PREFIX . "customer_collect SET article_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        }else{
            $data = array();
            $data[] = $article_id;
            $this->db->query("INSERT " . DB_PREFIX . "customer_collect SET article_id = '" . json_encode($data , true) . "',customer_id = '" . (int)$this->customer->getId() . "'");
            //增加
            $status = 1;
        }

        return $status;
    }

	public function deleteArticle($article_id) {
        $query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        $data = json_decode($query->row['article_id'], true);
        $index = array_search($article_id,$data);
        unset($data[$index]);

        $this->db->query("UPDATE " . DB_PREFIX . "customer_collect SET article_id = '" . json_encode($data , true) . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

    }

	public function getArticle() {
        $query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if($query->row){
            return json_decode($query->row['article_id'], true);
        }else{
            return $data=array();
        }

	}

	public function getTotalArticle() {
        $query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
       if($query->row){
           $data = json_decode($query->row['article_id'], true);
           return count($data);
       }else{
           return '0';
       }

	}

    public function getArticleInfo($blog_id) {
        $query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'blog_id=" . (int)$blog_id . "') AS keyword FROM " . DB_PREFIX . "blog p LEFT JOIN " . DB_PREFIX . "blog_description pd ON (p.blog_id = pd.blog_id) LEFT JOIN " . DB_PREFIX . "blog_ext be ON  be.blog_id = p.blog_id WHERE p.blog_id = '" . (int)$blog_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return $query->row;
    }
	
	public function getWishProduct($article_id){
		$query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
		
		if ($query->num_rows) {
            $data = json_decode($query->row['article_id'], true);
            $index = array_search($article_id,$data);
            if($index !== false){
                return true;
            }else{
                return false;
            }
        }else{
			return false;
		}
	}

    public function is_collect($article_id) {
        $query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "customer_collect WHERE customer_id = '" . (int)$this->customer->getId() . "'");
        if ($query->row['article_id']) {
            $data = json_decode($query->row['article_id'], true);
            if(in_array($article_id ,$data)){
                $status = 1;
            }else{
                $status = 2;
            }
        }else{
            $status = 2;
        }

        return $status;

    }


}
