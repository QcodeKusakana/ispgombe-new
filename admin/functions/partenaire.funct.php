<?php
$nbrdocument=$bdd->query('SELECT * FROM partenaire');
$nbrFichier=$nbrdocument->rowCount();
if(isset($_POST['partenaire'])){
    $nom_part=htmlspecialchars(trim($_POST['nom_part']));

    //$file_name=htmlspecialchars(htmlentities(trim($_FILES['photo'])));
    $file_name=$_FILES['photo']['name'];
    if(!empty($_POST['nom_part']) and !empty($_FILES['photo'])){
        $file_extension=strrchr($file_name, ".");
        $file_tmp_name=$_FILES['photo']['tmp_name'];
        $finalpart='avs_'.$nbrFichier.'_'.$nom_part.''.$file_extension;
        $file_dest='./../media/images_part/'.$finalpart;
        $extensions_autorisees=array('.jpg','.JPG','.JPEG','.PNG','.png');
        if(in_array($file_extension, $extensions_autorisees)){
            if(move_uploaded_file($file_tmp_name,$file_dest)){
                $insert=$bdd->prepare("INSERT INTO partenaire(nom_part,photo) values(?,?)");
                $insert->execute(array($nom_part,$finalpart));
                $sms="Partenaire ajouté avec succès !";
                unset($nom_part,$finalpart,$file_name,$file_dest);
            }else{
                $erreur= "Une erreur est survenue lors de l'envoi du fichier";
            }
        }else{
            $erreur="Seuls les fichiers jpg/png sont autorisés";
        }

    }else{
        $erreur="Veuillez compléter les champs !";
    }
}