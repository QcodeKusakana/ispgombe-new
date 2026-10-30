<?php
$nbrdocument=$bdd->query('SELECT * FROM equipes');
$nbrFichier=$nbrdocument->rowCount();
if(isset($_POST['save']))
{
    $name=  htmlspecialchars($_POST['name']);
    $first=  htmlspecialchars($_POST['first']);
    $mail=  htmlspecialchars($_POST['mail']);
    $function=  htmlspecialchars($_POST['function']);

//$file_name=htmlspecialchars(htmlentities(trim($_FILES['photo'])));
    $file_name=$_FILES['photo']['name'];
    if(!empty($_POST['name']) and !empty($_POST['first']) and !empty($_POST['mail']) and !empty($_POST['function'])
        and !empty($_FILES['photo'])){
        $file_extension=strrchr($file_name, ".");
        $file_tmp_name=$_FILES['photo']['tmp_name'];
        $finalcateg='avs_'.$nbrFichier.'_'.$name.''.$file_extension;
        $file_dest='./media/membre/'.$finalcateg;
        $extensions_autorisees=array('.jpg','.JPG','.JPEG','.PNG','.png');
        if(in_array($file_extension, $extensions_autorisees)){
            if(move_uploaded_file($file_tmp_name,$file_dest)){
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail=$bdd->prepare("SELECT * FROM equipes WHERE mail=?");
                    $reqmail->execute(array($mail));
                    $mailexist=$reqmail->rowCount();
                    if($mailexist == 0)
                    {
                        $insertmbr=$bdd->prepare("INSERT INTO equipes(name,first,mail,function,photo) VALUES(?,?,?,?,?)");
                        $insertmbr->execute(array($name,$first,$mail,$function,$finalcateg));
                        $errprs="Enregistrement terminée avec succès!";
                    }
                    else
                    {
                        $erreur=" Adresse mail déjà utilisée !";
                    }
                }
                else
                {
                    $erreur="Votre adresse mail n'est pas valide !";
                }
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
?>