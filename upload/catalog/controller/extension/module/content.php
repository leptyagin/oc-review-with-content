<?php
class ControllerExtensionModuleContent extends Controller {
	public function index() {
        $this->load->language('extension/module/content');
		$this->load->model('extension/module/content');

		$data['reviews'] = array();
		$results = $this->model_extension_module_content->getReviews();

		foreach ($results as $result) {

			$images_data = array();

			if($result['id']) {
				$images = $this->model_extension_module_content->getProductImages($result['id']);

				foreach ($images as $image) {
					$images_data[] = array(
						'url' => 'image/' . $image['image'],
						'sort_order' => $image['sort_order'],
					);
				}
			}

			if ($result['company_image']) {
				$image = 'image/' . $result['company_image'];
			} else {
				$image = 'image/no_image.png';
			}

			$data['reviews'][] = array(
				'review_id'  => $result['id'],
				'image'      => $image,
				'name'       => $result['company_name'],
				'description'       => $result['company_description'],
				'images'	 => $images_data,
				'frame'		 => html_entity_decode($result['frame']),
			);
		}

		return $this->load->view('extension/module/content', $data);
	}
}