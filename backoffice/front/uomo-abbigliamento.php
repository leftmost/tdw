<?php

    require "include/dbms.inc.php";

    $result = $db->query("SELECT * FROM product WHERE id_Category = abbigliamento AND id_Cataloge = uomo");
                        //SELECT * FROM category AS cy, cataloge AS ce WHERE cy.nome = abbigliamento AND ce.nome = uomo
    if ($result) {

         -------------------------------
        } while ($data);


    } else {
        echo "query KO";
        exit;
    }

?>
