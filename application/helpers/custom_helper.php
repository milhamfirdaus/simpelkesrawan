<?php

	function is_login_link(){
		$_this =& get_instance();
		$user_session = $_this->session->userdata;

		if (isset($user_session['sess_member_'])){
			return site_url('dashboard');
		}
		else if (isset($user_session['sess_admin_'])){
			return site_url('dashboard');
		}
		else{
			return site_url('auth');
		}
	}

	function is_login_print(){
		$_this =& get_instance();
		$user_session = $_this->session->userdata;

		if(isset($user_session['sess_member_'])){
			return 'Dashboard';
		}
		else if(isset($user_session['sess_admin_'])){
			return 'Dashboard';
		}else{
			return 'Login';
		}
	}

	function title(){
		$_this =& get_instance();
		global $SConfig;

		$array = array( 'dashboard' => 'Dashboard',
						'geografis' => 'Geografis',
					);
		$title = NULL;
		if(array_key_exists($_this->uri->segment(2), $array)){
			return $array[$_this->uri->segment(2)].' | '.'Simple Kesrawan';
		}
	}

?>