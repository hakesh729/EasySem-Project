<?php
include "dbConn.php";
$sql = "CREATE TABLE courseList(
        id INT(6),
        courseNumber VARCHAR(15) NOT NULL,
        courseTitle VARCHAR(150) NOT NULL
        )";
$conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EasySem</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" >
        <link rel="stylesheet" href="index.css">
    </head>

    <body>
        <nav>
            <ul>
                <li id = "title"><a href="#">Title</a></li>
                <li><a href="#">Notes</a></li>
                <li><a href="#">Edit</a></li>
                <li><a href="#">List</a></li>
                <li><a href="#">Motivation</a></li>
            </ul>
        </nav>

        <div id="getNote">
            <h4 style="text-align: center;">Fetch Notes</h4>
            <br>
            <form name="getNote" onsubmit="return check_getNote_form()" action="index2.php" method="post">
                <select name="courseNo">
                    <option>Select Course</option>
                <?php
                    include "dbConn.php";
                    $sql = "SELECT courseNumber FROM courseList";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<option>".$row["courseNumber"]."</option>";
                    }
                    }
                    $conn->close();
                ?>
                </select>
                <br><br>
                <input type="submit" class="submit" value="Get Notes"> 
            </form>
        </div>
        
        <div id="edit">
            <h4 style="text-align: center;">Edit Courses</h4>
            <form name = "edit" onsubmit="return check_edit_form()" action="edit.php" method = "post">
                <select id="option" name="option">
                    <option name="addCourse" value="Add Course">Add Course</option>
                    <option name="deleteCourse" value="Delete Course">Delete Course</option> Course</option>
                    <option name="updateCourse" value="Update Title">Update Course Title</option>
                </select>
                <br><br>
                <input name="courseNo" placeholder="course number" type="text" class="input">
                <br><br>
                <textarea type="text" rows="2" name="courseTitle" placeholder="Course Title" id="textarea"></textarea>
                <br>
                <input type="submit" value="Save">
            </form>
        </div>
        
        <div id="courseList">
            <h4 style="text-align: center;">Courses List</h4>
            <br>
            <table id="table">
                <tr>
                    <th>S.No</th>
                    <th>Course Number</th>
                    <th>Course Title</th>
                </tr>
                <?php
                    include "dbConn.php";
                    $sql = "SELECT courseNumber,courseTitle FROM courseList";
                    $result = $conn->query($sql);
                    $sno = 1;
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='text-align:center;'>".$sno."</td>";
                        echo "<td style='text-align:center;'>".$row["courseNumber"]."</td>";
                        echo "<td style='text-align:center;'>".$row["courseTitle"]."</td>";
                        echo "</tr>";
                        $sno = $sno + 1;
                    }
                    }
                    $conn->close();
                ?>
            </table>
        </div>


        <script src="index.js"></script>
        
        
    </body>
</html>