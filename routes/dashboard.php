<?php

    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }
?>

<html>
    <head>
        <title>Online Voting System - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">

        <title>Capture picture from your webcam</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>



    </head>
    <body>

    <div id="background-wrap">
        <div class="bubble x1"></div>
        <div class="bubble x2"></div>
        <div class="bubble x3"></div>
        <div class="bubble x4"></div>
        <div class="bubble x5"></div>
        <div class="bubble x6"></div>
        <div class="bubble x7"></div>
        <div class="bubble x8"></div>
        <div class="bubble x9"></div>
        <div class="bubble x10"></div>
    </div>

        <style>
            #backbtn{
                padding: 5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
                float: left;
                margin: 10px
            }

            #logoutbtn{
                padding: 5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
                float: right;
                margin: 10px;
            }

            #Profile{
                background-color: white;
                width: 30%;
                padding: 20px;
                float: left;
            }

            #Group{
                background-color: white;
                width: 60%;
                padding: 20px;
                float: right;
            }

            #votebtn{
                padding: 5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
            }

            #mainpanel{
                padding: 10px;
            }

            #voted{
                padding: 5px;
                font-size: 15px;
                background-color: green;
                color: white;
                border-radius: 5px;
            }

        </style>

        <div id="mainSection">
            <center>
            <div id="headerSection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
            </center>
            <hr>

            <div id="mainpanel">
                <div id="Profile">
                    <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
                    <b>Name:</b> <?php echo $userdata['name']?> <br><br>
                    <b>Mobile:</b> <?php echo $userdata['mobile']?> <br><br>
                    <b>Address:</b> <?php echo $userdata['address']?> <br><br>
                    <b>Status:</b> <?php echo $status?> <br><br>

                    <div id="camera" style="height:auto;width:auto; text-align:left;"></div>

                    <!--FOR THE SNAPSHOT-->
                    <input type="button" value="Take a Snap" id="btPic" onclick="takeSnapShot()" /> 
                    <p id="snapShot"></p>

                </div>

                <div id="Group">
                    <?php
                        if($_SESSION['groupsdata']){
                            for($i=0; $i<count($groupsdata); $i++){
                                ?>
                                <div>
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                                    <b>Group Name: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                    <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                                    <form action="../api/vote.php" method="POST">
                                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                        <?php
                                            if($_SESSION['userdata']['status']==0){
                                                ?>
                                                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                                <?php
                                            }
                                        ?>
                                        
                                    </form>


                                </div>
                                <hr>
                                <?php
                            }

                        }
                        else{

                        }
                
                    ?>

                </div>


            </div>


        </div>


    </body>


    <script>
    // CAMERA SETTINGS.
    Webcam.set({
        width: 220,
        height: 190,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach('#camera');

    // SHOW THE SNAPSHOT.
    takeSnapShot = function () {
        Webcam.snap(function (data_uri) {
            document.getElementById('snapShot').innerHTML = 
                '<img src="' + data_uri + '" width="70px" height="50px" />';
        });
    }
</script>


</html>



