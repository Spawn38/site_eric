<?php

function getDefaultValues() {

	$tab = array();

	$tab['titre'] = htmlentities("SPRA - Association spécialisée en Conseil et Management");
	$tab['menu1'] = htmlentities("Les joueurs");
	$tab['menu2'] = htmlentities("Les références");
	$tab['menu3'] = htmlentities("Les références");

	$tab['principal'] = htmlentities("Solidary Professional Rugby Association");

	$tab['engagement_titre'] = htmlentities("Nos engagements");

	$tab['pied_titre'] = htmlentities("SPRA");

	$tab['pied_texte'] = htmlentities("Notre siège en Isère, vous accueille que vous soyez sportif professionnel ou encore en centre de formation, nos agents et consultants analysent votre situation et vous conseillent sur chaque décision importante de votre carrière sportive.");

	$tab['contact_titre'] = htmlentities("Contact");

	$tab['popup'] = htmlentities("Pour que les honoraires liés à la recherche et à la signature de vos contrats sportifs financent les valeurs de solidarité au sein de la « famille du rugby »");

	$tab['bouton_contact'] = htmlentities("Prendre contact");

	$tab['formulaire_titre'] = htmlentities("Formulaire de contact");

	$tab['titre_image1'] = htmlentities("Le métier d’agent sportif a évolué. Il demande maintenant au-delà d’une simple mise en relation entre un sportif et un club, d’accompagner les sportifs et leur famille.");	

	$tab['titre_texte1'] = htmlentities("Des services adaptés à chaque étape de votre carrière sportive.");	

	$tab['texte1'] = htmlentities("<p class=\"left-align light\">La SPRA a pour aspiration d’accompagner les Rugbymans professionnels (ou en devenir) tout au long de leur carrière afin qu’il puisse bien vivre leur sport.</p>
          <p class=\"left-align light\">Le sportif doit révéler son potentiel, affirmer ses ambitions en s’imposant sportivement. Notre structure fonde sa réputation sur un engagement maximal auprès de chacun de ses athlètes.</p>
          <p class=\"left-align light\">Un engagement et une mise en œuvre opérationnelle avec trois objectifs:</p>
          <ul class=\"left-align light\">
            <li>épanouissement personnel</li>
            <li>une réussite sportive durable</li>
            <li>une reconversion réussie</li>
          </ul>");	

	$tab['titre_image2'] = htmlentities("«Des partenaires spécialisés et hautement qualifiées.»
            <br/>Pour que le sportif, n’ait à penser qu’à l’amélioration de ses performances sportives");

	$tab['titre_texte2'] = htmlentities("Une équipe à votre écoute 24H/24H et 7 Jours/7 Jours.");

	$tab['texte2'] = htmlentities("<p class=\"left-align light\">La SPRA associe au sein de sa structure, des agents sportifs licenciés par la Fédération Française de Rugby, des avocats, des spécialistes en droit fiscal, des professionnels de la gestion de patrimoine et des assurances.</p>
          <p class=\"left-align light\">La SPRA propose une gamme complète de services liée à la gestion du bien être des sportifs et au développement de leur carrière.</p>
          <p class=\"left-align light\">Que vous soyez sportif de haut niveau avec ou sans contrat, ou pour l’instant en formation, La SPRA est convaincue que les conseils et le management sont essentiels pour la carrière d’un athlète, afin de réussir sa reconversion après sa retraite sportive.</p>
          <p class=\"left-align light\">La SPRA œuvrera pour un accompagnement personnel et individuel</p>
          <p class=\"left-align light\">La SPRA gère ses sportifs en tenant compte des impératifs familiaux.</p>");

	$tab['nom'] = htmlentities("Nom Prénom");
	$tab['email'] = htmlentities("Email");
	$tab['message'] = htmlentities("Message");
	$tab['envoyer'] = htmlentities("Envoyer");
	$tab['annuler'] = htmlentities("Annuler");
	return $tab;
}
?>
