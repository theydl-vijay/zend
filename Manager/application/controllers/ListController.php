<?php

class ListController extends Zend_Controller_Action
{
	public function indexAction() {		
		$db = Zend_Db_Table::getDefaultAdapter();
	}

	public function listAction() {		
		$db = Zend_Db_Table::getDefaultAdapter();
		
		$fetch_data = "SELECT * FROM arcedior_list ORDER BY id DESC";
		$row = $db->fetchAll($fetch_data);

		$this->view->row = $row; 
	}
}

?>