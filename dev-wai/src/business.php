<?php


use MongoDB\BSON\ObjectID;

class Database {
    public $db;

    function __construct() {
        $this->init_db();
    }

    function init_db() {
        $mongo = new MongoDB\Client(
            "mongodb://localhost:27017/wai", [
                'username' => 'wai_web',
                'password' => 'w@i_w3b',
            ]
        );
        
        $this->db = $mongo->wai;
    }
}



/*
function get_products()
{
    $db = get_db();
    return $db->products->find()->toArray();
}

function get_products_by_category($cat)
{
    $db = get_db();
    $products = $db->products->find(['cat' => $cat]);
    return $products;
}

function get_product($id)
{
    $db = get_db();
    return $db->products->findOne(['_id' => new ObjectID($id)]);
}

function save_product($id, $product)
{
    $db = get_db();

    if ($id == null) {
        $db->products->insertOne($product);
    } else {
        $db->products->replaceOne(['_id' => new ObjectID($id)], $product);
    }

    return true;
}

function delete_product($id)
{
    $db = get_db();
    $db->products->deleteOne(['_id' => new ObjectID($id)]);
}
*/

?>