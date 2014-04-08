<?php
namespace Library\Models;

use \Library\Entities\Album;
use \Library\Entity;

class AlbumManager extends \Library\Manager{
	protected static $instance;

	public function add(Entity $album){
		
		//Securite
		$name = $album->getName();
		$description = $album->getDescription();
		$datecreate = $album->getDate_create();
		$public = $album->isPublic() ? 1 : 0;
		$thumb = $album->getThumb();

		$req = $this->_db->prepare('INSERT INTO album(id,name,description,public,date_create,thumb) VALUES (NULL, :name, :description,:public,:date_create, :thumb)');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':description',$description,\PDO::PARAM_STR);
		$req->bindParam(':public',$public,\PDO::PARAM_INT);
		$req->bindParam(':date_create',$datecreate,\PDO::PARAM_STR);
		$req->bindParam(':thumb',$thumb,\PDO::PARAM_STR);		
		$req->execute();
	}

	public function delete($id){
		$req = $this->_db->prepare('DELETE FROM album WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();
	}

	public function update(Entity $album){
		//Securite
		$name = $album->getName();
		$description = $album->getDescription();
		$public = $album->isPublic() ? 1 : 0;
		$id = (int) $album->getId();
		$thumb = $album->getThumb();

		$req = $this->_db->prepare('UPDATE album SET name = :name, description = :description, public = :public WHERE id = :id');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':description',$description,\PDO::PARAM_STR);
		$req->bindParam(':public',$public,\PDO::PARAM_INT);
		$req->bindParam(':id',$id,\PDO::PARAM_INT);
		$req->execute();
	}

	//Retourne l'object album dont l'ID a été passé en paramètre
	public function get($id){
		$req = $this->_db->prepare('SELECT id, name, description,public FROM album WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new Album($donnee);
	}

	//Retourn l'object album dont le titre de l'album passé en paramètre
	public function getByTitle($title){
		$req = $this->_db->prepare('SELECT id, name, description, public FROM album WHERE name = :title');
    	$req->bindParam(':title', $title,\PDO::PARAM_STR);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new Album($donnee);
	}

	//Retourne la liste de tous les albums
	public function getAll($order){
		$albums = array();

		$req = $this->_db->query('SELECT id, name, description, thumb,public FROM album ORDER BY '.$order);

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$albums[] = new Album($donnees);
	    }

		return $albums;
	}

	//Retourne la liste de tous les albums public
	public function getAllPublic($order){
		$albums = array();

		$req = $this->_db->query('SELECT id, name, description, thumb FROM album WHERE public = 1 ORDER BY '.$order);

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$albums[] = new Album($donnees);
	    }

		return $albums;
	}

	//Test si un album exist
	public function exist($title){
		$req = $this->_db->prepare('SELECT id  FROM album WHERE name = :title');
    	$req->bindParam(':title', $title,\PDO::PARAM_STR);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return ($donnee['id'] != NULL) ? true : false;
	}
}