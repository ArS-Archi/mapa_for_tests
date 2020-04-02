<?php
class Objects{
    private $db_connect;
    private $db_table_p = 'point';
    private $db_table_s = 'section';
    // поля таблицы point
    public $id_p;
    public $latitude;
    public $longitude;
    public $lat1;
    public $lon1;
    public $lat2;
    public $lon2;
    public $id_way;
    // поля таблицы section
    public $id_s;
    public $idpointf;
    public $idpoints;
    public $distance;
    
    // конструктор для соединения с базой данных 
    public function __construct($db){
        $this->db_connect = $db;
    }
    // читаем данные из базы
    // метод read() - получение товаров 
    function read($rect){

    // выбираем все записи 
    
    $query = "SELECT 
        section.id id, 
        p1.latitude latitude1, 
        p2.latitude latitude2, 
        p1.longitude longitude1, 
        p2.longitude longitude2,
        section.distanse distanse
    FROM 
        section, 
        point p1, 
        point p2 
    where 
        section.idpointf = p1.id AND 
        section.idpoints = p2.id AND 
        p1.latitude  >".$rect[0]."AND
        p1.longitude >".$rect[1]."AND 
        p2.latitude  <".$rect[2]."AND 
        p2.longitude <".$rect[3];
        // подготовка запроса 
        $stmt = $this->db_connect->prepare($query);

        // выполняем запрос 
        $stmt->execute();

        return $stmt;
    }
}
?>