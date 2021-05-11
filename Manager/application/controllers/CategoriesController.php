<?php
	class CategoriesController extends Zend_Controller_Action {
		public function editAction() {		
			$db = Zend_Db_Table::getDefaultAdapter();
			$this->view->nofooter;

			if (isset($_POST['submit'])) {

				if ($this->getRequest()->isPost()) {
					$data = $this->_request->getPost();

					$image_main_file = $_FILES['image']['name'];
					$image_temp_file = $_FILES['image']['tmp_name'];
					$image_saveimg = "saveimg/".$image_main_file;
					move_uploaded_file($image_temp_file, $image_saveimg);

					$featured_main_file = $_FILES['featured_brands']['name'];
					$featured_temp_file = $_FILES['featured_brands']['tmp_name'];
					$featured_saveimg = "saveimg/".$featured_main_file;
					move_uploaded_file($featured_temp_file, $featured_saveimg);

					$meta_file_name = $_FILES['meta_image']['name'];
					$meta_image_temp_file = $_FILES['meta_image']['tmp_name'];
					$meta_saveimg = "saveimg/".$meta_file_name;
					move_uploaded_file($meta_image_temp_file, $meta_saveimg);

					$_sets = array();
					$_sets['image'] =  $image_saveimg;
					$_sets['name'] = $data['name'];
					$_sets['slug'] = $data['slug'];
					$_sets['parent_category'] = $data['parent_category'];
					$_sets['group_category'] = $data['group_category'];
					$_sets['filterable_attributes'] = $data['filterable_attributes'];
					$_sets['keywords'] = $data['keywords'];
					$_sets['featured_brands'] = $featured_saveimg;
					$_sets['meta_image'] = $meta_saveimg;
					$_sets['meta_title'] = $data['meta_title'];
					$_sets['meta_description'] = $data['meta_description'];
					$_sets['meta_keywords'] = $data['meta_keywords'];
					
					$this->db->insert("arcedior_list", $_sets);
				}
			}

		}
		public function indexAction() {		
		$db = Zend_Db_Table::getDefaultAdapter();
		
		$fetch_data = "SELECT * FROM arcedior_list ORDER BY id DESC";
		$row = $db->fetchAll($fetch_data);

		$this->view->row = $row; 
		}
	}
?>