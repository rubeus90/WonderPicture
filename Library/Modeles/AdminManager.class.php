<?php
namespace Library\Modeles;

	class AdminManager extends \Library\Manager
	{
			
		public function ajouter($admin)
		{
			$requetePrepa = $this->_db->prepare('INSERT INTO admin(id,mdp,mail) VALUES (:ID,:MDP,:MAIL)');	
			try{	
			
			$d = array(
				':ID'=>$admin->getIdentifiant(),
				':MDP'=>$admin->getMdp(),
				':MAIL'=>$admin->getMail()
			);
			
			$requetePrepa->execute($d);
			
			}
			catch (exception $e)
			{
				echo 'erreur de requête : ', $e->getMessage();
			}
		}
		
		public function supprimer($admin)
		{	
		  $query = $this->_db->exec('DELETE FROM admin WHERE id=\''.$admin.'\'');
		}
		
		public function obtenir($admin)
		{
		  $query = $this->_db->query('SELECT * FROM admin WHERE id=\''.$admin.'\'');
		  if($query==NULL) echo "PROBLEME";
		  $donnees= $query->fetch(\PDO::FETCH_OBJ);
		  
		  $objetAdmin = new Admin(array(
			'id'=>$donnees->identifiant,
			'mdp' => $donnees->mdp,
			'mail' => $donnees->mail
			));
			
		  return $objetAdmin;
					
		}
	}
?>