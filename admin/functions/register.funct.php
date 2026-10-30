<?php
function  insert_register($pseudo,$mail,$password){
    global $bdd;
    $r=array(
        'pseudo'=>$pseudo,
        'mail'=>$mail,
        'password'=>$password
    );
    $sql="INSERT INTO admin(pseudo,mail,password)VALUES(:pseudo,:mail,:password)";
    $req=$bdd->prepare($sql);
    $req->execute($r);
}



















