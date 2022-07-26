<?php 


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require 'db.php';
require '../vendor/autoload.php';

$app = new \Slim\App;
session_start();

//ACCOMODATION_MANAGER
//GET: Read approve/reject list
$app->get('/students_apprej_list', function (Request $request, Response $response) {
    

    $sql = "SELECT * FROM student WHERE approvalstatus = '0' AND NOT college = '';" ;

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//GET: Read approve/reject list (single ID)
$app->get('/students_apprej_list/{id}', function (Request $request,  array $args) {
    $id=$args['id'];

    $sql = "SELECT * FROM student  WHERE id= $id";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//PUT: Update APPROVE
$app->put('/updateapprove/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $input = $request->getParsedBody();
    $sql = "UPDATE student SET approvalstatus = :1,  WHERE id = :id";

    try {
        //get the db object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':approvalstatus', 1);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
        if($count == 0){
            return $response->withJson(array('status' => 'Unsuccessful', 'message' => 'Failed to update'), 400);
        }
        $data = array(
            'status' => 'success',
            'message' => 'successfully update',
        );
        return $response->withJson($data, 200);


    } catch (PDOException $e) {
        $error = array(
            'status' => 'Error',
            'message' => $e->getMessage(),
        );
        return $response->withJson($error, 400);
    }


});

//GET: Read all student detail 
$app->get('/students_detail_list', function (Request $request, Response $response) {
    
    $sql = "SELECT * FROM student";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});


//GET: Read student detail (single Matric No.)
$app->get('/student_detail_list/', function (Request $request, Response $response, array $args) {
    $id=$args['matric'];
    $matric = $_POST['matric'];

    $sql = "SELECT * FROM student WHERE matric = '$matric'";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//GET: Read Accomodation Manager Data
$app->get('/accom', function (Request $request, Response $response, array $args) {
    $id=$_SESSION['STAFFID'];
    

    $sql = "SELECT * FROM AccomodationManager WHERE staffID = '$id'";

    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $bid = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bid);
    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }

});

//PUT: Update specific accomodation manager
$app->put('/updatemanager/{staffID}', function (Request $request, Response $response, array $args) {
    $id = $args['staffID'];
    $input = $request->getParsedBody();
    $sql = "UPDATE AccomodationManager SET name = :name, ic= :ic, WHERE staffID = :staffID";

    try {
        //get the db object
        $db = new db();
        //connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':staffID', $id);
        $stmt->bindParam(':name', $input['name']);
        $stmt->bindParam(':ic', $input['ic']);
        $stmt->execute();
        $count = $stmt->rowCount();
        $db = null;
        if($count == 0){
            return $response->withJson(array('status' => 'Unsuccessful', 'message' => 'Failed to update'), 400);
        }
        $data = array(
            'status' => 'success',
            'message' => 'successfully update',
        );
        return $response->withJson($data, 200);


    } catch (PDOException $e) {
        $error = array(
            'status' => 'Error',
            'message' => $e->getMessage(),
        );
        return $response->withJson($error, 400);
    }


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

//login
$app->post('/login', function (Request $request, Response $response, array $args) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
    
        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        

            if($stmt->rowCount() > 0){
                $_SESSION["Login"] = "YES";
                $_SESSION["USERNAME"] = $user['username'];
                $_SESSION["PASSWORD"] =$user['password'];
                $_SESSION["LEVEL"] =$user['level'];
                $_SESSION["MATRIC"] = $user['matric'];
                echo ($_SESSION["LEVEL"]);
            } 

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);  
    }
});

//login admin
$app->post('/admin_login', function ($request,$response, $args) {
    
    $matric = $_SESSION["MATRIC"];
    $sql = "SELECT * FROM adminn WHERE staffID = '$matric'";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        if($stmt->rowCount() > 0){
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = strtoupper ($user['name']);
            $_SESSION["ID"] = $user['id'];
            $_SESSION["IC"] = $user['ic'];
            $_SESSION["STAFFID"] = $user['matric'];
            echo ("OK");
        } 

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//login am
$app->post('/am_login', function ($request,$response, $args) {
    
    $matric = $_SESSION["MATRIC"];
    $sql = "SELECT * FROM accomodationmanager WHERE staffID = '$matric'";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        if($stmt->rowCount() > 0){
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = strtoupper ($user['name']);
            $_SESSION["ID"] = $user['id'];
            $_SESSION["IC"] = $user['ic'];
            $_SESSION["STAFFID"] = $user['matric'];
            echo ("OK");
        } 

    } catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
});

//login student
$app->post('/student_login', function ($request,$response, $args) {
    
    $matric = $_SESSION["MATRIC"];
    $sql = "SELECT * FROM student WHERE matric = '$matric'";
    try {
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        if($stmt->rowCount() > 0){
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = strtoupper ($user['name']);
            $_SESSION["ID"] = $user['id'];
            $_SESSION["IC"] = $user['ic'];
            $_SESSION["MATRIC"] = $user['matric'];
            echo ("OK");
        } 

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