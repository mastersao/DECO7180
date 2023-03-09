<?php


require "vendor/autoload.php";

// delete all files that are made in the feed folder to save space
$files = glob('feed/*'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

// Api code adapted from these resources:

// https://googleapis.github.io/google-cloud-php/#/docs/google-cloud/v0.188.0/vision/readme
// https://cloud.google.com/vision/docs/reference/rest/v1p3beta1/Feature

// https://github.com/googleapis/google-cloud-php/blob/main/AUTHENTICATION.md
// https://github.com/googleapis/google-cloud-php/issues/2998

// https://www.youtube.com/watch?v=AbM8FK12pj8&ab_channel=ArtisansWeb
// https://www.youtube.com/playlist?list=PLC-R40l2hJfeaLSr8C-QV3o6xCtIJm7uL


use Google\Cloud\Vision\VisionClient;


// Assign private key to establish google service account
$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("visionKey\pristine-surf-362806-6b925395f8e2.json"), true)]);

// acquire image sent over from the form
$givenImg = fopen($_FILES['image']['tmp_name'], 'r');

//Send image to api for annotation
$image = $vision->image($givenImg, 
    [
     'LABEL_DETECTION'
    ]);
$result = $vision->annotate($image);

//If successful, move image to folder so it can be acquired in a different section of the webpage, else send back to main page
if ($result) {
    $imagetoken = random_int(1, 1000);
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/feed/' . $imagetoken . ".jpg");
} else {
    header("location: info.php");
    die();
}

// assign the results from the label detection 
$labels = $result->labels();

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Results</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    </head>
    <body>
        <?php include "header.php"; ?>  

        <div class="result-page">

            <div class="result-header">
                <h2><strong>Api Response</strong></h2>
                <br>
                <hr>
            </div>

            <div class="result-img">

                <div class="result-animal">
                    <img src="<?php echo "./feed/" . $imagetoken . ".jpg"?>" alt="Analysed Image">
                </div>

                <div class="trait-heading">

                    <div class="label-heading">
                        <h2>Possible Traits</h2>
                    </div>   
                    
                    <hr class="less-width">
                    
                    <div class="result-list">
                        <ol>
                            <!-- For every item we have, segregate into description and score to display as individual items -->
                            <?php foreach ($labels as $key => $label): ?>
                                <li>
                                <h6> <?php echo ucfirst($label->info()['description']) ?> </h6>  
                                <p class="confidence"> Confidence:<strong> <?php echo number_format($label->info()['score'] * 100 , 2) ?> </strong></p>
                                <br>
                                <br>
                                </li>
                            <?php endforeach ?>
                        </ol>

                    </div>

                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

    </body>
</html>