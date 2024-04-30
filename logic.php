<?php 
// Get URL posted from form
$origionalURL = $_POST['origionalURL'];

// Check that the users input is a URL
if (!filter_var($origionalURL, FILTER_VALIDATE_URL) === false) { 
    // Generate a random slug
    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uniqueSlug = substr(str_shuffle($characters), 0, 5);
        return $uniqueSlug;
    }
    $uniqueSlug = generateRandomString();

    // Open and decode the json file
    $json_string = file_get_contents('slugs.json');
    $parsed_json = json_decode($json_string, true);

    // Loop through the unique slugs in the json file to see if it exists
    foreach($parsed_json as $key => $value) {
        if ($value['slug'] == $uniqueSlug){
            $unique = false;
            echo 'slug not unique';
        } else {
            $unique = true;
        }
    }

    // If the slug is found
    if ($unique == true){
        // If the slug is unique
        // write it to the json file
        $newSlug = array(
            'slug' => $uniqueSlug,
        );
        $data_slugs = file_get_contents('slugs.json');
        $tempSlugArray = json_decode($data_slugs);
        $tempSlugArray[] = $newSlug;
        $jsonData = json_encode($tempSlugArray);
        file_put_contents('slugs.json', $jsonData);  
        
        // Create the redirect
        if (!file_exists($uniqueSlug)) {
            mkdir($uniqueSlug, 0777, true);
            $Rfile = fopen($uniqueSlug . "/index.html", "w");
            fwrite($Rfile, "<!DOCTYPE html><html lang='en'><head><title>Redirecting to ". $origionalURL ."</title><script async src='https://www.googletagmanager.com/gtag/js?id=G-1Y4GBNLTMF'></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'G-1Y4GBNLTMF');</script><meta http-equiv='refresh' content='0; url=". $origionalURL ."'></head><body></body></html>");
            fclose($Rfile);
            
            header("Location: /?success=1&slug=" . $uniqueSlug);
        } else{
            echo ('matched');
        }
        
    }
    
} else { 
    die("Enter a valid URL"); 
}

?> 