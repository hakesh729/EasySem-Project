<?php
    include "dbConn.php";
    $oper = $_POST["option"];
    $day = $_POST["day"];
    $course = $_POST["courseNo"];
    $note = $_POST["notes"];

    if($oper == "Add Notes"){
        $sql = "SELECT * FROM ".$course;
        $result = $conn->query($sql);
        $newDay = $result->num_rows + 1;
        $stmt = $conn->prepare("INSERT INTO ".$course." (id,courseNote) VALUES (?,?)");
        $stmt->bind_param("is",$newDay,$note);
        $stmt->execute();
        $conn->close();
        include "index2.php";
    }
    else if($oper == "Delete Notes"){
        $sql = "DELETE FROM ".$course." WHERE id= ".$day;
        $conn->query($sql);

        $sql = "SELECT * FROM ".$course;
        $result = $conn->query($sql);
        $numRow = $result->num_rows;

        while($day <= $numRow){
            $next = $day + 1;
            $sql = "UPDATE ".$course." SET id= ".$day." WHERE id=".$next;
            $conn->query($sql);
            $day = $next;
        }

        $conn->close();
        include "index2.php";
    }
    else{
        $sql = "UPDATE ".$course." SET courseNote='".$note."'"." WHERE id=".$day;
        $conn->query($sql);
        $conn->close();
        include "index2.php";
    }
?>