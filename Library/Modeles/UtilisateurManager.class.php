<?php
namespace Library\Modeles;

	class UtilisateurManager extends \Library\Manager
	{
			
		public function ajouter($user)
		{
			$requetePrepa = $this->_db->prepare('INSERT INTO utilisateur(id,mdp,mail,estAdmin) VALUES (:ID,:MDP,:MAIL, :estAdmin)');	
			try{	
			
			$d = array(
				':ID'=>$user->getIdentifiant(),
				':MDP'=>$user->getMdp(),
				':MAIL'=>$user->getMail(),
				':estAdmin'=>$user->getEstAdmin()
			);
			
			$requetePrepa->execute($d);
			
			}
			catch (exception $e)
			{
				echo 'erreur de requête : ', $e->getMessage();
			}
		}
		
		public function supprimer($user)
		{	
		  $query = $this->_db->exec('DELETE FROM utilisateur WHERE id=\''.$user.'\'');
		}
		
		public function obtenir($user)
		{
			$objetAdmin = NULL;
		  	$query = $this->_db->query('SELECT * FROM utilisateur WHERE id=\''.$user.'\'');
		  	if($query==NULL) echo "PROBLEME";

		  	if($donnees= $query->fetch(\PDO::FETCH_OBJ)){
			  	$objetAdmin = new Utilisateur(array(
				'id'=>$donnees->identifiant,
				'mdp' => $donnees->mdp,
				'mail' => $donnees->mail,
				'estAdmin' => $donnees->estAdmin
				));
			  }			

		  return $objetAdmin;
					
		}

		public function testUtilisateur($login, $mdp){
			if($user = $this->obtenir($login)){
				if($mdp == $user.getMdp())
					return user;
			}
			return NULL;
			
		}
	}
?>