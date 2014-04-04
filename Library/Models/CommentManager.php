<?php
namespace Library\Models;

use \Library\Entities\Comment;
use \Library\Entity;

class CommentManager extends \Library\Manager{
	protected static $instance;

	public static function getInstance($pdo){
		if (!isset(self::$instance)){
			self::$instance = new self($pdo);
		}
		return self::$instance;
	}

	public function add(Entity $comment){
		
		//Securite
		$picture_id = $comment->getPicture_id();
		$user_id = $comment->getUser_id();
		$text = $comment->getComment();
		$date = $comment->getDate_publish();

		$req = $this->_db->prepare('INSERT INTO comment(id,picture_id,user_id,comment,date_publish) VALUES (NULL, :picture_id, :user_id,:comment,:date_publish)');
		$req->bindParam(':picture_id',$picture_id,\PDO::PARAM_INT);
		$req->bindParam(':user_id',$user_id,\PDO::PARAM_INT);
		$req->bindParam(':comment',$text,\PDO::PARAM_STR);
		$req->bindParam(':date_publish',$date,\PDO::PARAM_STR);	
		$req->execute();
	}

	public function delete($id){
		$req = $this->_db->prepare('DELETE FROM comment WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();
	}

	public function update(Entity $comment){
		//Securite
		$id = $comment->getId();
		$comment = $comment->getComment();
		$date = $comment->getDate_publish();

		$req = $this->_db->prepare('UPDATE comment SET  comment = :comment, date_update = :date_update  WHERE id = :id');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':email',$description,\PDO::PARAM_STR);
		$req->bindParam(':password',$public,\PDO::PARAM_STR);
		$req->bindParam(':avatar',$public,\PDO::PARAM_STR);
		$req->bindParam(':id',$id,\PDO::PARAM_INT);
		$req->execute();
	}

	//Retourne l'object album dont l'ID a été passé en paramètre
	public function get($id){
		$req = $this->_db->prepare('SELECT user_id, comment, date_publish, date_update FROM comment WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new Comment($donnee);
	}

	public function getAll($picture_id){
		$comments = array();

		$req = $this->_db->prepare('SELECT c.comment,  DATE_FORMAT(c.date_publish, \'Le %d/%m/%Y à %Hh%i\') AS date_fr, c.date_update, u.name, u.avatar FROM comment c INNER JOIN user u ON u.id = c.user_id WHERE c.picture_id = :picture_id ORDER BY date_publish');
		$req->bindParam(':picture_id', $picture_id,\PDO::PARAM_INT);
		$req->execute();

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$comments[] = $donnees;
	    }

		return $comments;
	}
}