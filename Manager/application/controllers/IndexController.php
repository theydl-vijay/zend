<?php

class IndexController extends Zend_Controller_Action
{
	public function indexAction() {		
		$db = Zend_Db_Table::getDefaultAdapter();
		// $this->view->nofooter;

		$image = "";
		$name = "";
		$slug = "";
		$parent_category = "";
		$group_category = "";
		$filterable_attributes = "";
		$keywords = "";
		$featured_brands = "";
		$meta_image = "";
		$meta_title = "";
		$meta_description = "";
		$meta_keywords = "";

		if (isset($_POST['submit'])) {

			if ($this->getRequest()->isPost()) {

				$image = $this->_request->getPost('image');
				$name = $this->_request->getPost('name');
				$slug = $this->_request->getPost('slug');
				$parent_category = $this->_request->getPost('parent_category');
				$group_category = $this->_request->getPost('group_category');
				$filterable_attributes = $this->_request->getPost('filterable_attributes');
				$keywords = $this->_request->getPost('keywords');
				$featured_brands = $this->_request->getPost('featured_brands');
				$meta_image = $this->_request->getPost('meta_image');
				$meta_title = $this->_request->getPost('meta_title');
				$meta_description = $this->_request->getPost('meta_description');
				$meta_keywords = $this->_request->getPost('meta_keywords');

				$_sets = array();
				$_sets['image'] = $image;
				$_sets['name'] = $name;
				$_sets['slug'] = $slug;
				$_sets['parent_category'] = $parent_category;
				$_sets['group_category'] = $group_category;
				$_sets['filterable_attributes'] = $filterable_attributes;
				$_sets['keywords'] = $keywords;
				$_sets['featured_brands'] = $featured_brands;
				$_sets['meta_image'] = $meta_image;
				$_sets['meta_title'] = $meta_title;
				$_sets['meta_description'] = $meta_description;
				$_sets['meta_keywords'] = $meta_keywords;
				// die();
				echo json_encode($_sets);

				// die();
				$this->db->insert("arcedior-list", $_sets);
			}
		}
	}
}
?>