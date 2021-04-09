<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName('Block\Core\Grid');

Class Grid extends \Block\Core\Grid
{
    public function setModel()
    {
        $this->model = \Mage::getModel('Model\Admin');
    }

    /* public function prepareCollection()
	{
		$model = $this->getModel();
		$query = "SELECT * FROM {$model->getTableName()}";
		if($this->getFilter()->hasFilters())
		{
			$query.=" WHERE 1 = 1";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if($type == 'text')
                {
                    foreach ($filters as $key => $value) {
                        $query.=" AND (`{$key}` LIKE '%{$value}%')";
                    }
                }
                if($type == 'number')
                {
                    foreach ($filters as $key => $value) {
                        $query.=" AND (`{$key}` = '{$value}')";
                    }
                }
            }
		}
		$collection = $model->fetchAll($query);
		$this->setCollection($collection);
		return $this;
	} */

    /* public function prepareCollection()
    {
        $admin = \Mage::getModel('Model\Admin');
        $collection = $admin->fetchAll();
        $this->setCollection($collection);
        return $this;
    } */

    public function prepareColumns()
    {
        $this->addColumn('adminId', [
            'field' => 'adminId',
            'label' => 'Admin Id',
            'type' => 'number'
        ]);
        $this->addColumn('userName', [
            'field' => 'userName',
            'label' => 'Username',
            'type' => 'text'
        ]);
        $this->addColumn('password', [
            'field' => 'password',
            'label' => 'Password',
            'type' => 'text'
        ]);
        $this->addColumn('status', [
            'field' => 'status',
            'label' => 'Status',
            'type' => 'text'
        ]);
        return $this;
    }

    public function prepareButtons()
    {
        $this->addButton('addNew',[
            'label' => 'Add New',
            'class' => 'btn btn-success',
            'method' => 'getAddNewUrl',
            'ajax' => true,
        ]);
        /* $this->addButton('applyFilter',[
            'label' => 'Applly Filter1',
            'class' => 'btn btn-success ml-2',
            'method' => 'getFilterUrl',
            'ajax' => true,
        ]); */
        return $this;
    }
    
    public function getAddNewUrl()
    {
        return $this->geturl('form', null, null, true);
    }

    public function getFilterUrl()
    {
        return $this->geturl('filter', null, null, true);
    }

    public function prepareActions()
    {
        $this->addAction('edit',[
            'label' => '<i class=\'far fa-edit\'></i>',
            'class' => 'btn btn-success',
            'method' => 'getEditUrl',
            'ajax' => true,
        ]);
        $this->addAction('delete',[
            'label' => '<i class=\'fas fa-trash-alt\'></i>',
            'class' => 'btn btn-danger',
            'method' => 'getDeleteUrl',
            'ajax' => true,
        ]);
        return $this;
    }

    public function getEditUrl($row)
    {
        return $this->geturl('form', null, ['adminId' => $row->adminId], true);
    }
    
    public function getDeleteUrl($row)
    {
        return $this->geturl('delete', null, ['adminId' => $row->adminId], true);
    }

    public function getTitle()
    {
        return 'Manage Admin';
    }
}

?>