<?php

class Superadmin extends Controller {

	protected function Index() {

		if(!isset($_SESSION['is_logged_in']) || $_SESSION['admin'] != 1){
			header('Location: '.ROOT_URL);
		}

		$viewmodel = new SuperadminModel();
 
		$this->returnView($viewmodel->Index(), true);	

	}

	protected function logout() {

		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user']);
		session_destroy();
		// Redirect
		header('Location: '.ROOT_URL);
		
	}

	protected function addteachers() {

		$viewmodel = new SuperadminModel();
		$this->returnView($viewmodel->addteachers(), true);	

	}

}