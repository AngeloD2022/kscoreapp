<head>
    <style>
        #cardContainer {
            text-align: center;
        }
        .cardSep{
            border-left: 2px solid rgb(0, 150, 209);
        }
        .teamIcon{
            filter: drop-shadow(0px 2px 2px #adadad);
            -webkit-filter: drop-shadow(0px 2px 2px #adadad);
            -moz-filter: drop-shadow(0px 2px 2px #adadad);
        }
        .gameData{
            padding-right: 6px;
        }
        .smallTxt{
            font-size: 12px;
            margin-top: 3px;
        }
        
        
     
}
    </style>
    <link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
    
    <svg id="sbtn" class="searchbtn" version="1.1" viewBox="0.0 0.0 100.0 100.0" fill="none" stroke="none" stroke-linecap="square" stroke-miterlimit="10" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"><clipPath id="p.0"><path d="m0 0l100.0 0l0 100.0l-100.0 0l0 -100.0z" clip-rule="nonzero"/></clipPath><g clip-path="url(#p.0)"><path fill="#000000" fill-opacity="0.0" d="m0 0l100.0 0l0 100.0l-100.0 0z" fill-rule="evenodd"/><path fill="#000000" fill-opacity="0.0" d="m15.443569 39.133858l0 0c0 -13.254833 10.745167 -24.0 24.0 -24.0l0 0c6.365196 0 12.469688 2.5285635 16.970562 7.029437c4.5008736 4.5008736 7.029438 10.605366 7.029438 16.970562l0 0c0 13.254833 -10.745167 24.0 -24.0 24.0l0 0c-13.254833 0 -24.0 -10.745167 -24.0 -24.0z" fill-rule="evenodd"/><path stroke="#1f92d5" stroke-width="8.0" stroke-linejoin="round" stroke-linecap="butt" d="m15.443569 39.133858l0 0c0 -13.254833 10.745167 -24.0 24.0 -24.0l0 0c6.365196 0 12.469688 2.5285635 16.970562 7.029437c4.5008736 4.5008736 7.029438 10.605366 7.029438 16.970562l0 0c0 13.254833 -10.745167 24.0 -24.0 24.0l0 0c-13.254833 0 -24.0 -10.745167 -24.0 -24.0z" fill-rule="evenodd"/><path fill="#1f92d5" d="m57.7187 54.776917l21.511814 25.385826l-7.6850433 6.519684l-21.51181 -25.385822z" fill-rule="evenodd"/><path fill="#1f92d5" d="m70.42737 83.39392l0 0c0 -2.7483826 2.2279968 -4.9763794 4.976372 -4.9763794l0 0c1.3198166 0 2.585579 0.524292 3.518837 1.4575424c0.9332504 0.93325806 1.4575424 2.1990204 1.4575424 3.518837l0 0c0 2.748375 -2.2279968 4.976372 -4.9763794 4.976372l0 0c-2.748375 0 -4.976372 -2.2279968 -4.976372 -4.976372z" fill-rule="evenodd"/></g></svg>
    
    

    <div style="padding: 15px;" id="sbox" class="SearchMenuDefault">
        <h4>Search active events</h4>
        <p>Leave a field as it's default value to ignore it.</p>
        <form action="/" method="get">
            <p class="searchLabel"><label for="fti">Event starting time:</label><br>
            <input style="margin: 7px;" id="fti" name="ftime" type="datetime-local"/></p>
            <p class="searchLabel"><label for="fs">Sport:</label><br>
            <select style="margin: 7px;" id="fs" name="fsport">
                <option>Sport</option>
                <option value="soccer">Soccer</option>
                <option value="football">Football</option>
            </select></p>

            <p class="searchLabel"><label for="ft">Opposing team:</label><br>
            <input style="margin: 7px;" id="ft" name="fteam" placeholder="Team"/></p>
            <input type="submit"/>
        </form>

    </div>


    <link href="styles.css" rel="stylesheet" />
    <h1>Kenston Athletic Events</h1>
    <p>scores.kenstonapps.org</p>
    <center>
            <?php //perform the sql query here
            function filterFunction($a) { return !empty($a);}
            if(isset($_GET["ftime"]) && $_GET["ftime"] !=""||
            isset($_GET["fsport"]) && $_GET["fsport"] !=""||
            isset($_GET["fteam"]) && $_GET["fteam"] !=""){
                

                $strQuery = "";
                $iter = 0;
                foreach($_GET as $key => $val){
                    $k = $key == "ftime" && $val != ""? "Event time: ": ($key == "fsport" && $val != ""? "Sport: ": ($key == "fteam" && $val != ""? "Opposing team: ":""));
                    $strQuery = $strQuery . ($k.$val);
                    if ($iter != count($_GET) - 1 && $val != "") { // makes sure there isn't a comma at the end of the array initialization.
                        $strQuery = $strQuery.", ";
                    } 
                    $iter++;
                }
                echo $strQuery;
                echo '<br><a href="/">Clear query</a>';
            }?>
    <center>

    
</head>

<!-- $_GET["ftime"] == null? "x": $_GET["ftime"];
 $_GET["fsport"] == null? "x": $_GET["fsport"
 $_GET["fteam"] == null? "x": $_GET["fteam"];-->
<body>
    <center>
        <div id="cardContainer">

            <?php
            $sql = "SELECT * FROM events WHERE deleted=0"
            .(isset($_GET["ftime"]) && $_GET["ftime"] !="" ? " AND startingTS='".addslashes($_GET["ftime"])."'" : "")
            .(isset($_GET["fsport"]) && $_GET["fsport"] !="" ? " AND sport='".addslashes($_GET["fsport"])."'" : "")
            .(isset($_GET["fteam"]) && $_GET["fteam"] !="" ? " AND opposing='".addslashes($_GET["fteam"])."'" : "");
            

            
            
            
            

            $conn = new mysqli("localhost", "root", null, "scoreboard");
            if ($conn->connect_error) {
                die("Failed: " . $conn->connect_error);
            }


            
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {

                while ($r = $result->fetch_array()) {
                    $dbEntrys[] = $r;
                    $afterGrade;
                    if ($r["grade"] == 1) {
                        $afterGrade = "st";
                    } else if ($r["grade"] == 2) {
                        $afterGrade = "nd";

                    } else if ($r["grade"] == 3) {
                        $afterGrade = "rd";
                    } else {
                        $afterGrade = "th";
                    }
                    
                    
                    if($r["sport"] == "soccer"){
                        $sport = "Soccer";
                    }else if($r["sport"] == "football"){
                        $sport = "Football";
                    }
                    if($r["teamClass"] == "varsity"){
                        $tc = "Varsity";
                    }else if($r["teamClass"] == "jv"){
                        $tc = "JV";
                    }
                    
                    $gtime = date('l \a\t g:i a', strtotime($r["startingTS"]));
                    ?>
        
                            <div class="eventcard" id="event<?= $r["id"]; ?>">
                                <div class="cardContents">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="gameData">
                                                    <p style="margin-bottom: 7px;margin-top: 0px;"><?= $r["name"]; ?></p>
                                                    <hr width="100%" align="left">
                                                    <div class="gdDetailed">
                                                        <p>Kenston@<?= $r["location"]; ?></p>
                                                        <p style="margin-top: 5px;" class="smallTxt"><?= $r["grade"] . $afterGrade . " grade " . $tc . " " . $sport ?></p>
                                                        <p style="margin-top: 3px;" class="smallTxt"><?= $gtime; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                                <!--Past blue line-->
                                            <td class="cardSep">
                                                <div class="cardScores" style="padding: 6px;">
                                                    <table>
                                                        <tr>
                                                            <td><img class="teamIcon" src="kcrop.png" style="width: 45px; height: 45px; vertical-align: middle;"/></td>
                                                            <td style="margin-left: 8px;margin-right: 8px;">VS.</td>
                                                            <td><img class="teamIcon" src="<?= $r["oppLogoUrl"]; ?>" style="width: 45px; height: 45px; vertical-align: middle;"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><p id="hsID<?= $r["id"]; ?>" style="display: block;margin-left: 17px;margin-top: 7px;"><?=$r["homeScore"];?></p></td>
                                                            <td style="padding-left:7px;">to</td>
                                                            <td><p id="gsID<?= $r["id"]; ?>" style="display: block;margin-left: 17px;margin-top: 7px;"><?=$r["oppScore"];?></p></td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
            
                                </div>
                            </div><br>
                        <?php

                    }
                } else {
                    echo "<br><br><p>No events found in the database.</p>";
                    if(isset($_GET["ftime"]) || isset($_GET["fsport"]) || isset($_GET["fteam"])){
                        ?> 
                        <script>
                            alert("Your search query returned nothing.");
                            document.location.href = "/";
                        </script>
                        <?php
                    }
                }
                $conn->close();



                ?>




        </div>
    </center>


    <!-- AutoUpdate Scripts -->

    <script>
        var ids = [
    <?php
    $length = count($dbEntrys);
    $x = 0;
    foreach ($dbEntrys as $row) {

        ?>
        <?= $row["id"];
        if ($x != $length - 1) { // makes sure there isn't a comma at the end of the array initialization.
            print(", ");
        } ?> 
<?php

$x++;
}
?>
 ];
 var xhttp = new XMLHttpRequest();
 function updateGames(){
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var updated = JSON.parse(this.responseText);
                for(var i = 0; i < ids.length; i++){
                    if(document.getElementById("hsID"+ids[i]) != null && document.getElementById("hsID"+ids[i]) != null){
                        var hs = document.getElementById("hsID"+ids[i]);
                        var gs = document.getElementById("gsID"+ids[i]);
        
                        if(hs.innerHTML != updated[i].homeScore || gs.innerHTML != updated[i].oppScore) // if the updated homeScore isn't the same as the one displayed on the page...
                        {
                            //updates the page w/ latest scores.
                            hs.innerHTML = updated[i].homeScore;
                            gs.innerHTML = updated[i].oppScore;
        
                        }
                    }

                }

            }
        }
     xhttp.open("GET", "data/events.php", true);
     xhttp.send();
 
}
setInterval("updateGames();", 1000);

    </script>

<script src="search.js" type="text/javascript"></script>
    
</body>