<?php

class PubPagesController extends BaseController {

	/**
	 * Page Repository
	 *
	 * @var Page
	 */
	protected $page;

	public function __construct(Page $page)
	{
        parent::__construct();

        $this->page = $page;
	}

	public function getView($slug)
	{
	    $page = $this->page->where('slug', $slug)->first();
//        var_dump($page); return;
        return View::make('pages.show', compact('page'));
	}


}
