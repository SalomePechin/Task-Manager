<?php
$this->load->helper('html');
$this->load->helper('form');
$this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/page_elemlist.css">         <!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Détails Liste</title>                  <!--nom de la page-->
</head>
<body>
<div class="grid-container">

    <div class="categorie">
        <?php
		echo("Il s'agit de la liste : ".$nameList."<br/>");
/*
		$this->load->model('infoacess');
		$infoUtilisateur = $this->infoacess->checkAccess($_SESSION["id_user"],$_SESSION["idList"]);
		if ($infoUtilisateur["roleAcces"] == 'Proprietaire') {
*/
		if ($roleAcces == 'Proprietaire') {
			echo(form_open('liste/addMember').
				" <input type=\"text\"  name=\"nomPerson\" size=\"40\"/><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
		}                    //appel d'une fonction permettant d'ajouter un collaborateur à une liste

		//echo $_SESSION["erreurPage"];
		if ($erreur != null){
			echo($erreur."<br/>");
		}         //affiche une erreur gérée par l'index lorsque le nom du collaborateur n'existe pas dans la base de données
        ?>
    </div>
    <div class="ajout">
		<?php echo form_open('element/addElem'); ?>                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <input type="text"  name="NomElem" size="20" placeholder="Nom Element"/><br/>            <!--formulaire permettant de rentrer le nom des éléments de la liste-->
            <input type="text"  name="DescElem" size="20" placeholder="Description"/><br/>           <!--formulaire permettant de rentrer la description des éléments de la liste-->
            <input type="submit" name="CreaElem" value="Créer l'élément">         <!--bouton permettant d'ajouter l'élément dans la base de données-->
        </form>
    </div>
    <div class="fiches">
        <?php
			$n=1;
/*
			foreach($listElem as $item){
*/
			$infoList = $listElem;
			foreach($infoList as $item){
				echo("Element n°".$n." nommé ".$item['NomElem']." ajouté le ".$item['DateDElem']." dit :  ".$item['DescElem']."<br/>");
				$n++;
			}
			if ($n==1) echo ("Aucun élément dans la liste."); 	//appel d'une fonction permettant d'afficher les éléments de la liste
        ?>
        <div class="blocListe"></div>
    </div>

	<div class="categorie">
		<?php
		echo("Il s'agit de la liste : ".$GLOBALS['listee']->getName($_SESSION["idList"])."<br/>");
		if ($GLOBALS['user']->listeRole($_SESSION["id_user"],$_SESSION["idList"]) == 1){
			echo(form_open('liste/addMember').
				" <input type=\"text\"  name=\"nomPerson\" size=\"40\"/><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
		}
		echo $_SESSION["erreurPage"];          //affiche une erreur gérée par l'index lorsque le nom du collaborateur n'existe pas dans la base de données
		?>
	</div>
	<div class="ajout">
		<?php echo form_open('element/addElem'); ?>                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
		Nom Element <input type="text"  name="NomElem" size="20" /><br/>            <!--formulaire permettant de rentrer le nom des éléments de la liste-->
		Description <input type="text"  name="DescElem" size="20" /><br/>           <!--formulaire permettant de rentrer la description des éléments de la liste-->
		<input type="submit" name="CreaElem" value="Création d'un element">         <!--bouton permettant d'ajouter l'élément dans la base de données-->
		</form>
	</div>
	<div class="fiches">
		<?php
		$n=1;
		foreach($GLOBALS['listee']->listElem($_SESSION["idList"]) as $item){
			echo("Element n°".$n." nommé ".$item['NomElem']." ajouté le ".$item['DateDElem']." dit :  ".$item['DescElem']."<br/>");
			$n++;
		}
		if ($n==1) echo ("Pas d'element dans la liste.");
		?>
		<div class="blocListe"></div>
	</div>

    <div class="footer">
		<?php echo form_open('utilisateur/pageProfil'); ?>             <!-- ou retourProfil - envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
			<input type="submit" value="Retour">          <!--bouton permettant de retourner à la page des listes-->
        </form>
    </div>
</div>
</body>
</html>
