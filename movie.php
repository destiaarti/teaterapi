<?php
    include "connection.php";

    $request = $_SERVER['REQUEST_METHOD'];
    
   if($request === "GET") {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM movie WHERE id = $id";
        } else if(isset($_GET['name'])){
            $name= $_GET['name'];
            $sql = "SELECT * FROM movie WHERE name = '$name'";
        } else if(isset($_GET['minutes'])){
            $minutes = $_GET['minutes'];
            $sql = "SELECT * FROM movie WHERE minutes = '$minutes'";
        }  
		else
            $sql = "SELECT * FROM movie";
        
        $query = mysqli_query($connection, $sql);
        
        $item = array();
        while($data = mysqli_fetch_array($query)){
            $item[] = array(
                'id' => $data['id'],
                'name' => $data['name'],
                'minutes' => $data['minutes'],
                'description' => $data['description']
              
            );
        }
        
        $json = array(
            'statusCode' => 200,
            'item' => $item
        );
        
        echo json_encode($json);
    } else if($request === "POST") {
        if(isset($_POST['name']) && isset($_POST['minutes']) && isset($_POST['description'])){
            $name = $_POST['name'];
            $minutes = $_POST['minutes'];
            $description = $_POST['description'];
            
            $sql = "INSERT INTO movie(name, minutes, description) VALUES('$name', '$minutes', '$description')";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM movie";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'minutes' => $data['minutes'],
					'description' => $data['description']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success add movie data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed add movie data"
                );
            }
        }
        
 echo json_encode($json);
    }else if($request === "PUT"){
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_GET['id']) && isset($_PUT['name'])){
            $id = $_GET['id'];
            $name = $_PUT['name'];
            $minutes = $_PUT['minutes'];
            
            $sql = "UPDATE movie SET name='$name', minutes='$minutes' WHERE id=$id ";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM movie";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'minutes' => $data['minutes'],
					'description' => $data['description']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success update movie data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed update movie Data"
                );
            }
        }
        
        echo json_encode($json);
    }else if($request === "DELETE"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $sql = "DELETE FROM movie WHERE id='$id'";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                
                $item = array(
                    'id' => $id,
                );
                $json = array(
                    'statusCode' => 200,
          'message' => "Success delete movie data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed delete movie data"
                );
            }
        }
        
        echo json_encode($json);
    }
?>