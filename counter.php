<?php
$handle = fopen("database.txt", "r");
if(!$handle) {
    echo "could not open the file";
} else {
    $counter =(int )fread($handle,20);
        fclose($handle);
        $counter++;
        echo"Number of visitors to this page so far: ". $counter . "" ;
    $handle = fopen("database.txt", "w" );

    fwrite($handle,$counter);
    fclose ($handle);
}
?>
