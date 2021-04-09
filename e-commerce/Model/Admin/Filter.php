<?php

namespace Model\Admin;

\Mage::LoadFileByClassName('Model\Admin\Session');

class Filter extends Session
{
	public function setFilters($filters)
	{
		if(!$filters)
		{
			return false;
		}
		$filters = array_filter(array_map(function($value){
			return array_filter($value);
		},$filters));
		$this->filters = $filters;
		return $this;
	}

	public function getFilters()
	{
		return $this->filters;
	}

	public function hasFilters()
	{
		if(!$this->filters)
		{
			return false;
		}
		return true;
	}

	public function getFilterValue($type,$key)
	{
		if(!$this->filters)
		{
			return null;
		}
		if(!array_key_exists($type,$this->filters))
		{
			return null;
		}
		if(!array_key_exists($key,$this->filters[$type]))
		{
			return null;
		}
		return $this->filters[$type][$key];
	}

	public function unsetFilters()
    {
        unset($this->filters);
        return $this;;
    }

	/* public function getFilterValue($tableName = null, $key = null)
    {	
		if (is_array($this->filters)) {
			if ($tableName) {
				if (array_key_exists($tableName, $this->filters)) {
					if ($key) {
						if (array_key_exists($key, $this->filters[$tableName])) {
							return $this->filters[$tableName][$key];
                        }
						return null;
                    }
					return $this->filters[$tableName];
                }
				return null;
            }
        }
        return $this->filters;
    } */

    /* public function clearFilters($tableName = null)
    {
        if ($tableName) {
            unset($_SESSION[$this->getNameSpace()]['filters'][$tableName]);
            return $this;
        }
        unset($this->filters);
        return;
    } */
}

?>