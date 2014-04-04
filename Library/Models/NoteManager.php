<?php
namespace Library\Models;

use \Library\Entities\Note;
use \Library\Entity;

class NoteManager extends \Library\Manager{
	protected static $instance;

	public static function getInstance($pdo){
		if (!isset(self::$instance)){
			self::$instance = new self($pdo);
		}
		return self::$instance;
	}

	public function add(Entity $note){
		//Securite
		$number = $note->getNote();
		$picture_id = $note->getPicture_id();
		$user_id = $note->getUser_id();

		$req = $this->_db->prepare('INSERT INTO note(id,note,user_id,picture_id) VALUES (NULL, :note, :user_id, :picture_id)');
		$req->bindParam(':note',$number,\PDO::PARAM_INT);
		$req->bindParam(':user_id', $user_id,\PDO::PARAM_INT);
		$req->bindParam(':picture_id', $picture_id,\PDO::PARAM_INT);	
		$req->execute();
	}

	public function delete($id){
		$req = $this->_db->prepare('DELETE FROM note WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();
	}

	public function update(Entity $note){
		//Securite
		$id = $note->getId();
		$number = $note->getNote();

		$req = $this->_db->prepare('UPDATE note SET note = :note WHERE id = :id');
		$req->bindParam(':note',$number,\PDO::PARAM_INT);
		$req->bindParam(':id',$id,\PDO::PARAM_INT);
		$req->execute();
	}

	//Retourne l'object album dont l'ID a été passé en paramètre
	public function get($picture_id,$user_id){
		$req = $this->_db->prepare('SELECT * FROM note WHERE picture_id = :picture_id AND user_id = :user_id');
    	$req->bindParam(':picture_id', $picture_id,\PDO::PARAM_INT);
    	$req->bindParam(':user_id', $user_id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	if($donnee != NULL){
    		return new Note($donnee);
    	}else{
    		return false;
    	}
    	
	}

	public function average($id){
		$req = $this->_db->prepare('SELECT ROUND(AVG(note)) AS AVG FROM note WHERE picture_id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch();
    	return  $donnee['AVG'];
	}
}