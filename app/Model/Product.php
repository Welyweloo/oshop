<?php

//Pour comprendre les classes Model, regarder Brand.php

namespace Oshop\Model;

use Oshop\Database;
use PDO;

// cette class sert à représenter les produits de notre app, une instance de cette class === une ligne de la table

class Product extends CoreModel
{
    private $name;
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;
    private $type_name;
    private $category_name;
    private $brand_name;

    // méthode nous retournant tous les produits de la bdd
    public function findAll()
    {
        $sql = "SELECT * FROM product ORDER BY created_at DESC";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $products;
    }

    //retourne un seul produit en fonction de son id
    public function find($id)
    {

        $sql = "SELECT product.*, brand.name AS brand_name, type.name AS type_name, category.name AS category_name
        FROM product
        JOIN brand ON product.brand_id = brand.id 
        JOIN type ON product.type_id = type.id 
        JOIN category ON product.category_id = category.id 
        WHERE product.id = $id ";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $product = $stmt->fetchObject(self::class);
        return $product;
    }

    public function findWithCatAndTypePrices()
    {
        $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.brand_id, brand.name brand_name, product.type_id, type.name type_name
        FROM `product`
        JOIN `type`
        ON product.type_id = type.id
        JOIN `category`
        ON product.category_id = category.id
        JOIN `brand`
        ON product.brand_id = brand.id";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $product = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $product;
    }


    public function sortName()
    {
        $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.brand_id, brand.name brand_name, product.type_id, type.name type_name
        FROM `product`
        JOIN `type`
        ON product.type_id = type.id
        JOIN `category`
        ON product.category_id = category.id
        JOIN `brand`
        ON product.brand_id = brand.id
        ORDER BY product.name";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);


        $product = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $product;
    }

    public function sortPriceAsc()
    {
        $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.brand_id, brand.name brand_name, product.type_id, type.name type_name
        FROM `product`
        JOIN `type`
        ON product.type_id = type.id
        JOIN `category`
        ON product.category_id = category.id
        JOIN `brand`
        ON product.brand_id = brand.id
        ORDER BY product.price ASC";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $product = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $product;
    }

    public function sortPriceDesc()
    {

        $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.type_id, type.name type_name
        FROM `product`
        JOIN `type`
        ON product.type_id = type.id
        JOIN `category`
        ON product.category_id = category.id
        JOIN `brand`
        ON product.brand_id = brand.id
        ORDER BY product.price DESC";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);


        $product = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $product;
    }

        // méthode nous retournant tous les produits d'une catégorie donnée de la bdd
        public function findAllProductsFromBrand($brand_id)
        {
            $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.type_id, type.name type_name, product.brand_id, brand.name brand_name
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

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function getPriceForCurrentCurrency() //Permet de calculer le prix selon la devise stockée en session, si pas de session, la devise par défaut est l'euro (codeIso 978)
    {   $price = 0;
        if(empty($_SESSION['currency'])){
            $viewVars["currency"] == 978;
            $this->price;
        } else {
            if($_SESSION['currency'] == 978){
               $this->price;
            } else if($_SESSION['currency'] == 840){
                $this->price *= 1.07;
            } else if($_SESSION['currency'] == 826){
                $this->price *= 0.93;
            } 
        }
        return $this->price;
    }

    public function getSignForCurrency() // Permet d'afficher le signe de la devise en session après chaque montant
    {
        $sign = '';
        if(empty($_SESSION['currency'])){
            $sign = "€";
        } else {
            if($_SESSION['currency'] == 978){
                $sign = "€";
            } else if($_SESSION['currency'] == 840){
                $sign = "$";
            } else if($_SESSION['currency'] == 826){
                $sign = "<span>&#163;</span>";
            } 
        }
        return $sign;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function insert()
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }

    public function get()
    {
        return $this->$id;
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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }



    /**
     * Get the value of rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @return  self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of brand_id
     */
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @return  self
     */
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of type_id
     */
    public function getType_id()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @return  self
     */
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    public function getCategory_name()
    {
        return $this->category_name;
    }

    public function getType_name()
    {
        return $this->type_name;
    }

    public function getBrand_name()
    {
        return $this->brand_name;
    }

}
