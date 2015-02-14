<?php
function fctremplacecar($msg)
{
$msg=html_entity_decode($msg,ENT_NOQUOTES);
$msg = nl2br($msg);
$msg = str_replace("\\'","'",$msg);
$msg = str_replace("\\\"","\"",$msg);
}


// assignons les variables du formulaire
$pseudo=htmlentities($_POST['pseudo']);
$titre=htmlentities($_POST['titre']);
$message=htmlentities($_POST['message']);

if (trim($message)=="" && trim($pseudo)=="" && trim($titre)=="" )
{
 // on affiche la page de départ si on a appeler la page sans passer par le formulaire
 readfile("acceuil.html");
 exit;
}

// On vérifie que le login ou le message ne soient pas vide
if (trim($message)=="" || trim($pseudo)=="")
{
        echo "Vous devez remplir tous les champs ! <a href=\"acceuil.html\"> Retour </a>";
       
        // On sort du script !
        exit;
}

$nom_image="";
// Si il y a un fichier Image à charger
if(!empty($_FILES['fichier_source']['tmp_name']))
{
 // On verifie si l'upload dans le repertoire temp est OK
 if(!is_uploaded_file($_FILES['fichier_source']['tmp_name']))
 {
        echo "Upload du fichier image incorrect ! <a href=\"acceuil.html\"> Retour </a>";       
        // On sort du script !
        exit;
 }


 //On va vérifier la taille du fichier en ne passant pas par $_FILES['fichier_source']['size'] pour éviter les failles de sécurité
 if(filesize($_FILES['fichier_source']['tmp_name'])>1024000)
 {
        echo "Le fichier image est trop grand (MAX 1Mo)! <a href=\"acceuil.html\"> Retour </a>";       
        // On sort du script !
        exit;
 }

 //On vérifie maintenant le type de l'image à l'aide de la fonction getimagesize()
 list($largeur, $hauteur, $type, $attr)=getimagesize($_FILES['fichier_source']['tmp_name']);


 //Si le Type est JPEG (correspond au chiffre 2) on copie l'image
 if($type!==2)
 {
        echo "Le fichier image doit être au format JPEG ! <a href=\"acceuil.html\"> Retour </a>";       
        // On sort du script !
        exit;
 }


 //Copie le fichier dans le répertoire de destination
 $nom_image= "photonews/".date ("YmdHi").".jpg";
 if(!move_uploaded_file($_FILES['fichier_source']['tmp_name'], $nom_image))
 {
  echo "Erreur lors de la copie du fichier image ! <a href=\"acceuil.html\"> Retour </a>";       
  // On sort du script !
  exit;
 }
}


// Pensons au caractères html que l'on remplace dans le msg sinon risque de probleme
fctremplacecar(&$pseudo);
fctremplacecar(&$titre);
fctremplacecar(&$message);

// Après ces quelques vérification d'usage on passe  à l'exécution de ce formulaire

$commentaires="news.html";

if(!is_file($commentaires))
{
        // si le fichier n'existe pas on le crée 
        $verif=fopen($commentaires,"w+");
        $stock = "<html>\n<head></head><body>\n<ul>\n<!-- INSERTION ICI-->\n</ul>\n</body>\n</html>";
}
else 
{      
        // Si le fichier existe, on ouvre en écirture-enregistrement le fichier
        $verif=fopen($commentaires,"r+");
               
        // On lit les anciennes données et on les stocks
        $stock=fread($verif,filesize($commentaires));
        // On remet le curseur du fichier en début de ligne
        rewind($verif);
}

        // On met la date dans une variable
        $date=date ("d/m/Y à H:i");
       
        // On formate le tout dans la variable opinion
        $opinion = "<li><b>".$date." ".$titre."</b> (message de <b>".$pseudo."</b>) : \n<div>";
        //si on a une image on ajoute le lien
        if($nom_image != "")
          {
           $opinion = $opinion."<a target=\"_blank\" href=\"".$nom_image."\">";
           $hauteur = $hauteur * (125/$largeur);
           $opinion = $opinion."<img style=\"border: 0px solid ; width: 125px; ";
           $opinion = $opinion."height: ".$hauteur."px; float: left;\"";
           $opinion = $opinion."\n src=\"".$nom_image."\"></a>\n";
           $opinion = $opinion.$message."</div><br clear=\"all\"></li>\n";
          }
        else
          {
           $opinion = $opinion.$message."</div></li>\n";
          }
        $opinion = "<!-- INSERTION ICI-->"."\n\n".$opinion;

        // On insère le nouveau commentaire
        $stock = str_replace("<!-- INSERTION ICI-->",$opinion,$stock);

        // enregistrement
        fputs($verif,$stock);
       
        // On clos le fichier
        fclose($verif);

        // on affiche un message OK



        echo "<html><head><META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=\"acceuil.html\"></head>";
        echo "<body><b><h2>Votre message est enregistré</h2> </b>";
        echo "<h3>Si le retour n'est pas automatique après quelque secondes alors actualiser la page pour voir le message <a href=\"acceuil.html\">Retour</a></h3></body>";
?>
