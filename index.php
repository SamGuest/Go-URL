<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Go URL | Open Source URL Shortener</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="description" content="Go URL is an efficient URL shortener that is easy to use and open source">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="js/script.js"></script>
        <!-- Place GA4 Here -->
    </head>
    <body>
        <div class="header">
            <div class="container">
                <a href="/"><h1 class="logo">Go URL</h1></a>
                <a href="https://twitter.com/samguest83" target="_blank"  class="xLink"><img src="/images/x.jpg" alt="X" class="x"></a>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <?php if ($_GET['success'] == 1) {
                        echo 'URL: <a id="url" target="_blank" href="https://' . $_SERVER['HTTP_HOST'] . '/' . $_GET["slug"] . '">https://' . $_SERVER['HTTP_HOST'] . '/' . $_GET['slug'] . '/</a>';
                        echo '<button OnClick="copyUrl()">Copy Url</button>';
                    } else { ?>
                    <form method="post" action="./logic.php"> 
                        <label for="origionalURL">Enter URL: <input type="url" name="origionalURL" id="origionalURL"></label>
                        <input type="submit" value="Submit">
                    </form> 
                <?php } ?>
            </div>
        </div>
        <footer class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Go URL &copy; <?php echo date("Y"); ?></p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>


