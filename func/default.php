<?php

function getDefaultValues() {

	$tab = array();
	$tab['description'] = array('value' => htmlspecialchars("description pour les moteurs de recherche", ENT_QUOTES), 'simple'=>'1' , 'image'=>'0');
	$tab['keywords'] = array('value' => htmlspecialchars("mot, clé, liste", ENT_QUOTES), 'simple'=>'1' , 'image'=>'0');
	$tab['logo'] = array('value' => htmlspecialchars("http://res.cloudinary.com/sppa/image/upload/v1465317822/logo_rnckgh.png", ENT_QUOTES), 'simple'=>'1' , 'image'=>'1');
	$tab['img_banner'] = array('value' => htmlspecialchars("http://res.cloudinary.com/sppa/image/upload/v1465442107/images5_mipvaz.jpg", ENT_QUOTES), 'simple'=>'1' , 'image'=>'1');
	$tab['titre'] =array('value'=> htmlspecialchars("SSPA  - Solidary Sport Professional Association", ENT_QUOTES), 'simple' => '1');
	$tab['menu1'] =array('value'=>  htmlspecialchars("Les joueurs", ENT_QUOTES), 'simple' => '1');
	$tab['menu2'] =array('value'=>  htmlspecialchars("Les références", ENT_QUOTES), 'simple' => '1');
	$tab['menu3'] =array('value'=>  htmlspecialchars("Les références", ENT_QUOTES), 'simple' => '1');
	$tab['descr_menu1'] =array('value'=>  htmlspecialchars("Description 1", ENT_QUOTES), 'simple' => '0');
	$tab['descr_menu2'] =array('value'=>  htmlspecialchars("Description 2", ENT_QUOTES), 'simple' => '0');
	$tab['descr_menu3'] =array('value'=>  htmlspecialchars("Description 3", ENT_QUOTES), 'simple' => '0');


	$tab['principal'] =array('value'=>  htmlspecialchars("Solidary Sport Professional Association", ENT_QUOTES), 'simple' => '0');

	$tab['engagement_titre'] =array('value'=>  htmlspecialchars("Nos engagements", ENT_QUOTES), 'simple' => '0');

	$tab['pied_titre'] =array('value'=>  htmlspecialchars("SPRA", ENT_QUOTES), 'simple' => '0');

	$tab['pied_texte'] =array('value'=>  htmlspecialchars("Notre siège en Isère, vous accueille que vous soyez sportif professionnel ou encore en centre de formation, nos agents et consultants analysent votre situation et vous conseillent sur chaque décision importante de votre carrière sportive.", ENT_QUOTES), 'simple' => '0');

	$tab['contact_titre'] =array('value'=>  htmlspecialchars("Contact", ENT_QUOTES), 'simple' => '0');

	$tab['popup'] =array('value'=>  htmlspecialchars("Pour que les honoraires liés à la recherche et à la signature de vos contrats sportifs financent les valeurs de solidarité au sein de la « famille du rugby »", ENT_QUOTES), 'simple' => '0');

	$tab['bouton_contact'] =array('value'=>  htmlspecialchars("Prendre contact", ENT_QUOTES), 'simple' => '1');

	$tab['formulaire_titre'] =array('value'=>  htmlspecialchars("Formulaire de contact", ENT_QUOTES), 'simple' => '1');

	$tab['nom'] =array('value'=>  htmlspecialchars("Nom Prénom", ENT_QUOTES), 'simple' => '1');
	$tab['email'] =array('value'=>  htmlspecialchars("Email", ENT_QUOTES), 'simple' => '1');
	$tab['message'] =array('value'=>  htmlspecialchars("Message", ENT_QUOTES), 'simple' => '1');
	$tab['envoyer'] =array('value'=>  htmlspecialchars("Envoyer", ENT_QUOTES), 'simple' => '1');
	$tab['annuler'] =array('value'=>  htmlspecialchars("Annuler", ENT_QUOTES), 'simple' => '1');
	return $tab;
}
?>
