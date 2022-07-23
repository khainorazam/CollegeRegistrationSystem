<?php 


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'db.php';
require '../vendor/autoload.php';

$app = new \Slim\App;

$app->put('/user/{id}', function (Request $request, Response $response, array $args) {
    $id=$args['id'];
    $response->getBody()->write("This is update user with id... :$id");

    return $response;
});

//delete user
$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $id=$args['id'];
    try{
        $sql = "DELETE FROM user WHERE id = $id";

    // Get DB Object
    $db = new db();
    //Connect
    $db = $db->connect();
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    $db = null;
    $data = array(
        "rowAffected" => $count,
        "status" => "success"
    );

    echo json_encode($data);
} catch (PDOException $e) {
    $data = array(
        "status"=>"fail"
    );
    echo json_encode($data);
}
    // $response->getBody()->write("This is delete user with id... :$id");
    // return $response;


});

//post insert data
$app->post('/user', function (Request $request, Response $response, array $args) {

    // $response->getBody()->write("this is post user");

    // return $response;

    $name = $_POST["name"];
    $id = $_POST["id"];
    $email = $_POST["email"];
    $age = $_POST["age"];

    try {
        $sql = "INSERT INTO user (name,id,email,age) VALUES (:name,:id,:email,:age)";
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':age', $age);

        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;

        $data = array(
            "status" => "success",
            "rowcount" =>$count
        );
        echo json_encode($data);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->get('/user/{id}', function ($request,$response,$args) {
    
    $id = $args['id'];
    $sql = "SELECT * FROM user WHERE id = $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

$app->get('/user', function (Request $request, Response $response, array $args) {

    $sql = "SELECT * FROM user";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }



});

$app->get('/home', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("This is the home folder");

    return $response;
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("This is the root directory");

    return $response;
});


$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();

?>