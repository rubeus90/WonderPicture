<?php
namespace Library\Models;

use \Library\Entities\User;
use \Library\Entity;

class UserManager extends \Library\Manager{

	public function add(Entity $user){
		
		//Securite
		$name = $user->getName();
		$email = $user->getEmail();
		$password = $user->getPassword();
		$avatar = $user->getAvatar();
		$statut = $user->getStatut();

		$req = $this->_db->prepare('INSERT INTO user(id,name,email,password,avatar,statut) VALUES (NULL, :name, :email,:password,:avatar, :statut)');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':email',$email,\PDO::PARAM_STR);
		$req->bindParam(':password',$password,\PDO::PARAM_INT);
		$req->bindParam(':avatar',$avatar,\PDO::PARAM_STR);	
		$req->bindParam(':statut',$statut,\PDO::PARAM_INT);
		$req->execute();
	}

	public function delete($id){
		$req = $this->_db->prepare('DELETE FROM user WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();
	}

	public function update(Entity $user){
		//Securite
		$name = $user->getName();
		$email = $user->getEmail();
		$password = $user->getPassword();
		$avatar = $user->getAvatar();
		$id= $user->getId();
		$statut = $user->getStatut();

		$req = $this->_db->prepare('UPDATE user SET name = :name, email = :email, password = :password, avatar = :avatar, statut = :statut WHERE id = :id');
		$req->bindParam(':name',$name,\PDO::PARAM_STR);
		$req->bindParam(':email',$email,\PDO::PARAM_STR);
		$req->bindParam(':password',$password,\PDO::PARAM_STR);
		$req->bindParam(':avatar',$avatar,\PDO::PARAM_STR);
		$req->bindParam(':id',$id,\PDO::PARAM_INT);
		$req->bindParam(':statut',$statut,\PDO::PARAM_INT);
		$req->execute();
	}

	//Retourne l'object album dont l'ID a été passé en paramètre
	public function get($id){
		$req = $this->_db->prepare('SELECT * FROM user WHERE id = :id');
    	$req->bindParam(':id', $id,\PDO::PARAM_INT);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	return new User($donnee);
	}

	public function getAll(){
		$users = array();

		$req = $this->_db->query('SELECT * FROM user');

		while ($donnees = $req->fetch(\PDO::FETCH_ASSOC)){
	    	$users[] = new User($donnees);
	    }

		return $users;
	}

	//Test si l'utilisateur existe
	public function exist($name){
		$req = $this->_db->prepare('SELECT id FROM user WHERE name = :name');
    	$req->bindParam(':name', $name,\PDO::PARAM_STR);
    	$req->execute();

    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);;
    	return ($donnee !== NULL) ? $donnee['id'] : 0;
	}
}