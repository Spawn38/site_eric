<?php

function getDefaultValues() {

	$tab = array();

	$tab['logo'] = array('value' => htmlentities("http://res.cloudinary.com/sppa/image/upload/v1465317822/logo_rnckgh.png"), 'simple'=>'1' , 'image'=>'1');
	$tab['img_banner'] = array('value' => htmlentities("http://res.cloudinary.com/sppa/image/upload/v1465442107/images5_mipvaz.jpg"), 'simple'=>'1' , 'image'=>'1');
	$tab['titre'] =array('value'=> htmlentities("SSPA  - Solidary Sport Professional Association"), 'simple' => '1');
	$tab['menu1'] =array('value'=>  htmlentities("Les joueurs"), 'simple' => '1');
	$tab['menu2'] =array('value'=>  htmlentities("Les références"), 'simple' => '1');
	$tab['menu3'] =array('value'=>  htmlentities("Les références"), 'simple' => '1');

	$tab['principal'] =array('value'=>  htmlentities("Solidary Sport Professional Association"), 'simple' => '0');

	$tab['engagement_titre'] =array('value'=>  htmlentities("Nos engagements"), 'simple' => '0');

	$tab['pied_titre'] =array('value'=>  htmlentities("SPRA"), 'simple' => '0');

	$tab['pied_texte'] =array('value'=>  htmlentities("Notre siège en Isère, vous accueille que vous soyez sportif professionnel ou encore en centre de formation, nos agents et consultants analysent votre situation et vous conseillent sur chaque décision importante de votre carrière sportive."), 'simple' => '0');

	$tab['contact_titre'] =array('value'=>  htmlentities("Contact"), 'simple' => '0');

	$tab['popup'] =array('value'=>  htmlentities("Pour que les honoraires liés à la recherche et à la signature de vos contrats sportifs financent les valeurs de solidarité au sein de la « famille du rugby »"), 'simple' => '0');

	$tab['bouton_contact'] =array('value'=>  htmlentities("Prendre contact"), 'simple' => '1');

	$tab['formulaire_titre'] =array('value'=>  htmlentities("Formulaire de contact"), 'simple' => '1');

	$tab['titre_image1'] =array('value'=>  htmlentities("Le métier d’agent sportif a évolué. Il demande maintenant au-delà d’une simple mise en relation entre un sportif et un club, d’accompagner les sportifs et leur famille."), 'simple' => '0');

	$tab['titre_texte1'] =array('value'=>  htmlentities("Des services adaptés à chaque étape de votre carrière sportive."), 'simple' => '0');

	$tab['texte1'] =array('value'=>  htmlentities("<p class=\"left-align light\">La SPRA a pour aspiration d’accompagner les Rugbymans professionnels (ou en devenir) tout au long de leur carrière afin qu’il puisse bien vivre leur sport.</p>
          <p class=\"left-align light\">Le sportif doit révéler son potentiel, affirmer ses ambitions en s’imposant sportivement. Notre structure fonde sa réputation sur un engagement maximal auprès de chacun de ses athlètes.</p>
          <p class=\"left-align light\">Un engagement et une mise en œuvre opérationnelle avec trois objectifs:</p>
          <ul class=\"left-align light\">
            <li>épanouissement personnel</li>
            <li>une réussite sportive durable</li>
            <li>une reconversion réussie</li>
          </ul>"), 'simple' => '0');

	$tab['titre_image2'] =array('value'=>  htmlentities("«Des partenaires spécialisés et hautement qualifiées.»
            <br/>Pour que le sportif, n’ait à penser qu’à l’amélioration de ses performances sportives"), 'simple' => '0');

	$tab['titre_texte2'] =array('value'=>  htmlentities("Une équipe à votre écoute 24H/24H et 7 Jours/7 Jours."), 'simple' => '0');

	$tab['texte2'] =array('value'=>  htmlentities("<p class=\"left-align light\">La SPRA associe au sein de sa structure, des agents sportifs licenciés par la Fédération Française de Rugby, des avocats, des spécialistes en droit fiscal, des professionnels de la gestion de patrimoine et des assurances.</p>
          <p class=\"left-align light\">La SPRA propose une gamme complète de services liée à la gestion du bien être des sportifs et au développement de leur carrière.</p>
          <p class=\"left-align light\">Que vous soyez sportif de haut niveau avec ou sans contrat, ou pour l’instant en formation, La SPRA est convaincue que les conseils et le management sont essentiels pour la carrière d’un athlète, afin de réussir sa reconversion après sa retraite sportive.</p>
          <p class=\"left-align light\">La SPRA œuvrera pour un accompagnement personnel et individuel</p>
          <p class=\"left-align light\">La SPRA gère ses sportifs en tenant compte des impératifs familiaux.</p>"), 'simple' => '0');

	$tab['nom'] =array('value'=>  htmlentities("Nom Prénom"), 'simple' => '1');
	$tab['email'] =array('value'=>  htmlentities("Email"), 'simple' => '1');
	$tab['message'] =array('value'=>  htmlentities("Message"), 'simple' => '1');
	$tab['envoyer'] =array('value'=>  htmlentities("Envoyer"), 'simple' => '1');
	$tab['annuler'] =array('value'=>  htmlentities("Annuler"), 'simple' => '1');
	return $tab;
}
?>
