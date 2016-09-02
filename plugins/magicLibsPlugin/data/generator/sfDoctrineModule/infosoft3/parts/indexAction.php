  public function executeIndex(sfWebRequest $request)
  {
    
 		//----------- Clear selected ids from session -----------------
		$this->batch_ids = $this->getUser()->getAttribute('ids', array());
		$this->getUser()->setAttribute('ids', array());
		//-------------------------------------------------------------

    // sorting
    $sort = $request->getParameter('sort', false);
    if ($sort && ($this->isValidSortColumn($sort) || $this->isValidCustomSortColumn($sort)))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
