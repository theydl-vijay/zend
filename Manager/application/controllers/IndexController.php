<?php

	class IndexController extends Zend_Controller_Action {
		public function indexAction() {		
			$db = Zend_Db_Table::getDefaultAdapter();
			// $this->view->nofooter;

			if (isset($_POST['submit'])) {

				if ($this->getRequest()->isPost()) {
					$data = $this->_request->getPost();

					$_sets = array();
					$_sets['image'] = $data['image'];
					$_sets['name'] = $data['name'];
					$_sets['slug'] = $data['slug'];
					$_sets['parent_category'] = $data['parent_category'];
					$_sets['group_category'] = $data['group_category'];
					$_sets['filterable_attributes'] = $data['filterable_attributes'];
					$_sets['keywords'] = $data['keywords'];
					$_sets['featured_brands'] = $data['featured_brands'];
					$_sets['meta_image'] = $data['meta_image'];
					$_sets['meta_title'] = $data['meta_title'];
					$_sets['meta_description'] = $data['meta_description'];
					$_sets['meta_keywords'] = $data['meta_keywords'];
		
					$this->db->insert("arcedior-list", $_sets);
				}
			}
		}
		


	}
?>