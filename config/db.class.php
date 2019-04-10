<?php //IDEA:

class Db{
    protected static $connection;
    
    public function connect(){
        if(!isset(self::$connection)){

            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);

        }

        if(self::$connection == false){
            return false;
        }
        return self::$connection;
    }

    public function query_execute($queryString){
        $connection = $this->connect();
        $connection->query("SET NAMES utf8");

        $result = $connection->query($queryString);
        //$connection->close();
        return $result;
    }

    public function select_to_array($queryString){
        $row = array();
        $result = $this->query_execute($queryString);
        if($result == false) return false;

        while($item = $result -> fetch_assoc()){
            $row[] = $item;
        }
        return $row;
    }

    //lay danh sach theo loai san pham
    public static function list_product_by_cateid($cateid){
        $db = new Db();
        $sql = "SELECT * FROM product WHERE CateID='$cateid'";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>