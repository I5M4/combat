
<div class="info-perso">

    <h2><?= $objet->html("pseudo") ?></h2>
    <p>HP : <?= $objet->html("hp") ?></p>
    <p>Agilitée : <?= $objet->html("agilite") ?></p>
    <p>Force : <?= $objet->html("force") ?>  </p>  <button onclick="execute('convertir_point','personnage','attribut=force')">Convertir 1 unitée en Résistance</button>
    <p>Résistance : <?= $objet->html("resistance") ?> </p> <button onclick="execute('convertir_point','personnage','attribut=resistance')">Convertir 1 unitée en Force</button>
    
</div>

<h2>Pièce N° <?= $objet->html("salle") ?></h2>
<?php  include "template/fragment/button_reculer.php" ?>
<?php  include "template/fragment/button_avancer.php" ?>
<table style="margin-top: 15px;  padding: 20px;">
    <?= empty($listeAdversaires)?"<p> Vous êtes seul dans cette salle ... <p>":"" ?>
    <?php  foreach( $listeAdversaires as $adversaire){  include "template/fragment/liste_adversaire.php";} ?>
</table>
</div>