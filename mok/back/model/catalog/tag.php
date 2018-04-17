<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 18:23
 */
class ModelCatalogTag extends Model {
    public function addTag($tag_info){
        $created = date('Y-m-d H:i:s',time());
        $res=$this->db->query("INSERT INTO " . DB_PREFIX . "tag SET tag_name = '" . $tag_info['tag_name'] . "',tag_type='". $tag_info['tag_type'] ."',seo_title='".$tag_info['seo_title']."',seo_desc='".$tag_info['seo_desc']. "',seo_keyword='".$tag_info['seo_keyword']."',tag_sort='".$tag_info['tag_sort']."',created='".$created."'");
        return $res;
    }

    public function getTotalTag() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "tag");

        return $query->row['total'];
    }

    public function getTags($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "tag";

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

    public function deleteTag($tag_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "tag WHERE video_tag_id = '" . (int)$tag_id . "'");

    }

}