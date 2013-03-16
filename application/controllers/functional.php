<?php

class Functional_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('functional.index');
	}

}
