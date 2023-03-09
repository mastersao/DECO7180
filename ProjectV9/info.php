<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Animal Info</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    </head>

    <body>
        <?php include "header.php"; ?>  
            <div class="vision-form">      

                <div class="panel-heading">
                    <h2>Google Cloud Vision API</h2>
                    <p style="font-style: italic;">Get information about any animal!</p>
                </div>

                <hr>

                <div class="form-display">
                    <h2> Preview Image here: </h2>
                    <div class="preview">
                        <img src="images\preview-img.png" id="file-ip-1-preview">
                    </div>
                    <form action="results.php" method="post" enctype="multipart/form-data">
                        <input id = "visionFile" type="file" name="image" accept="image/*" class="form-control" onchange="showPreview(event);" required>
                        <br>
                        <button id = "visionSubmit" type="submit" style="border-radius: 0px;" class="analyse-btn">Analyse Image</button>
                    </form>
                </div>
            </div>

        <?php include "footer.php"; ?>

	</body>
</html>



