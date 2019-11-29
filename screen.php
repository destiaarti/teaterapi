<?php
    include "connection.php";

    $request = $_SERVER['REQUEST_METHOD'];
    
   if($request === "GET") {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM screen WHERE id = $id";
        } else if(isset($_GET['theatre_id'])){
            $theatre_id= $_GET['theatre_id'];
            $sql = "SELECT * FROM screen WHERE theatre_id = '$theatre_id'";
        } else if(isset($_GET['name'])){
            $minutes = $_GET['name'];
            $sql = "SELECT * FROM screen WHERE name = '$name'";
        }  
		else
            $sql = "SELECT * FROM screen";
        
        $query = mysqli_query($connection, $sql);
        
        $item = array();
        while($data = mysqli_fetch_array($query)){
            $item[] = array(
                'id' => $data['id'],
                'name' => $data['name'],
                'theatre_id' => $data['theatre_id'],
                'seats' => $data['seats']
              
            );
        }
        
        $json = array(
            'statusCode' => 200,
            'item' => $item
        );
        
        echo json_encode($json);
    } else if($request === "POST") {
        if(isset($_POST['name']) && isset($_POST['theatre_id']) && isset($_POST['seats'])){
            $name = $_POST['name'];
            $minutes = $_POST['theatre_id'];
            $description = $_POST['seats'];
            
            $sql = "INSERT INTO screen(name, theatre_id, seats) VALUES('$name', '$theatre_id', '$seats')";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM screen";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'theatre_id' => $data['theatre_id'],
					'seats' => $data['seats']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success add room data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed add room data"
                );
            }
        }
        
 echo json_encode($json);
    }else if($request === "PUT"){
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_GET['id']) && isset($_PUT['name'])&& isset($_PUT['theatre_id'])){
            $id = $_GET['id'];
            $name = $_PUT['name'];
            $theatre_id = $_PUT['theatre_id'];
            $seats = $_PUT['seats'];
            
            $sql = "UPDATE screen SET name='$name', theatre_id='$theatre_id', seats='$seats' WHERE id=$id ";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM screen";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'theatre_id' => $data['theatre_id'],
					'screen' => $data['screen']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success update room data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed update room data"
                );
            }
        }
        
        echo json_encode($json);
    }else if($request === "DELETE"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $sql = "DELETE FROM screen WHERE id='$id'";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                
                $item = array(
                    'id' => $id,
                );
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success delete room data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed delete room data"
                );
            }
        }
        
        echo json_encode($json);
    }
?>