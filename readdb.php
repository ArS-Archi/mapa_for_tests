<?php
// HTTP-заголовки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
include_once 'objects/objects.php';
//$box[] = $_POST['bbox'];
$func = $_GET['callback'];
$rect = $_GET['bbox'];
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$obj = new Objects($db);

// запрашиваем отрезки 
$stmt = $obj->read($rect);
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей 
if ($num>0) {

    // массив маршрутных отрезков 
    $sections=array("type"=>"FeatureCollection","features"=>[]);

    // получаем содержимое нашей таблицы 
    // fetch() быстрее, чем fetchAll() 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $section_item=array(
        "type"=> "Feature",
        "id"=>$id,
        "options"=> array("strokeWidth"=> 2 ),
        "properties"=>array("balloonContent"=>"Содержимое балуна", "hintContent"=>$distanse),
        "geometry"=>array("type"=>"LineString","coordinates"=>array(array($latitude1, $longitude1),array($latitude2,$longitude2)))
        );

        array_push($sections["features"], $section_item);
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные о отрезке в формате JSON 
    echo $func.'({error: null,data:'. json_encode($sections).'})';
}

// маршрутные отрезки не найдены' будет здесь

?>