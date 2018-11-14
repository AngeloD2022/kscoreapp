<header>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <center>
        <h1 style="color: white;">Dashboard</h1>
    </center>

</header>


<body onload="initializePage()">
    <div id="eventTbl">
        <p id="loginas">Loading...</p>
        <center>
            <table id="events">
                <tr>
                    <th>Event name</th>
                    <th>Event creator</th>
                    <th>Sport</th>
                    <th>Opposing team</th>
                    <th>Your options...</th>
                </tr>
                <?php
require "db.php";
require "authentication.php";
$auth = authenticate();

$sql = "SELECT * FROM events where usrID='".$auth["id"]."' and deleted=0";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {    
        ?>
            <tr>
                <td><?=$row["name"];?></td>
                <td><?=$row["usrCreated"];?></td>
                <td><?=$row["sport"];?></td>
                <td><?=$row["opposing"];?></td>
                <td><button>Modify</button><button>Delete</button></td>
            </tr>


        <?php
    }
} else {
    echo "error_noevents";
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
            <button onclick="toggleDialog('mod')" class="modEvent">Modify event</button>
            <button onclick="toggleDialog('cancel')" class="cancelEvent">Cancel event</button>
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
            <label for="ce_grade">Grade: </label>
            <select class="ins" id="ce_grade">
                <option value="NONE">- Select one -</option>
                <option value="pre">Preschool</option>
                <option value="k">Kidnergarden</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
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



</body>


<script src="initPage.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>