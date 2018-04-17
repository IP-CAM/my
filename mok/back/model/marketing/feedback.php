<?php
class ModelMarketingFeedback extends Model {
    public function getTotalFeedback() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "feedback");

        return $query->row['total'];
    }

    public function getFeedbacks($data = array()) {
        $sql = "SELECT feedback_id , content, email, status, created FROM " . DB_PREFIX . "feedback";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " ORDER BY feedback_id DESC";

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function deleteFeedback($feedback_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "feedback WHERE feedback_id = '" . (int)$feedback_id . "'");
    }

    public function getEmail($feedback_id) {
        $query = $this->db->query("SELECT email FROM " . DB_PREFIX . "feedback WHERE feedback_id = '" . (int)$feedback_id . "'");
        return $query->row;
    }
}