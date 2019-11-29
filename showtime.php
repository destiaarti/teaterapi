<?php
    include "connection.php";

    $request = $_SERVER['REQUEST_METHOD'];
    
   if($request === "GET") {
        if(isset($_GET['id'])){
            $theater_id = $_GET['id'];
            $sql = "SELECT * FROM showtime WHERE id = $id";
        } 
		
		else if(isset($_GET['screen_id'])){
            $screen_id = $_GET['screen_id'];
            $sql = "SELECT * FROM showtime WHERE screen_id = '$screen_id'";
        } else if(isset($_GET['movie_id'])){
            $movie_id = $_GET['movie_id'];
            $sql = "SELECT * FROM showtime WHERE movie_id = '$movie_id'";
        }  
		else
            $sql = "SELECT * FROM showtime";
        
        $query = mysqli_query($connection, $sql);
        
        $item1 = array();
        while($data = mysqli_fetch_array($query)){
            $item1[] = array(
                'id' => $data['id'],
              
                'screen_id' => $data['screen_id'],
                'movie_id' => $data['movie_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
            );
        }
        
        $json = array(
            'statusCode' => 200,
            'item' => $item1
        );
        
        echo json_encode($json);
    } else if($request === "POST") {
        if( isset($_POST['screen_id'])&& isset($_POST['movie_id_id'])&& isset($_POST['start_date'])&& isset($_POST['end_date'])){
         
            $screen_id = $_POST['screen_id'];
            $movie_id = $_POST['movie_id'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            
            $sql = "INSERT INTO showtime(  screen_id, movie_id, start_date, end_date) VALUES( '$screen_id', $movie_id, $start_date, $end_date)";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM showtime" ;
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
                          
                'screen_id' => $data['screen_id'],
                'movie_id' => $data['movie_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success add movie theater time data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed add movie theater time data"
                );
            }
        }
        
 echo json_encode($json);
    }else if($request === "PUT"){
        $_PUT = array();
        parse_str(file_get_contents('php://input'), $_PUT);
        if(isset($_GET['id']) && isset($_PUT['movie_id']) && isset($_PUT['screen_id']) && isset($_PUT['start_date'])&& isset($_PUT['end_date'])){
            $id = $_GET['id'];
           
            $movie_id = $_PUT['movie_id'];
            $screen_id = $_PUT['screen_id'];
            $start_date = $_PUT['start_date'];
            $end_date = $_PUT['end_date'];
            
            $sql = "UPDATE showtime SET movie_id='$movie_id', screen_id='$screen_id', start_date='$start_date', end_date='$end_date' WHERE id='$id'";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                $sql = "SELECT * FROM showtime WHERE id = $id";
                $query = mysqli_query($connection, $sql);
                
                $item = array();
                while($data = mysqli_fetch_array($query)) {
                    $item[] = array(
                               
             
                'screen_id' => $data['screen_id'],
                'movie_id' => $data['movie_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date']
                    );
                }
                $json = array(
                    'statusCode' => 200,
                    'message' => "Success Update movie theater time  data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed Update movie theater time data"
                );
            }
        }
        
        echo json_encode($json);
    }else if($request === "DELETE"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $sql = "DELETE FROM showtime WHERE id='$id'";            
            $query = mysqli_query($connection, $sql);
            
            if(mysqli_affected_rows($connection) > 0){
                
                $item = array(
                    'id' => $id,
                );
                $json = array(
                    'statusCode' => 200,
                  'message' => "Success delete movie theater time data",
                    'item' => $item
                );
            } else{            
                $json = array(
                    'statusCode' => 400,
                    'message' => "Failed delete movie theater time  data"
                );
            }
        }
        
        echo json_encode($json);
    }
?>