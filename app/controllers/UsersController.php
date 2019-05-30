<?php

use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
	public function indexAction()
	{
		// force session to be opened
		if( ! $this->session->has("username")) $this->response->redirect("/login");

		// get list of users
		$users = Users::find();

		// send data to the view
		$this->view->users = $users;
	}

	public function addAction()
	{
	}

	public function editAction()
	{
		// get ID to edit
		$id = $this->request->get('id');

		// get the user from the database
		$user = Users::findFirst($id);

		// validate no fields are empty
		if(empty($user)) {
			die("The user selected does not exist");
		}

		// send data to the view
		$this->view->user = $user;
	}

	public function addsubmitAction()
	{
		// get variables from POST
		$username = $this->request->get('username');
		$email = $this->request->get('email');
		$password = $this->request->get('password');

		// validate no fields are empty
		if(empty($username) || empty($email) || empty($password)) {
			die("You need to fill of the required fields");
		}

		// save the new user in the DB
		$user = new Users();
		$user->username = $username;
		$user->email = $email;
		$user->password = md5($password);
		$user->save();

		// redirect to user list
		$this->response->redirect('/users');
	}

	public function editsubmitAction()
	{
		// get variables from POST
		$id = $this->request->get('id');
		$username = $this->request->get('username');
		$email = $this->request->get('email');
		$password = $this->request->get('password');

		// validate no fields are empty
		if(empty($id) || empty($username) || empty($email)) {
			die("You need to fill of the required fields");
		}

		// update the user in the DB
		$user = Users::findFirst($id);
		$user->username = $username;
		$user->email = $email;
		if( ! empty($password)) $user->password = md5($password);
		$user->save();

		// redirect to user list
		$this->response->redirect('/users');
	}

	public function deleteAction()
	{
		// get variables from POST
		$id = $this->request->get('id');

		// validate no fields are empty
		if(empty($id)) {
			die("The user selected does not exist");
		}

		// delete the user from the DB
		$user = Users::findFirst($id);
		$user->delete();

		// redirect to user list
		$this->response->redirect('/users');
	}
}