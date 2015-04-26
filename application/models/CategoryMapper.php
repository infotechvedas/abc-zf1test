<?php

class Application_Model_CategoryMapper
{
	protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Category');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Category $category)
    {
        $data = array(
            'name'   => $category->getName(),
            'desc' => $category->getdesc(),
            'createddt' => date('Y-m-d H:i:s'),
            'updateddt' => date('Y-m-d H:i:s'),
        );
 
        if (null === ($id = $category->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Category $category)
    {
        $result = $this->getDbTable()->find($id);
        $entries   = array();
        if (0 == count($result)) {
            return;
        }
        $row = $result->current(); 
        $category->setId($row->id)
                  ->setName($row->name)
                  ->setDesc($row->desc)
                  ->setCreateddt($row->createddt)
				  ->setUpdateddt($row->updateddt);
        $entries[] = $category;
        return $entries;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setDesc($row->desc)
				  ->setCreateddt($row->createddt)
				  ->setUpdateddt($row->updateddt);
            $entries[] = $entry;
        }
        return $entries;
    }
}

