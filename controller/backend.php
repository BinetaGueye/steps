<?php


class Backend
{

	protected $postManager;

	public function __construct(NewsManagerPDO $nMan)
		{
			$this->postManager = $nMan;
		}


	public function add(News $news)
		{
			
		}
	
	public function edit($id)
		{
			return $this->postManager->getUnique((int) $id);
		}

	public function save(News $news)
		{
			return $this->postManager->save($news);
		}

	
}
