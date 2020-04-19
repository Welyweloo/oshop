<?php
namespace Oshop\Model;
use Oshop\Database;
use PDO;

//Pour comprendre les classes Model, regarder Brand.php

class Category extends CoreModel
{
    private $name;
    private $subtitle;
    private $picture;
    private $home_order;
    

    public function findAll()
    {

        $sql = "SELECT * FROM category ORDER BY name ASC";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $categories;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM category 
                WHERE id = $id";
        
        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $category = $stmt->fetchObject(self::class);

        return $category;
    }

    // méthode nous retournant tous les produits d'une catégorie donnée de la bdd
    public function findAllProductsFromCategory($category_id)
    {
        $sql = "SELECT product.id, product.name, product.picture, product.price, product.category_id, category.name category_name, product.type_id, type.name type_name
        FROM product
        JOIN type
        ON product.type_id = type.id
        JOIN category
        ON product.category_id = category.id
        WHERE product.category_id = $category_id";


        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $products;
    }

    public function findNamesPricesOfFollowingCategory($category_id)
    {
        $sql = "SELECT product.name, product.price
        FROM `product`
        JOIN `category`
        ON product.category_id = category.id
        WHERE product.category_id = 1+$category_id";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $products;
    }

    public function totalProductsByCategories()
    {
        $sql = "SELECT COUNT(*) nb, category.id, category.name
        FROM `product` 
        JOIN `category`
        WHERE product.category_id = category.id
        GROUP BY category.id";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $result;
    }
    
    public function categoriesOnHome()
    {

        $sql = "SELECT *
        FROM category
        WHERE home_order > 0
        ORDER BY home_order ASC
        LIMIT 5";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $categories;
    }

    public function countCategoryProducts()
    {
        $sql = "SELECT *
        FROM category
        WHERE home_order > 0
        ORDER BY home_order ASC
        LIMIT 5";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $categories;
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
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

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
     * Get the value of home_order
     */
    public function getHome_order()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */
    public function setHome_order($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }

    public function getNb()
    {
        return $this->nb;
    }
}