<?php
require "include/dbms.inc.php";
require "include/template2.inc.php";
require "include/auth.inc.php";
$main = new Template("dtml/lumino/html/frame-public.html");
if (!isset($_REQUEST['page'])) {
    $_REQUEST['page'] = 'list';
}
switch ($_REQUEST['page']) {
    case 'list':   // report
        $body = new Template("dtml/lumino/html/products/products_list.html"); //TEMPLATE
        $body->setContent("top", ["Products","Products List"]); // ADDRESS
        $body->setContent("title","Products List"); // TITLE
        //query report
        $query="SELECT Products.id, Products.Name, Products.Brand, Products.Price, Products.Description, Category.Name as Category, Catalogs.Type, Catalogs.Year, Catalogs.Collection
          FROM Products
          LEFT JOIN Category ON Products.id_Category = Category.id
          LEFT JOIN Catalogs ON Products.id_Catalogs = Catalogs.id
          ORDER BY Products.id DESC;";
        $result = $db->getResult_array($query);
        //.query
        $body->setContent("data", $result); //SET REPORT
        break;
    case 'insert':   // insert product
        $body = new Template("dtml/lumino/html/products/products_form.html"); //TEMPLATE
        $body->setContent("top", ["Products","Insert Product"]); // ADDRESS
        $body->setContent("title","INSERT NEW PRODUCT"); // TITLE
        $body->setContent("submit"," Insert Product"); // BUTTOM
        //Query load option Category
        $query="SELECT id,Name FROM Category;";
        $result = $db->getResult_array($query);
        $body->setContent("optionCategory", array($result,""));
        //.Query
        //Query load option Catalogs
        $query="SELECT id,Name FROM Catalogs;";
        $result = $db->getResult_array($query);
        $body->setContent("optionCatalogs", array($result,""));
        //.Query
        //Query load option Warehouse
        $query="SELECT Area FROM Warehouse GROUP BY Area;";
        $result = $db->getResult_array($query);
        $body->setContent("optionWarehouse", array($result,""));
        //.Query
        // Submit values insert
        if (isset($_POST['name'])){
            $name=addslashes($_POST['name']);
            $brand=addslashes($_POST['brand']);
            $description=addslashes($_POST['description']);
            //Query insert product
            $query="INSERT INTO Products (`Name`,`Brand`,`Price`,`id_Category`,`id_Catalogs`,`Description`)
      VALUES('$name',
        '$brand',
        '{$_POST['price']}',
        '{$_POST['category']}',
        '{$_POST['catalog']}',
        '$description')";
            $result = $db->query($query);
            //.Query
            //load product id
            $query="SELECT max(id) as id FROM Products";
            $idProduct = $db->getResult_array($query);
            //.Query
            //Query insert product into warehouse with id
            $query="INSERT INTO Products_Warehouse SET
              id_Products='{$idProduct[0]['id']}',
              Area_Warehouse='{$_POST['warehouse']}',
              Sector_Warehouse='{$_POST['sector']}',
              Amount='{$_POST['amount_S']}',
              Size='S';";
            $result = $db->query($query);
            //.Query
            
            //Query insert product into warehouse with id
            $query="INSERT INTO Products_Warehouse SET
              id_Products='{$idProduct[0]['id']}',
              Area_Warehouse='{$_POST['warehouse']}',
              Sector_Warehouse='{$_POST['sector']}',
              Amount='{$_POST['amount_M']}',
              Size='M';";
            $result = $db->query($query);
            //.Query
            
            //Query insert product into warehouse with id
            $query="INSERT INTO Products_Warehouse SET
              id_Products='{$idProduct[0]['id']}',
              Area_Warehouse='{$_POST['warehouse']}',
              Sector_Warehouse='{$_POST['sector']}',
              Amount='{$_POST['amount_L']}',
              Size='L';";
            $result = $db->query($query);
            //.Query
            
            
            //Query insert product into warehouse with id
            $query="INSERT INTO Products_Warehouse SET
              id_Products='{$idProduct[0]['id']}',
              Area_Warehouse='{$_POST['warehouse']}',
              Sector_Warehouse='{$_POST['sector']}',
              Amount='{$_POST['amount_XL']}',
              Size='XL';";
            $result = $db->query($query);
            //.Query
            
            $body->setContent("notification", $result); // SET NOTIFICATION
        }
        break;
    case 'delete':   // delete product
        //query delete
        $query="DELETE FROM ProductS WHERE id='{$_GET['id']}'";
        $result = $db->query($query);
        //.query
    case 'update':   // report update
        $body = new Template("dtml/lumino/html/products/products_list.html");
        $body->setContent("top", ["Products","Update Product"]);
        $body->setContent("title","Update Product");
        //query report update
        $query="SELECT id,Name FROM Products ORDER BY id DESC;";
        $result = $db->getResult_array($query);
        //.query
        $body->setContent("report_update", $result); //SET REPORT UPDATE
        break;
    case 'edit':   // report
        $body = new Template("dtml/lumino/html/products/products_form.html"); //TEMPLATE
        $body->setContent("top", ["Products","Edit Product"]); //ADDRESS
        $body->setContent("title","Edit Product"); //TITLE
        $body->setContent("submit"," Save Product"); //BUTTOM
        // Submit values update
        if (isset($_POST['name'])){
            $name=addslashes($_POST['name']);
            $brand=addslashes($_POST['brand']);
            $description=addslashes($_POST['description']);
            //Query update values:name,price,brand,category and description
            $query="UPDATE Products SET
      name ='$name',
      price ='{$_POST['price']}',
      brand ='$brand',
      id_Category ='{$_POST['category']}',
      id_Catalogs ='{$_POST['catalog']}',
      description ='$description'
      WHERE id ='{$_POST['id']}';";
            $result = $db->query($query);
            //.Query PRODOTTO
            
            //Query update area,sector and amount
            $query="UPDATE Products_Warehouse SET
      Area_Warehouse ='{$_POST['warehouse']}',
      Sector_Warehouse ='{$_POST['sector']}',
      Amount ='{$_POST['amount_S']}'
      WHERE id_Products ='{$_POST['id']}'
       AND Area_Warehouse ='{$_POST['oldArea']}'
       AND Sector_Warehouse ='{$_POST['oldSector']}'
       AND Size='S';";
            $result = $db->query($query);
            //.Query Products into Warehouse
            
            //Query update area,sector and amount
            $query="UPDATE Products_Warehouse SET
      Area_Warehouse ='{$_POST['warehouse']}',
      Sector_Warehouse ='{$_POST['sector']}',
      Amount ='{$_POST['amount_M']}'
      WHERE id_Products ='{$_POST['id']}'
       AND Area_Warehouse ='{$_POST['oldArea']}'
       AND Sector_Warehouse ='{$_POST['oldSector']}'
       AND Size='M';";
            $result = $db->query($query);
            //.Query Products into Warehouse
            
            //Query update area,sector and amount
            $query="UPDATE Products_Warehouse SET
      Area_Warehouse ='{$_POST['warehouse']}',
      Sector_Warehouse ='{$_POST['sector']}',
      Amount ='{$_POST['amount_L']}'
      WHERE id_Products ='{$_POST['id']}'
       AND Area_Warehouse ='{$_POST['oldArea']}'
       AND Sector_Warehouse ='{$_POST['oldSector']}'
       AND Size='L';";
            $result = $db->query($query);
            //.Query Products into Warehouse
            
            //Query update area,sector and amount
            $query="UPDATE Products_Warehouse SET
      Area_Warehouse ='{$_POST['warehouse']}',
      Sector_Warehouse ='{$_POST['sector']}',
      Amount ='{$_POST['amount_XL']}'
      WHERE id_Products ='{$_POST['id']}'
       AND Area_Warehouse ='{$_POST['oldArea']}'
       AND Sector_Warehouse ='{$_POST['oldSector']}'
       AND Size='XL';";
            
            $result = $db->query($query);
            //.Query Products into Warehouse
            $body->setContent("notification", $result); // SET NOTIFICATION
        }//.submit values
        //Query load values product
        $query="SELECT * FROM Products WHERE id='{$_GET['id']}'";
        $product = $db->getResult_array($query);
        //.Query
        $body->setContent("id", $product[0]['id']); //SET ID PRODUCT
        $body->setContent("name", $product[0]['Name']); //SET NAME PRODUCT
        $body->setContent("brand", $product[0]['Brand']); //SET BRAND PRODUCT
        $body->setContent("price", $product[0]['Price']); //SET PRICE PRODUCT
        $body->setContent("description", $product[0]['Description']); //SET DESCRIPTION PRODUCT
        //Query load Area, Sector, Amount of product
        $query="SELECT Area_Warehouse as Area, Sector_Warehouse as Sector, Amount
            FROM Products_Warehouse
            WHERE id_Products='{$_GET['id']}'
            AND Size='S';";
        $area = $db->getResult_array($query);
        //.Query
        $body->setContent("amount_S", $area[0]['Amount']); //SET AMOUNT S
        
        
        //Query load Area, Sector, Amount of product
        $query="SELECT Area_Warehouse as Area, Sector_Warehouse as Sector, Amount
            FROM Products_Warehouse
            WHERE id_Products='{$_GET['id']}'
            AND Size='M';";
        $area = $db->getResult_array($query);
        //.Query
        $body->setContent("amount_M", $area[0]['Amount']); //SET AMOUNT M
        
        //Query load Area, Sector, Amount of product
        $query="SELECT Area_Warehouse as Area, Sector_Warehouse as Sector, Amount
            FROM Products_Warehouse
            WHERE id_Products='{$_GET['id']}'
            AND Size='L';";
        $area = $db->getResult_array($query);
        //.Query
        $body->setContent("amount_L", $area[0]['Amount']); //SET AMOUNT L
        
        //Query load Area, Sector, Amount of product
        $query="SELECT Area_Warehouse as Area, Sector_Warehouse as Sector, Amount
            FROM Products_Warehouse
            WHERE id_Products='{$_GET['id']}'
            AND Size='XL';";
        $area = $db->getResult_array($query);
        //.Query
        $body->setContent("amount_XL", $area[0]['Amount']); //SET AMOUNT XL
        
        
        $body->setContent("sector", $area[0]['Sector']); //SET SECTOR
        $body->setContent("area", $area[0]['Area']); //SET AREA
        //Query load all Categories
        $query="SELECT id,Name FROM Category;";
        $allCategory = $db->getResult_array($query);
        //.Query
        // Set correct category
        $body->setContent("optionCategory", array($allCategory,$product[0]['id_Category'])); //SET CATEGORY
        //Query load all Catalogs
        $query="SELECT id,Name FROM Catalogs;";
        $allCatalogs = $db->getResult_array($query);
        //.Query
        // Set correct catalog
        $body->setContent("optionCatalogs",array($allCatalogs,$product[0]['id_Catalogs'])); //SET CATALOG
        //Load all warehouse
        $query="SELECT Area,Area FROM Warehouse GROUP BY Area;";
        $allarea = $db->getResult_array($query);
        //end->Option
        //Set correct warehouse
        $body->setContent("optionWarehouse",array($allarea,$area[0]['Area'])); //SET WAREHOUSE
        break;
    case 'warehouse':   // warehouse list
        $body = new Template("dtml/lumino/html/products/products_list.html"); //TEMPLATE
        $body->setContent("top", ["Products","Products List","Warehouse Product"]); // ADDRESS
        $body->setContent("title","Warehouse Products"); // TITLE
        //Query load correct warehouse
        $query="SELECT Area_Warehouse as Area, Sector_Warehouse as Sector, Amount
            FROM Products_Warehouse
            WHERE id_Products='{$_GET['id']}';";
        $warehouse = $db->getResult_array($query);
        $body->setContent("warehouse", $warehouse);
        //.Query
        break;
}
$main->setContent("username",$_SESSION['auth']['Username']);
$main->setContent("body", $body->get());
$main->close();