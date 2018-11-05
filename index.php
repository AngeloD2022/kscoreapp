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
               
                        //here
                while ($r = $result->fetch_array()) {

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
                    $tc = $r["teamClass"] == "jv"? "JV": $r["teamClass"] == "varsity"? "Varsity": "";
                    $sport = $r["sport"] == "soccer"? "Soccer": $r["sport"] == "football"? "Football": "";

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
                                                        <p>Kenston@<?=$r["location"];?></p>
                                                        <p style="margin-top: 5px;" class="smallTxt"><?=$r["grade"]. $afterGrade ." grade ". $tc ." ". $sport ?></p>
                                                        <p style="margin-top: 3px;" class="smallTxt">Starting time: Friday at 4:30PM</p>
                                                    </div>
                                                </div>
                                            </td>
                                                <!--Past blue line-->
                                            <td class="cardSep">
                                                <div class="cardScores" style="padding: 6px;">
                                                    <img class="teamIcon" src="kcrop.png" style="width: 45px; height: 45px; vertical-align: middle;"/>
                                                    <p style="display: inline;margin-left: 8px;margin-right: 8px;">VS.</p>
                                                    <img class="teamIcon" src="https://schoolassets.s3.amazonaws.com/logos/428/428.png" style="width: 45px; height: 45px; vertical-align: middle;"/>
                                                    <span name="homeScore">0</span>
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



    
</body>