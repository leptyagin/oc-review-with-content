<?php

class ModelExtensionModuleContent extends Model
{

	public function getReviews()
	{
		$sql = "SELECT * FROM " . DB_PREFIX . "review_content";
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getReview($review_id)
	{
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "review_content WHERE id = '" . (int)$review_id . "' ");

		return $query->row;
	}


	public function getProductImages($review_id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_content_image WHERE content_blogger_id = '" . (int)$review_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}


	public function addReview(array $data)
	{
		$this->db->query("INSERT INTO " . DB_PREFIX . "review_content SET company_name = '" . $this->db->escape($data['company_name']) . "', company_image = '" . $this->db->escape($data['company_image']) . "', company_description = '" . $this->db->escape($data['company_description']) . "', frame = '" . $this->db->escape($data['frame']) . "', status = '" . (int)$data['status'] . "' ");

		$review_id = $this->db->getLastId();

		if (isset($data['review_image'])) {
			foreach ($data['review_image'] as $content_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "review_content_image SET content_blogger_id = '" . (int)$review_id . "', image = '" . $this->db->escape($content_image['image']) . "', sort_order = '" . (int)$content_image['sort_order'] . "'");
			}
		}
	}

	public function editReview($review_id, $data)
	{
		$this->db->query("UPDATE " . DB_PREFIX . "review_content SET company_name = '" . $this->db->escape($data['company_name']) . "', company_image = '" . $this->db->escape($data['company_image']) . "', company_description = '" . $this->db->escape($data['company_description']) . "', frame = '" . $this->db->escape($data['frame']) . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$review_id . "'");


		$this->db->query("DELETE FROM " . DB_PREFIX . "review_content_image WHERE content_blogger_id = '" . (int)$review_id . "'");

		if (isset($data['review_image'])) {
			foreach ($data['review_image'] as $content_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "review_content_image SET content_blogger_id = '" . (int)$review_id . "', image = '" . $this->db->escape($content_image['image']) . "', sort_order = '" . (int)$content_image['sort_order'] . "'");
			}
		}
	}

	public function deleteReview($review_id)
	{
		$this->db->query("DELETE FROM " . DB_PREFIX . "review_content_image WHERE content_blogger_id = '" . (int)$review_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review_content WHERE id = '" . (int)$review_id . "'");
	}
}
