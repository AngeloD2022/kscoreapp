<header>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <center>
        <h1 style="color: white;">Dashboard</h1>
    </center>

</header>


<body onload="initializePage()">
    <div id="ctrlPanel">
        <p id="loginas">Loading...</p>
        <center>
            <table id="evTbl">
                <tr>
                    <th>Identifier</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Opposing</th>
                    <th>Sport</th>
                    <th>Team Class</th>
                    <th>Your options...</th>
                </tr>
                <?php
require "globalassets/dbinit.php";
require "globalassets/authentication.php";
$authBack = authenticate();
$sql="SELECT * from events WHERE usrID=".$authBack["id"]." AND deleted=0";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()){
        $dbEntrys[] = $row;
        ?>
        <tr <?= $row["active"] == 1? 'style="background-color:rgb(153, 255, 153);"':""?>>
            <td><?=$row["id"];?></td>
            <td><?=$row["name"];?></td>
            <td><?=$row["active"] == 1? "Active":"Inactive"?></td>
            <td><?=$row["opposing"];?></td>
            <td><?=$row["sport"];?></td>
            <td><?=$row["teamClass"];?></td>
            <td><button class="launch" id="launch<?=$row["id"];?>"><?=$row["active"] == 1? "Open":"Start"?></button><button style="margin:2px;" id="edit<?=$row["id"];?>">Edit</button><button id="delete<?=$row["id"];?>">Delete</button></td>
        </tr>
        <?php
    }
}
?>
            </table>
        </center>
    </div>
    <center>
        <br />
        <!-- Buttons are here -->
        <div class="buttons">
            <button onclick="toggleDialog('create')" class="createEvent">Create event</button>
        </div>
    </center>


    <!-- CreateEvent Dialog -->
    <div class="Modal" id="createEvent">
        <div class="ModalContents">
            <span style="color: white;" onclick="toggleDialog(lastClicked)" class="closeBtn">&times;</span>
            <h2>Create new event...</h2>
            <!--EVENT NAME-->
            <input class="ins" type="text" placeholder="Event Name" id="ce_name"><br>
            <input class="ins" type="text" placeholder="Opposing Team" id="ce_opposing"><br>
            <label for="ce_timestart">Event start time:</label>
            <input class="ins" type="datetime-local" id="ce_timestart"><br>
            <p style="margin-bottom: 0px;">Team Class</p>
            <select class="ins" id="ce_teamclass" size="3">
                <option value="varsity">Varsity</option>
                <option value="jv">Junior Varsity</option>
                <option value="other">Other</option>
            </select><br>
            <label for="ce_school">Grade: </label>
            <select class="ins" id="ce_school">
                <option value="NONE">- Select one -</option>
                <option value="pre">Preschool</option>
                <option value="elem">Elementary School</option>
                <option value="ms">Middle School</option>
                <option value="hs">High School</option>
            </select><br>
            <input class="ins" type="text" placeholder="Event location" id="ce_location"><br>
            <input class="ins" type="text" placeholder="Opponent's logo URL" id="ce_oppLogo"><br>
            <select class="ins" id="ce_sport">
                <option value="NONE">- Select one -</option>
                <option value="football">Football</option>
                <option value="soccer">Soccer</option>
            </select><br/><br/>

            <button onclick="createSportEvent()" style="float: right;margin-bottom: 11px;margin-right: 19px;" class="ins" id="subm">OK</button>
            <button class="ins" style="float: right;margin-top: 6px;margin-right: 25px;" onclick="toggleDialog(lastClicked)">Cancel</button>

        </div>
    </div>

    <!-- modEvent Dialog -->
    <div class="Modal" id="modEvent">
        <div class="ModalContents">
            <span onclick="toggleDialog(lastClicked)" class="closeBtn">&times;</span>
            <p>modEvent</p>
            <button>Submit</button>
        </div>

    </div>
    <!-- cancelEvent Dialog -->
    <div class="Modal" id="cancelEvent">
        <div class="ModalContents">
            <span onclick="toggleDialog(lastClicked)" class="closeBtn">&times;</span>
            <p>cancelEvent</p>
            <button>Submit</button>
        </div>
    </div>

    <script type="text/javascript" src="fetchEvents.js"></script>
    <script language="javascript">
        var ids = [
    <?php
    $length = count($dbEntrys);
    $x = 0;
    foreach ($dbEntrys as $row) {

        ?>
        <?= $row["id"];
        if ($x != $length - 1) { // makes sure there isn't a comma at the end of the array initialization.
            print(", ");
        } 
        ?> 
        
<?php
$x++;
}
?>
 ];

<?php
    $length = count($dbEntrys);
    $x = 0;
    foreach ($dbEntrys as $row) {

        ?>
        var edit<?=$row["id"]?> = document.getElementById("edit<?=$row["id"]?>");
        var delete<?=$row["id"]?> = document.getElementById("delete<?=$row["id"]?>");
        var launch<?=$row["id"]?> = document.getElementById("launch<?=$row["id"]?>");
        edit<?=$row["id"]?>.addEventListener("click", function(){editEvent(<?=$row["id"]?>);});
        delete<?=$row["id"]?>.addEventListener("click", function(){deleteEvent(<?=$row["id"]?>);});
        launch<?=$row["id"]?>.addEventListener("click", function(){launchEvent(<?=$row["id"]?>, launch<?=$row["id"]?>);});
<?php
$x++;
}
?>
 // actual coding here




</script>


</body>

<script src="initPage.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>