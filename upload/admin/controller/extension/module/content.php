<?php
class ControllerExtensionModuleContent extends Controller
{
	// этот контроллер выводит обзоры от блогеров, рестаранов и т.д.

	private $error = array();

	public function index()
	{
		$this->load->language('extension/module/content');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('extension/module/content');

		$this->getList();
	}

	public function add()
	{
		$this->load->language('extension/module/content');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/content');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_content->addReview($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/content', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}


	public function edit()
	{
		$this->load->language('extension/module/content');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/content');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_extension_module_content->editReview($this->request->get['id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_price_min'])) {
				$url .= '&filter_price_min=' . $this->request->get['filter_price_min'];
			}

			if (isset($this->request->get['filter_price_max'])) {
				$url .= '&filter_price_max=' . $this->request->get['filter_price_max'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_quantity_min'])) {
				$url .= '&filter_quantity_min=' . $this->request->get['filter_quantity_min'];
			}

			if (isset($this->request->get['filter_quantity_max'])) {
				$url .= '&filter_quantity_max=' . $this->request->get['filter_quantity_max'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_category'])) {
				$url .= '&filter_category=' . $this->request->get['filter_category'];
				if (isset($this->request->get['filter_sub_category'])) {
					$url .= '&filter_sub_category';
				}
			}

			if (isset($this->request->get['filter_manufacturer_id'])) {
				$url .= '&filter_manufacturer_id=' . $this->request->get['filter_manufacturer_id'];
			}

			if (isset($this->request->get['filter_noindex'])) {
				$url .= '&filter_noindex=' . $this->request->get['filter_noindex'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('extension/module/content', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->load->language('extension/module/content');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/content');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $review_id) {
				$this->model_extension_module_content->deleteReview($review_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			$this->response->redirect($this->url->link('extension/module/content', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}

		$this->getList();
	}



	protected function getList()
	{
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['add'] = $this->url->link('extension/module/content/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		$this->load->model('tool/image');
		$data['delete'] = $this->url->link('extension/module/content/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['reviews'] = array();


		$results = $this->model_extension_module_content->getReviews();

		foreach ($results as $result) {

			if (is_file(DIR_IMAGE . $result['company_image'])) {
				$image = $this->model_tool_image->resize($result['company_image'], 100, 100);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}


			$data['reviews'][] = array(
				'review_id' => $result['id'],
				'image'      => $image,
				'name'       => $result['company_name'],
				'frame' => html_entity_decode($result['frame']),

				'status'     => $result['status'] ? $this->language->get('text_enabled_short') : $this->language->get('text_disabled_short'),

				'edit'       => $this->url->link('extension/module/content/edit', 'user_token=' . $this->session->data['user_token'] . '&id=' . $result['id'] . $url, true)
			);
		}

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/content_list', $data));
	}

	protected function getForm()
	{
		$data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		if (isset($this->error['company_name_error'])) {
			$data['company_name_error'] = $this->error['company_name_error'];
		} else {
			$data['company_name_error'] = array();
		}

		if (isset($this->error['company_image_error'])) {
			$data['company_image_error'] = $this->error['company_image_error'];
		} else {
			$data['company_image_error'] = array();
		}

		if (isset($this->error['company_description_error'])) {
			$data['company_description_error'] = $this->error['company_description_error'];
		} else {
			$data['company_description_error'] = array();
		}

		if (isset($this->error['frame_error'])) {
			$data['frame_error'] = $this->error['frame_error'];
		} else {
			$data['frame_error'] = array();
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/module', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/content', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);

		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('extension/module/content/add', 'user_token=' . $this->session->data['user_token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('extension/module/content/edit', 'user_token=' . $this->session->data['user_token'] . '&id=' . $this->request->get['id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('extension/module/content', 'user_token=' . $this->session->data['user_token'] . $url, true);

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$review_info = $this->model_extension_module_content->getReview($this->request->get['id']);
		}

		$data['user_token'] = $this->session->data['user_token'];


		if (isset($this->request->post['company_name'])) {
			$data['company_name'] = $this->request->post['company_name'];
		} elseif (!empty($review_info)) {
			$data['company_name'] = $review_info['company_name'];
		} else {
			$data['company_name'] = '';
		}

		if (isset($this->request->post['company_description'])) {
			$data['company_description'] = $this->request->post['company_description'];
		} elseif (!empty($review_info)) {
			$data['company_description'] = $review_info['company_description'];
		} else {
			$data['company_description'] = '';
		}

		if (isset($this->request->post['frame'])) {
			$data['frame'] = $this->request->post['frame'];
		} elseif (!empty($review_info)) {
			$data['frame'] = $review_info['frame'];
		} else {
			$data['frame'] = '';
		}


		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($product_info)) {
			$data['status'] = $product_info['status'];
		} else {
			$data['status'] = true;
		}

		// Image
		if (isset($this->request->post['company_image'])) {
			$data['company_image'] = $this->request->post['company_image'];
		} elseif (!empty($review_info)) {
			$data['company_image'] = $review_info['company_image'];
		} else {
			$data['company_image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['company_image']) && is_file(DIR_IMAGE . $this->request->post['company_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['company_image'], 100, 100);
		} elseif (!empty($review_info) && is_file(DIR_IMAGE . $review_info['company_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($review_info['company_image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		// Images
		if (isset($this->request->post['review_image'])) {
			$review_images = $this->request->post['review_image'];
		} elseif (isset($this->request->get['id'])) {
			$review_images = $this->model_extension_module_content->getProductImages($this->request->get['id']);
		} else {
			$review_images = array();
		}


		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($product_info)) {
			$data['sort_order'] = $product_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}

		$data['images'] = array();

		foreach ($review_images as $review_image) {
			if (is_file(DIR_IMAGE . $review_image['image'])) {
				$image = $review_image['image'];
				$thumb = $review_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['review_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $review_image['sort_order']
			);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/content_form', $data));
	}

	protected function validateForm(): bool
	{

		if (utf8_strlen($this->request->post['company_name']) == 0) {
			$this->error['company_name_error'] = $this->language->get('name_error_text');
		}

		if (utf8_strlen($this->request->post['company_image']) == 0) {
			$this->error['company_image_error'] = $this->language->get('image_error_text');
		}

		if (utf8_strlen($this->request->post['company_description']) == 0) {
			$this->error['company_description_error'] = $this->language->get('description_error_text');
		}

		if (utf8_strlen($this->request->post['frame']) == 0) {
			$this->error['frame_error'] = $this->language->get('frame_error_text');
		}


		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}


	protected function validateDelete()
	{
		if (!$this->user->hasPermission('modify', 'extension/module/content')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
