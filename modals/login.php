<?php

class LoginModel extends Model{

	public function Index() {

		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);	

		if($post['submit']) {

			if ( $post['userType'] == 'student' ) {

				$this->query('SELECT * FROM users WHERE username = :username AND password = :password;');
				$this->bind(':username', $post['username']);
				$this->bind(':password', $post['password']);
				
				$row = $this->single();

				$admin = 0;

			}

			else {

				$this->query('SELECT * FROM Admins WHERE username = :username AND password = :password;');
				$this->bind(':username', $post['username']);
				$this->bind(':password', $post['password']);
				
				$row = $this->single();

				$admin = 1;

			}


			if($row){

				$_SESSION['is_logged_in'] = true;

				if ($admin == 1) {
					$_SESSION['user'] = $row['username'];
					unset($_SESSION['class']);
					$_SESSION['class'] = $row['Class'];
					$_SESSION['admin'] = 1;	
					
					if($_SESSION['user'] == "sadmin")				
						header('Location: '.ROOT_URL.'?controller=superadmin');
					else
						header('Location: '.ROOT_URL.'?controller=admin');
				} 

				else {
					$_SESSION['user'] = $row['Username'];
					header('Location: '.ROOT_URL.'?controller=home');
				}

			}

			else {
				Messages::setMsg('Incorrect Login', 'error');
			}

		}

		return;

	}

}

