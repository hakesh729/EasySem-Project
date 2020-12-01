<?php

include "dbConn.php";

$oper = $_POST["option"];
$course = strtoupper($_POST["courseNo"]);
$title = $_POST["courseTitle"];

if($oper == "Add Course"){
    $sql = "SELECT courseNumber FROM courseList";
    $result = $conn->query($sql);
    $insert = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["courseNumber"] == $course){
            $insert = 0;
            $conn->close();
            /*redirect to index.php with error*/ 
        ?><script>alert("Error : SAME COURSE ALREADY PRESENT!");</script><?php
        include "index.php";
            
        }
    }
    }
    
    if($insert == 1){
        //inserting new course into courseList Table
        $sql = "SELECT * FROM courseList";
        $result = $conn->query($sql);
        $numRow = $result->num_rows + 1;
        $stmt = $conn->prepare("INSERT INTO courseList (id,courseNumber,courseTitle) VALUES (?,?,?)");
        $stmt->bind_param("iss",$numRow,$course, $title);
        $stmt->execute();
        $stmt->close();
        //creating new Table for new Course notes.
        $sql = "CREATE TABLE ".$course." (
            id INT(6),
            courseNote VARCHAR(5000) NOT NULL)";
        $conn->query($sql);
        $conn->close();
        /*alert with proper msg  and redirect to index.php*/
        include "index.php";
    }
    
}

else if($oper == "Delete Course"){
    $present = 0;

    $sql = "SELECT courseNumber FROM courseList";
    $result = $conn->query($sql);
    $insert = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["courseNumber"] == $course){
            $present = 1;
        }
    }
    }

    if($present == 1){
        $sql = "DROP TABLE ".$course;
        $conn->query($sql);
        $sql = "DELETE FROM courseList WHERE courseNumber='".$course."'";
        $conn->query($sql);
        $conn->close();
        /*After deleting redirect to index.html with no alerts*/
        include "index.php";
        
    }
    else{
        /*Alert that no such course and redirect to index.php*/
        $conn->close();
        ?><script>alert("Error : NO SUCH COURSE PRESENT!");</script><?php
        include "index.php";
    }
    
}

else{
    $present = 0;

    $sql = "SELECT courseNumber FROM courseList";
    $result = $conn->query($sql);
    $insert = 1;
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["courseNumber"] == $course){
            $present = 1;
        }
    }
    }
    if ($present == 1) {
        $sql = "UPDATE courseList SET courseTitle='".$title."' WHERE courseNumber='".$course."'";
        $conn->query($sql);
        $conn->close();
        /*Redirect to Index.html with updation alert*/
        include "index.php";

    }
    else{
        /*Alert that course not present and redirect ot index.php*/
        $conn->close();
        ?><script>alert("Error : NO SUCH COURSE PRESENT!");</script><?php
        include "index.php";
    }

}

?>