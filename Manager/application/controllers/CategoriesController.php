<?php
	class CategoriesController extends Zend_Controller_Action {

		public function editAction() {		
			$db = Zend_Db_Table::getDefaultAdapter();
			// $this->view->nofooter;
			
			$id = $this->getRequest()->getParam('id', '');
   			$this->view->id = $id;


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

				if ($id) {
					$where = "id=$id";
					$update = $this->db->update("arcedior_list", $_sets , $where);	
					if ($update) {
						header('Location : categories/index');
					}
				}
				else{
					$insert = $this->db->insert("arcedior_list", $_sets);
					if ($insert) {
						header('Location : categories/index');
					}
				}
				exit();
			}

			$edit_data = "SELECT * FROM arcedior_list WHERE id='$id'";
			$edit_row = $db->fetchAll($edit_data);
   			$this->view->edit_row = $edit_row;
		}

// indexAction ***************************************************
		public function indexAction() {		
			$db = Zend_Db_Table::getDefaultAdapter();

			// Pagination, Serach bar, Filter ===============================

			$filter_opt = array(5, 10, 50, 100);
			$this->view->filter_opt = $filter_opt;
			
			$page = 5;
			$start = 0;
			$running_page = 1;

			if ($this->getRequest()->getParam('page', '')) {

				$page_get = $this->getRequest()->getParam('page', '');
				if (isset($page_get)) {
					$start = $page_get;
					$running_page = $start;
					$start --;
					$start = $start * $page;
				}
			}

			$first_no = $start + 1;
			$last_no = $page * $running_page;
			
			if ($this->getRequest()->getParam('search_box', '')) {
				$search = $this->getRequest()->getParam('search_box', '');
				if (isset($search)) {

					// search-bar query ========================
					$fetch_query = "SELECT * FROM arcedior_list WHERE name LIKE '%$search%' OR slug LIKE '%$search%' OR parent_category LIKE '%$search%' OR group_category LIKE '%$search%' OR filterable_attributes LIKE '%$search%' OR keywords LIKE '%$search%' OR meta_title LIKE '%$search%' OR meta_description LIKE '%$search%' OR meta_keywords LIKE '%$search%' ORDER BY id DESC LIMIT $start, $page";

					//count-query ==========================
					$count_query = "SELECT count(*) as count_id FROM arcedior_list WHERE name LIKE '%$search%'";
					$pagi_link = "categories/index/search_box/$search&search_btn/";
				}
			}
			else
			{	
				$perpage = $this->getRequest()->getParam('perpage', '');
				if ($perpage) {
					if ($perpage == 5) {
						$page = 5;

						if ($this->getRequest()->getParam('page', '')) {

							$page_get = $this->getRequest()->getParam('page', '');
							if (isset($page_get)) {
								$start = $page_get;
								$running_page = $start;
								$start --;
								$start = $start * $page;
							}
						}

						$fetch_query = "SELECT * FROM arcedior_list ORDEBY id DESC LIMIT $start, $page";
						$count_query = "SELECT count(*) as count_id FROM arcedior_list";
						$pagi_link = "categories/index/perpage/$perpage/page/";

						$last_no = ($page - 0) * $running_page;
						$first_no = $start + 1;

					} elseif ($perpage == 10) {

						$page = 10;
						if ($this->getRequest()->getParam('page', '')) {

							$page_get = $this->getRequest()->getParam('page', '');
							if (isset($page_get)) {
								$start = $page_get;
								$running_page = $start;
								$start --;
								$start = $start * $page;
							}
						}
						$last_no = ($page - 0) * $running_page;
						$first_no = $start + 1;

						$fetch_query = "SELECT * FROM arcedior_list ORDER BY id DESC LIMIT $start, $page";
						$count_query = "SELECT count(*) as count_id FROM arcedior_list";
						$pagi_link = "categories/index/perpage/$perpage/page/"; 
	
					} elseif ($perpage == 50) {
						
						$page = 50;
						if ($this->getRequest()->getParam('page', '')) {

							$page_get = $this->getRequest()->getParam('page', '');
							if (isset($page_get)) {
								$start = $page_get;
								$running_page = $start;
								$start --;
								$start = $start * $page;
								
							}
						}
						$last_no = ($page - 0) * $running_page;
						$first_no = $start + 1;

						$fetch_query = "SELECT * FROM arcedior_list ORDER BY id DESC LIMIT $start, $page";
						$count_query = "SELECT count(*) as count_id FROM arcedior_list";
						$pagi_link = "categories/index/perpage/$perpage/page/";	

					} elseif ($perpage == 100) {
						
						$page = 100;
						if ($this->getRequest()->getParam('page', '')) {

							$page_get = $this->getRequest()->getParam('page', '');
							if (isset($page_get)) {
								$start = $page_get;
								$running_page = $start;
								$start --;
								$start = $start * $page;
							}
						}
						$last_no = ($page - 0) * $running_page;
						$first_no = $start + 1;

						$fetch_query = "SELECT * FROM arcedior_list ORDER BY id DESC LIMIT $start, $page";
						$count_query = "SELECT count(*) as count_id FROM arcedior_list";
						$pagi_link = "categories/index/perpage/$perpage/page/";	
					}
				}
				else
				{
					// fetch query =================
					$fetch_query = "SELECT * FROM arcedior_list ORDER BY id DESC LIMIT $start, $page";

					//count- query ==========================
					$count_query = "SELECT count(*) as count_id FROM arcedior_list";
					$pagi_link = 'categories/index/page/';	
				}
			}
			$this->view->filter = $filter; 
			$this->view->perpage = $perpage;

			// fetch query & search-bar query run===============
			$row = $db->fetchAll($fetch_query);
			$this->view->row = $row;

			// count query run & pagination func. ===============
			$count_raw = $db->fetchAll($count_query);
			foreach ($count_raw as $id) {
			 	$total_id = $id['count_id'];
			}

			$pagination = Core_WC_Pagination::pagination($total_id, $page, $page, $running_page, $pagi_link);

			$this->view->pagination = $pagination; 
			$this->view->total_id = $total_id; 
			$this->view->start = $start;
			$this->view->first_no = $first_no;  
			$this->view->last_no = $last_no; 
		}
	}
?>	