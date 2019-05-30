<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
	public function indexAction()
	{
		$error = $this->request->get('error');

		$configs = $this->di->get('config');

		$this->view->hasError = !empty($error);
		$this->view->fcolor = $configs->interface->fcolor;
		$this->view->bcolor = $configs->interface->bcolor;
	}

	public function submitAction()
	{
		$username = $this->request->get('username');
		$password = $this->request->get('password');

		if($username == "salvi@techlaunch.io" && $password == "1234") {
			$this->session->set("username", $username);
			$this->response->redirect("/home");
		} else {
			$this->response->redirect("/login?error=1");
		}
	}

	public function logoutAction()
	{
		$this->session->remove("username");
		$this->session->destroy();

		$this->response->redirect("/login");
	}
}