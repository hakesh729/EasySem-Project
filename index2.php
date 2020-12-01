<!DOCTYPE html>
<html>
    <head>
        <title>Project</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" >
        <link rel="stylesheet" href="index2.css">
    </head>

    <body>
        <nav>
            <ul>
                <li id = "title"><a href="#">Title</a></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Edit</a></li>
                <li><a href="#">List</a></li>
                <li><a href="#">Motivation</a></li>
            </ul>
        </nav>

        <div id="edit">
            <h4 style="text-align: center;">Edit Notes</h4>
            <br>
            <form name="form" onsubmit="return check_form()" action="edit_note.php" method="post">
                <select name="option">
                    <option value="Add Notes">Add Notes</option>
                    <option value="Delete Notes">Delete Notes</option>
                    <option value="Update Notes">Update Notes</option>
                </select>
                <br><br>
                <input type="number" name="day" placeholder="Day" id="day" >
                <br>
                <input type="hidden" name="courseNo" value="<?php echo $_POST["courseNo"] ?>"> 
                <textarea name="notes" rows="20" cols="40" placeholder="Notes" id="notes"></textarea>
                <br><br>
                <input type="submit" value="save" style="float: right;">
            </form>
        </div>

        <div id="note">
            <h4 style="text-align: center;"><?php echo $_POST["courseNo"] ?></h4>
            <br>
            <table id="table" style="background-color: white;">
                <colgroup>
                    <col span="1" style="width:1cm;">
                    <col style="width : 21cm;">
                  </colgroup>
                <tr>
                    <th>Day</th>
                    <th>Notes</th>
                </tr>
                <?php
                    include "dbConn.php";
                    $sql = "SELECT courseNote FROM ".$_POST["courseNo"];
                    $result = $conn->query($sql);
                    $day = 1;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>".$day."</td>";
                          echo "<td>".$row["courseNote"]."</td>";
                          echo "</tr>";
                          $day = $day + 1;
                        }
                      }
                      $conn->close();
                ?>

            </table>
        </div>

        <script src="index2.js"></script>
    </body>
</html>
