<?php
namespace Library\Modeles;

	class AdminManager extends Manager
	{
			
		public function ajouter($admin)
		{
			$requetePrepa = $this->_db->prepare(
				'INSERT 
				INTO 
				admin(identifiant,mdp,mail) 
				VALUE
				(:ID,:MDP,:MAIL)'
				);	
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
				echo 'erreur de requète : ', $e->getMessage();
			}
		}
		
		public function supprimer($admin)
		{	
		  $query = $this->_db->exec('DELETE FROM admin WHERE identifiant=\''.$admin.'\'');
		}
		
		public function obtenir($admin)
		{
		  $query = $this->_db->query('SELECT * FROM admin WHERE identifiant=\''.$admin.'\'');
		  if($query==NULL) echo "PROBLEME";
		  $donnees= $query->fetch(\PDO::FETCH_OBJ);
		  
		  $objetAdmin = new Admin(array(
			'identifiant'=>$donnees->identifiant,
			'mdp' => $donnees->mdp,
			'mail' => $donnees->mail
			));
			
		  return $objetAdmin;
					
		}
	}
?>