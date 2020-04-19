<?php 

//Pour comprendre les classes Model, regarder Brand.php
namespace Oshop\Model;
use Oshop\Database;
use PDO;

class Type extends CoreModel
{
    private $name;
    private $footer_order;


    public function __construct()     //juste pour démonstration, ce constructeur ne fait absolument rien
    {  
        parent::__construct(); //appelle le constructeur du parent, si on ne veut pas l'écraser complètement !
        //autres instructions spécifiques à Type
    }
    
    public function findFiveFooterType()
    {
        $sql = "SELECT id, name
        FROM type
        WHERE footer_order > 0
        ORDER BY footer_order ASC
        LIMIT 5";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $types = $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        return $types;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM type
                ORDER BY name ASC";

        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $types = $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        return $types;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM type 
                WHERE id = $id";
        
        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        $type = $stmt->fetchObject(self::class);
        return $type;
    }

    public function totalProductsByTypes()
    {
        $sql = "SELECT COUNT(*) nb, type.id, type.name
        FROM `product` 
        JOIN `type`
        WHERE product.type_id = type.id
        GROUP BY type.id";

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