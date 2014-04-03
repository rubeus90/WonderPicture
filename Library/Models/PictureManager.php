<?php
namespace Library\Models;

use \Library\Entities\Picture;
use \Library\Entity;

class PictureManager extends \Library\Manager{

	public function add(Entity $image){

		//Securite
		$name = $image->getName();
		$description = $image->getDescription();
		$url = $image->getUrl();
		$urlmin = $image->getUrlmin();
		$type = $image->getType();
		$size = (int) $image->getSize();
		$width = (int) $image->getWidth();
		$height = (int) $image->getHeight();
		$dateimport = $image->getDate_import();
		$public = (int) $image->isPublic();
		$albumid = (int) $image->getAlbum_id();

		$req = $this->_db->prepare('INSERT INTO picture(id,name,description,url,urlmin,type,size,width,height,date_import,public,album_id) VALUES (NULL, :name, :description, :url, :urlmin, :type, :size, :width, :height, :date_import, :public, :album_id)');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':description',$description,\PDO::PARAM_STR);
		$req->bindParam(':url',$url,\PDO::PARAM_STR);
		$req->bindParam(':urlmin',$urlmin,\PDO::PARAM_STR);
		$req->bindParam(':type',$type,\PDO::PARAM_STR);
		$req->bindParam(':size',$size,\PDO::PARAM_INT);
		$req->bindParam(':width',$width,\PDO::PARAM_INT);
		$req->bindParam(':height',$height,\PDO::PARAM_INT);
		$req->bindParam(':date_import',$dateimport,\PDO::PARAM_STR);
		$req->bindParam(':public',$public,\PDO::PARAM_INT);
		$req->bindParam(':album_id',$albumid,\PDO::PARAM_INT);
		$req->execute();
	}

	public function delete($id){
		$req = $this->_db->prepare('DELETE FROM picture WHERE id = :id');
    	$req->bindParam(':id', $id, \PDO::PARAM_INT);
    	$req->execute();
	}

	public function update(Entity $image){
		//Securite
		$name = $image->getName();
		$description = $image->getDescription();
		$public = $image->isPublic() ? 1 : 0;
		$albumid = (int) $image->getAlbum_id();
		$id = (int) $image->getId();

		$req = $this->_db->prepare('UPDATE picture SET name = :name, description = :description, public = :public, album_id = :album_id WHERE id = :id');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':description',$description,\PDO::PARAM_STR);
		$req->bindParam(':public',$public,\PDO::PARAM_INT);
		$req->bindParam(':album_id',$albumid,\PDO::PARAM_INT);
		$req->bindParam(':id',$id,\PDO::PARAM_INT);
		$req->execute();
	}

	//Supprime toutes les photos de l'album dont l'ID a été passé en paramètre
	public function deleteAlbum($album_id){
		$req = $this->_db->prepare('DELETE FROM picture WHERE album_id = :album_id');
    	$req->bindParam(':album_id', $album_id, \PDO::PARAM_INT);
    	$req->execute();
	}	


	//Retourne une liste de tous les objects images classé par album_id
	public function getAllOrder(){
		$pictures = array();

		$req = $this->_db->query('SELECT * FROM picture ORDER BY album_id' );

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$pictures[] = new Picture($donnees);
	    }

		return $pictures;
	}

	public function get($id){
		$req = $this->_db->prepare('SELECT * FROM picture WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new Picture($donnee);
	}


	//Retourne l'ID de l'image dont le titre a été passé en paramètre
	public function getByTitle($title){
		$req = $this->_db->prepare('SELECT *, DATE_FORMAT(date_import, \'Le %d/%m/%Y à %Hh%i\') AS date_import FROM picture WHERE name = :title');
    	$req->bindParam(':title', $title,\PDO::PARAM_STR);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new Picture($donnee);
	}

	public function getLast($limit,$connecting){
		$pictures = array();
		
		$req = ($connecting) ? $this->_db->query('SELECT name, url, urlmin FROM picture ORDER BY date_import DESC LIMIT '.$limit) : $this->_db->query('SELECT name, url, urlmin FROM picture WHERE public = 1 ORDER BY date_import DESC LIMIT '.$limit);

    	while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$pictures[] = new Picture($donnees);
	    }

    	return $pictures;
	}

	//Retourne la liste des objects Pictures qui appartiennt à l'ID de l'album passé en paramètre
	public function getAlbum($album_id, $order){
		$pictures = array();

		$req = $this->_db->prepare('SELECT * FROM picture WHERE album_id = :id ORDER BY '.$order);
		$req->bindParam(':id',$album_id,\PDO::PARAM_INT);
		$req->execute();

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$pictures[] = new Picture($donnees);
	    }

	    return $pictures;
	}

	//Retourne la liste des objects Pictures PUBLIC qui appartiennt à l'ID de l'album passé en paramètre
	public function getAlbumPublic($album_id, $order){
		$pictures = array();

		$req = $this->_db->prepare('SELECT id, name,url, urlmin FROM picture WHERE album_id = :id AND public = 1 ORDER BY '.$order);
		$req->bindParam(':id',$album_id,\PDO::PARAM_INT);
		$req->execute();

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$pictures[] = new Picture($donnees);
	    }

	    return $pictures;
	}

	//Test si l'image exist
	public function exist($title){
		$req = $this->_db->prepare('SELECT id  FROM picture WHERE name = :title');
    	$req->bindParam(':title', $title,\PDO::PARAM_STR);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return ($donnee['id'] != NULL) ? true : false;
	}
}