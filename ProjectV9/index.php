<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Animal Finder</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
		    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
		    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    </head>
    <body>
		    <?php include "header.php"; ?>
            <div class="landing-page-container">
                <div class="content-container">
                    <div class="af-page-name">
                        <h1>Animal-Finder</h1>
                    </div>
                    <div class="af-page-desc">
                        <p>Animal-Finder is a project in development <br> that aims to bring information based around <br> local fauna and trails using council data <br> and historical records to hikers in queensland. We hope to <br> make your hiking experience a safe and intuitive one so <br> you can have an enjoyable experience.</p>
                    </div>
                </div>
                <div class="login-container">
                    <h1>Log In</h1>
                    <form action="">
                        <label for="email-label">Enter your username:</label><br>
                        <input type="text" id="username" name="username"><br>
                        <label for="password-label">Enter your password:</label><br>
                        <input type="text" id="password" name="password"><br><br>
                        <div class="loginBtn-container">
                            <button class="loginBtn">Log in</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="sign-up-section">
                <p>or &nbsp;<a href="#"> sign up </a> &nbsp; if you don't have an account</p>
            </div>
		    <?php include "footer.php"; ?>


	  </body>
</html>


