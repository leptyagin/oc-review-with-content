
<?php
class ModelExtensionModuleContent extends Model {

	public function getReviews()
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "review_content WHERE status = 1 ORDER BY id DESC";
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getProductImages($review_id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_content_image WHERE content_blogger_id = '" . (int)$review_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
}