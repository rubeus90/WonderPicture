<?php
class AlbumManager{
	private $_db

	public function __construct($db){
		$this->setDb($db);
	}

	public function add(Album $album){

	}

	public function delete(Album $album){

	}

	public function get(Album $album){

	}

	public function update(Album $album)
	{
	
	}

	public function setDb(PDO $db)
	{
    	$this->_db = $db;
  	}
}