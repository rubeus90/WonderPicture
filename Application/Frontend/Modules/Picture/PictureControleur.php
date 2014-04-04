<?php
namespace Application\Frontend\Modules\Picture;

use \Library\Entities\Comment;
use \Library\Entities\Note;

class PictureControleur extends \Library\Controleur {

	use \Library\Validator;

	private $_commentManager,
		$_noteManager,
		$_picture;
	
	public function run(){
		//On récupère le nom de l'image
		$title = $this->_vars[2];

		//On instancie les managers
		$PictureManager = $this->getManagerof('Picture');
		$this->_commentManager = $this->getManagerof('Comment');
		$this->_noteManager  = $this->getManagerof('Note');

		//Si l'album n'existe pas -> redirection
		if(!$PictureManager->exist($title)){
			$this->_app->getHTTPResponse()->error();
		}
		
		//On récupère l'object image correspondant au nom de l'album qui se trouve dans l'URL
		$this->_picture = $PictureManager->getByTitle($title);

		//Si l'album est privée -> redirecction
		if(!$this->_picture->isPublic() && !$this->_app->getUser()->isConnected()){
			$this->_app->getHTTPResponse()->error();
		}

		if(isset($_POST['addcomment'])){
			$this->addComment();
		}

		//Traitement en fonction du statut du visiteur
		if($this->_app->getUser()->isConnected()){
			$pictures = $PictureManager->getAlbum($this->_picture->getAlbum_id(), $this->getOrderPicture());
			if(($note =$this->_noteManager->get($this->_picture->getId(),$this->_app->getUser()->get('user')->getId())) !== false){
				$this->_app->getPage()->setVars('note', $note->getNote());	
			}else{
				$this->_app->getPage()->setVars('note', 0);	
			}
		}else{
			$pictures = $PictureManager->getAlbumPublic($this->_picture->getAlbum_id(), $this->getOrderPicture());
		}


			
		//Détermination de l'image suivant et précédente
		$i = 0;
		foreach($pictures as $element){
			if($element->getId() === $this->_picture->getId()){
				break;
			}else{
				$i++;
			}
		}

		$pictureNext = ($i != (count($pictures)-1) && isset($pictures[$i+1])) ? $pictures[$i+1] : NULL;
		$picturePrec = ($i != 0) ? $pictures[$i-1] : NULL;

		//COMMENT
		$comments = $this->_commentManager->getAll($this->_picture->getId());

		//NOTE
		$avg = $this->_noteManager->average($this->_picture->getId());

		//On passe le tout à la vue
		$this->_app->getPage()->setVars('pictureNext', $pictureNext);
		$this->_app->getPage()->setVars('picturePrec', $picturePrec);
		$this->_app->getPage()->setVars('picture', $this->_picture);
		$this->_app->getPage()->setVars('pictures', $pictures);
		$this->_app->getPage()->setVars('avg', $avg);	
		$this->_app->getPage()->setVars('comments', $comments);	
		$this->_app->getPage()->setVars('title', '- '.$this->_picture->getName());
	}

	private function addComment(){
		if(isset($_POST['id']) && isset($_POST['comment']) && $this->exist($_POST['id']) && ($this->exist($_POST['comment']))){
			$user_id = $this->_app->getUser()->get('user')->getId();
			$picture_id = $_POST['id'];
			$comment = $this->toString($_POST['comment']);
			$date = date("Y-m-d H:i:s");

			$comment = new Comment(array(
				  'id' => '0',
				  'picture_id' => $picture_id,
				  'user_id' => $user_id,
				  'comment' => $comment,
				  'date_publish' => $date
			));
			$this->_commentManager->add($comment);

		}

		if(isset($_POST['star']) && $_POST['star'] < 6 && $_POST['star'] > 0){
			if(($note =$this->_noteManager->get($this->_picture->getId(),$this->_app->getUser()->get('user')->getId())) !== false){
				$note->setNote($_POST['star']);
				$this->_noteManager->update($note);
			}else{
				$note = new Note(array(
				  'id' => '0',
				  'picture_id' => $this->_picture->getId(),
				  'user_id' => $this->_app->getUser()->get('user')->getId(),
				  'note' => $_POST['star'],
				));
				$this->_noteManager->add($note);
			}
		}	
	}
}