<?php
    include "connection.php";

    $request = $_SERVER['REQUEST_METHOD'];
    
   if($request === "GET") {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM theater WHERE id = $id";
        } else if(isset($_GET['name'])){
            $name= $_GET['name'];
            $sql = "SELECT * FROM theater WHERE name = '$name'";
        } 
		else
            $sql = "SELECT * FROM theater";
        
        $query = mysqli_query($connection, $sql);
        
        $item = array();
        while($data = mysqli_fetch_array($query)){
            $item[] = array(
                'id' => $data['id'],
                'name' => $data['name'],
                'address' => $data['address']
				
            );
        }
        
        $json = array(
            'statusCode' => 200,
            'item' => $item
        );
        
        echo json_encode($json);
    } else if($request === "POST") {
        if(isset($_POST['name']) && isset($_POST['address'])){
            $name = $_POST['name'];
            $address = $_POST['address'];
           
            $sql = "INSERT INTO theater(name,address) VALUES('$name','$address')";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM theater";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'address' => $data['address']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success add theater data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed add theater data"
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
            $address = $_PUT['address'];
            
            $sql = "UPDATE theater SET name='$name', address='$address' WHERE id=$id ";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM theater";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'address' => $data['address']
					
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success Update theater Data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed Update theater Data"
                );
            }
        }
        
        echo json_encode($json);
    }else if($request === "DELETE"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $sql = "DELETE FROM theater WHERE id='$id'";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                
                $item = array(
                    'id' => $id,
                );
                $json = array(
                    'statusCode' => 200,
                      'message' => "Success delete theater data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed delete theater data"
                );
            }
        }
        
        echo json_encode($json);
    }
?>