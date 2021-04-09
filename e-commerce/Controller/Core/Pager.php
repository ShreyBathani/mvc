<?php

namespace Controller\Core;

class Pager
{
    protected $totalRecords = null;
    protected $recordsPerPage = null;
    protected $noOfPages = null;
    protected $start = null;
    protected $end = null;
    protected $previous = null;
    protected $next = null;
    protected $currentPage = null;

    public function setTotalRecords($record)
    {
        $this->totalRecords = $record;
        return $this;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function setRecordsPerPage($record)
    {
        $this->recordsPerPage = (int) $record;
        return $this;
    }

    public function getRecordsPerPage()
    {
        return $this->recordsPerPage;
    }

    public function setNoOfPages($page)
    {
        $this->noOfPages = (int) $page;
        return $this;
    }

    public function getNoOfPages()
    {
        return $this->noOfPages;
    }

    public function setStart($start)
    {
        $this->start = (int) $start;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setEnd($end)
    {
        $this->end = (int) $end;
        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setPrevious($previousRecordNo)
    {
        $this->previous = $previousRecordNo;
        return $this;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setNext($nextRecordNo)
    {
        $this->next = $nextRecordNo;
        return $this;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setCurrentPage($page)
    {
        $this->currentPage = (int) $page;
        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function calculate()
    {
        if ($this->getTotalRecords() <= $this->getRecordsPerPage())
        {
            $this->setNoOfPages(1);
            $this->setEnd(null);
            $this->setPrevious(null);
            $this->setNext(null);
            return $this;
        }

        $page = ceil($this->getTotalRecords()/$this->getRecordsPerPage());
        $this->setNoOfPages($page);
        $this->setEnd($page);

        if ($this->getCurrentPage() > $this->getNoOfPages())
        {
            $this->setCurrentPage($this->getNoOfPages());
        }

        if ($this->getCurrentPage() < $this->getStart())
        {
            $this->setCurrentPage($this->getStart());
        }

        if ($this->getCurrentPage() == $this->getStart())
        {
            $this->setStart(null);
            $this->setPrevious(null);

            if ($this->getCurrentPage() < $this->getNoOfPages())
            {
                $this->setNext($this->getCurrentPage() + 1);
            }
            return $this;
        }
        
        if ($this->getCurrentPage() == $this->getEnd())
        {
            $this->setNext(null);
            $this->setEnd(null);
            
            if ($this->getCurrentPage() >= $this->getNoOfPages())
            {
                $this->setPrevious($this->getCurrentPage() - 1);
            }
            return $this;
        }

        if ($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd())
        {
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);
        }
        return $this;
    }

}

// 1    previous = null, start = null, logic(next)
// 2    previous - 1, next + 1
// 3    previous - 1, next + 1
// 4    previous - 1, next + 1
// 5    previous = 4, next = null, end = null

?>