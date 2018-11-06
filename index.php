<head>
    <link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
    <link href="styles.css" rel="stylesheet" />
    <h1>Kenston Athletic Events</h1>
    <p>scores.kenstonapps.org</p>


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
    <script>
        function updateEvents()
        {
            //perform the query to get the fields that may have changed
            //for each one of those:
            {
                var event = document.getElementById('event' + rowID);
                event.homeScore.innerText = ...;
                event.opponentScore.innerText = ...;
            }

        }
        setInterval('updateEvents();', 1000);

    </script>
</head>

<body>
    <center>
        <div id="cardContainer">

            <?php //perform the sql query here

            $conn = new mysqli("localhost", "root", null, "scoreboard");
            if ($conn->connect_error) {
                die("Failed: " . $conn->connect_error);
            }


            $sql = "SELECT * FROM events";

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
                    $tc = $r["teamClass"] == "jv" ? "JV" : $r["teamClass"] == "varsity" ? "Varsity" : "";
                    $sport = $r["sport"] == "soccer" ? "Soccer" : $r["sport"] == "football" ? "Football" : "";
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
                                                            <td><p id="hsID<?= $r["id"]; ?>" style="display: block;margin-left: 17px;margin-top: 7px;">0</p></td>
                                                            <td>to</td>
                                                            <td><p id="gsID<?= $r["id"]; ?>" style="display: block;margin-left: 17px;margin-top: 7px;">0</p></td>
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
                    echo "error_noevents";
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
        foreach($dbEntrys as $row) {
            
       
        ?>
        <?=$row["id"]; if($x != $length-1){
            echo ", ";
        }?> 
    <?php
        
        $x++;
}
?>
        ];
        var xhttp = new XMLHttpRequest();

        function updateGames(){
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                var arr = JSON.parse(this.responseText);
                for(var i = 0; i < ids.length; i++){
                    var item;
                    if(arr[i].homeScore == )
                }
            }
            xhttp.open("GET", "data/events.php", true);
            xhttp.send();
        }
        

}


    </script>


    
</body>