<?php

include(__DIR__.'/cloudinary/Cloudinary.php');
include(__DIR__.'/cloudinary/Uploader.php');
include(__DIR__.'/cloudinary/Api.php');
include(__DIR__.'/../admin/cloudinaryAdmin.php');



$fichier = basename($_FILES['filejoueur']['name']);
$taille_maxi = 500000;
$taille = filesize($_FILES['filejoueur']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['filejoueur']['name'], '.');
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur ='Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{

     $cloudUpload = \Cloudinary\Uploader::upload($_FILES['filejoueur']['tmp_name']);

     if($cloudUpload) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		     echo json_encode(array('status' => 'ok', 'filename' => print_r($cloudUpload['url'],true)));
     }
     else //Sinon (la fonction renvoie FALSE).
     {
	     echo json_encode(array(
	        'success' => false,
	        'reason'  => 'erreur',
	    ));
     }
}
else
{
    echo json_encode(array(
	    'success' => false,
	    'reason'  => $erreur,
	));
}

?>
