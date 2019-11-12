<?php
function creationPanier() {
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['panier']['nomProduit'] = array();
        $_SESSION['panier']['qteProduit'] = array();
        $_SESSION['panier']['prixProduit'] = array();
        $_SESSION['panier']['verrou'] = false;
    }
    return true;
}

function ajouterArticle($nomProduit, $qteProduit, $prixProduit){
    if(creationPanier() && !isVerrouille()){
        $positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);
        if($positionProduit !== false){
            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
        }
        else{
            array_push( $_SESSION['panier']['nomProduit'],$nomProduit);
            array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
            array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
        }
    }
    else{
        echo "Error";
    }
    function suppArticle($nomProduit){

        if (creationPanier() && !isVerrouille())
        {
 
           $tmp=array();
           $tmp['nomProduit'] = array();
           $tmp['qteProduit'] = array();
           $tmp['prixProduit'] = array();
           $tmp['verrou'] = $_SESSION['panier']['verrou'];
     
           for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
           {
              if ($_SESSION['panier']['nomProduit'][$i] !== $nomProduit)
              {
                 array_push( $tmp['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
                 array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                 array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
              }
     
           }
           $_SESSION['panier'] =  $tmp;

           unset($tmp);
        }
        else
        echo "Error";
     }
     function modifQTeArticle($nomProduit,$qteProduit){

        if (creationPanier() && !isVerrouille())
        {
           if ($qteProduit > 0)
           {
             
              $positionProduit = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);
     
              if ($positionProduit !== false)
              {
                 $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
              }
           }
           else
           suppArticle($nomProduit);
        }
        else
        echo "Error";
     }
     function montantPanier(){
        $total=0;
        for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
        {
           $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
     }
     function suppPanier(){
        unset($_SESSION['panier']);
     }

}