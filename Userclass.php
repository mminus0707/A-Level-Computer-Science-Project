<?php
	class User{

	public $nameuser;
	public $emailuser;
	public $rankuser;
	public $userid;

	public function __construct($nameuser, $emailuser, $rankuser, $userid){
		$this->email = $emailuser;
		$this->name = $nameuser;
		$this->rank = $rankuser; 
		$this->id = $userid;
	}

	public function getName(){
		return $this->name;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getRank(){
		return $this->rank;
	}

	public function getID(){
		return $this->id;
	}

	}
?>