<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$category = new Application_Model_CategoryMapper();
        $this->view->entries = $category->fetchAll();
    }

    public function viewAction()
    {
        $id = $this->getRequest()->getParam('id');
        $category = new Application_Model_CategoryMapper();
        $entry = new Application_Model_Category();
        $entries = $category->find($id, $entry);  ;
        $this->view->entry = $entries[0];
    }


}



