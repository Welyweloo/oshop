<?php

namespace Oshop\Model;

use Oshop\Database;
use PDO;

class Brand extends CoreModel
{
    // strictement égal au x colonnes de la table product dans la bdd, les propriétés non reprises ici sont dans la class parent CoreModel
    private $name;
    private $footer_order;
    

    // méthode qui nous retourne 5 marques pour affichage dans le footer
    public function findFiveFooterBrand()
    {
        //requête sql
        $sql = "SELECT id, name
        FROM brand
        WHERE footer_order > 0
        ORDER BY footer_order ASC
        LIMIT 5";

        $pdo = Database::getPDO(); // récupère notre connexion à la bdd
        $stmt = $pdo->query($sql); // exécute la requête sur le serveur mysql

        $brands = $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__); // récupère les données du serveur mysql, va nous créer une instance de notre classe pour chaque ligne de résultat
        return $brands;
    }

    // méthode nous retournant toutes les marques de la bdd
    public function findAll()
    {
        
        $sql = "SELECT * FROM brand ORDER BY name ASC";

    
        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $brands = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $brands;
    }


    public function find($id)
    {
        $sql = "SELECT * FROM brand 
                    WHERE id = $id";
    
        $pdo = Database::getPDO();
    
        $stmt = $pdo->query($sql);
    
        $brand = $stmt->fetchObject(self::class);
    
        return $brand;
    }

    // méthode nous retournant tous les produits d'une catégorie donnée de la bdd
    public function findAllProductsFromBrand($brand_id)
    {
        $sql = "SELECT product.name, product.picture, product.price, product.category_id, category.name category_name, product.type_id, type.name type_name, product.brand_id, brand.name brand_name
        FROM product
        JOIN type
        ON product.type_id = type.id
        JOIN category
        ON product.category_id = category.id
        JOIN brand
        ON product.brand_id = brand.id
        WHERE product.brand_id = $brand_id";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $products;
    }

    public function totalProductsByBrands()
    {
        $sql = "SELECT COUNT(*) nb, brand.id, brand.name
        FROM `product` 
        JOIN `brand`
        WHERE product.brand_id = brand.id
        GROUP BY brand.id";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);

        return $result;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Get the value of footer_order
     */
    public function getFooter_order()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @return  self
     */
    public function setFooter_order($footer_order)
    {
        $this->footer_order = $footer_order;

        return $this;
    }

    public function getNb()
    {
        return $this->nb;
    }
}
