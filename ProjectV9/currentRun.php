<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Animal Wiki</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
        <script src="js/jquery-3.4.1.min.js"></script>
    </head>
    <body>
		<?php include "header.php"; ?>
        <div id="stat-container">
            <div id="page-name">
                <h1>Current Run</h1>
            </div>
            <div id="stat-frame">
                <div id="section-1">
                    <div id="step">
                        <h3>Steps</h3>
                        <div class="num-step">
                            0
                        </div>
                    </div>
                </div>
                <div id="section-2">
                    <div id="distance">
                        <h3>Distance Travelled</h3>
                        <div class="num-distance">
                            0 M
                        </div>
                    </div>
                    <div id="time">
                        <h3>Time Overlapped</h3>
                        <div id="main-time">
                            <div class="main-time">
                                00 : 00 : 00
                            </div>
                        </div>
                        <p>HR   MIN   SEC</p>
                    </div>
                    <div class="buttons">
                        <button class="startButton">Start</button>
                        <button class="stopButton">Stop</button>
                        <button class="resetButton">Reset</button>
                    </div>
                </div>
                <div id="section-3">
                    <div id="calories">
                        <h3>Calories Burnt</h3>
                        <div class="num-calories">
                            0.000
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/script.js"></script>

		<?php include "footer.php"; ?>


	</body>
</html>


