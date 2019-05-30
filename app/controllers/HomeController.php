<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
	public function indexAction()
	{
		// force session to be opened
		if( ! $this->session->has("username")) $this->response->redirect("/login");

		// load configs
		$configs = $this->di->get('config');

		// load the session
		$username = $this->session->get("username");

		// send data to the view
		$this->view->username = $username;
		$this->view->appname = $configs->app->name;
		$this->view->fcolor = $configs->interface->fcolor;
		$this->view->bcolor = $configs->interface->bcolor;
	}
}