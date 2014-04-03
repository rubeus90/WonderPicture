<?php
namespace Library;

class MailSender{

	public function __construct(){}

	public function notify(Entities\User $user, $subject, $msg){
		$mail = $user->getEmail();

		if (!mail($mail,$subject, $msg)){
			throw new \RuntimeException('Impossible d\'envoyer le mail');
		}
	}
}