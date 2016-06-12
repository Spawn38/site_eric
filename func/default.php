<?php

function getDefaultValues() {

	$tab = array();
	$tab['description'] = array('value' => htmlentities("description pour les moteurs de recherche"), 'simple'=>'1' , 'image'=>'0');
	$tab['keywords'] = array('value' => htmlentities("mot, clé, liste"), 'simple'=>'1' , 'image'=>'0');
	$tab['logo'] = array('value' => htmlentities("http://res.cloudinary.com/sppa/image/upload/v1465317822/logo_rnckgh.png"), 'simple'=>'1' , 'image'=>'1');
	$tab['img_banner'] = array('value' => htmlentities("http://res.cloudinary.com/sppa/image/upload/v1465442107/images5_mipvaz.jpg"), 'simple'=>'1' , 'image'=>'1');
	$tab['titre'] =array('value'=> htmlentities("SSPA  - Solidary Sport Professional Association"), 'simple' => '1');
	$tab['menu1'] =array('value'=>  htmlentities("Les joueurs"), 'simple' => '1');
	$tab['menu2'] =array('value'=>  htmlentities("Les références"), 'simple' => '1');
	$tab['menu3'] =array('value'=>  htmlentities("Les références"), 'simple' => '1');
	$tab['descr_menu1'] =array('value'=>  htmlentities("Description 1"), 'simple' => '0');
	$tab['descr_menu2'] =array('value'=>  htmlentities("Description 2"), 'simple' => '0');
	$tab['descr_menu3'] =array('value'=>  htmlentities("Description 3"), 'simple' => '0');


	$tab['principal'] =array('value'=>  htmlentities("Solidary Sport Professional Association"), 'simple' => '0');

	$tab['engagement_titre'] =array('value'=>  htmlentities("Nos engagements"), 'simple' => '0');

	$tab['pied_titre'] =array('value'=>  htmlentities("SPRA"), 'simple' => '0');

	$tab['pied_texte'] =array('value'=>  htmlentities("Notre siège en Isère, vous accueille que vous soyez sportif professionnel ou encore en centre de formation, nos agents et consultants analysent votre situation et vous conseillent sur chaque décision importante de votre carrière sportive."), 'simple' => '0');

	$tab['contact_titre'] =array('value'=>  htmlentities("Contact"), 'simple' => '0');

	$tab['popup'] =array('value'=>  htmlentities("Pour que les honoraires liés à la recherche et à la signature de vos contrats sportifs financent les valeurs de solidarité au sein de la « famille du rugby »"), 'simple' => '0');

	$tab['bouton_contact'] =array('value'=>  htmlentities("Prendre contact"), 'simple' => '1');

	$tab['formulaire_titre'] =array('value'=>  htmlentities("Formulaire de contact"), 'simple' => '1');

	$tab['nom'] =array('value'=>  htmlentities("Nom Prénom"), 'simple' => '1');
	$tab['email'] =array('value'=>  htmlentities("Email"), 'simple' => '1');
	$tab['message'] =array('value'=>  htmlentities("Message"), 'simple' => '1');
	$tab['envoyer'] =array('value'=>  htmlentities("Envoyer"), 'simple' => '1');
	$tab['annuler'] =array('value'=>  htmlentities("Annuler"), 'simple' => '1');
	return $tab;
}
?>
