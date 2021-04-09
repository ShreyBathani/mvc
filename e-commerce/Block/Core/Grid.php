<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends Template
{
    protected $collection = null;
    protected $columns= [];
    protected $buttons= [];
    protected $actions= [];
    protected $filter = null;
    protected $model = null;

    public function __construct()
    {
        $this->setTemplate('View/core/grid.php');
        $this->prepareColumns();
        $this->prepareButtons();
        $this->prepareActions();
    }

    public function getFilter()
    {
        if(!$this->filter)
        {
            $this->filter = \Mage::getModel('Model\Admin\Filter');
        }
        return $this->filter;
    }

    public function setModel()
    {
        return $this;
    }

    public function getModel()
    {
        if (!$this->model) {
            $this->setModel();
        }
        return $this->model;
    }

    public function prepareCollection()
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
	}

    /* public function prepareCollection()
	{
		$model = $this->getModel();
		$query = "SELECT * FROM {$model->getTableName()}";
		if($this->getFilter()->hasFilters())
		{   
            $filters = $this->getFilter()->getFilterValue($model->getTableName());
            $query.=" WHERE 1 = 1";
            if ($filters) {
                foreach ($filters as $field => $filter) {
                    if ($filter) {
                        $query.=" AND (`{$field}` LIKE '%{$filter}%')";
                    }
                }
            }
		}
        echo $query;
		$collection = $model->fetchAll($query);
		$this->setCollection($collection);
		return $this;
	} */

    public function setCollection($collection){
        $this->collection = $collection;
        return $this;
    }

    public function getCollection(){
        if (!$this->collection) {
            $this->prepareCollection();
        }
        return $this->collection;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addColumn($key, $value)
    {
        $this->columns[$key] = $value;
        return $this;
    }

    public function prepareColumns()
    {
        return $this;
    }

    public function getFieldValue($row, $field)
    {
        return $row->$field;
    }
    
    public function addButton($key, $button)
    {
        $this->buttons[$key] = $button;
        return $this;
    }

    public function getButtons()
    {
        return $this->buttons;
    }

    public function prepareButtons()
    {
        return $this;
    }

    public function getButtonUrl($methodName)
    {
        return $this->$methodName();
    }

    public function addAction($key, $action)
    {
        $this->actions[$key] = $action;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function prepareActions()
    {
        return $this;
    }

    public function getMethodUrl($row, $methodName)
    {
        return $this->$methodName($row);
    }

    public function getTitle()
    {
        return 'Manage Module';
    }

}

?>