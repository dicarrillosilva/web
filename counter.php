<?php
$handle = fopen("counter.txt", "r");
if(!$handle) {
    echo "could not open the file";
} else {
    $counter =(int )fread($handle,20);
        fclose($handle);
        $counter++;
        echo"Number of visitors to this page so far: ". $counter . "" ;
    $handle = fopen("counter.txt", "w" );

    fwrite($handle,$counter);
    fclose ($handle);
}

// session_start();
// $counter_name = "counter.txt";

// Check if a text file exists.
// If not create one and initialize it to zero.
// if (!file_exists($counter_name)) {
  // $f = fopen($counter_name, "w");
  // fwrite($f,"0");
  // fclose($f);
// }

// Read the current value of our counter file
// $f = fopen($counter_name,"r");
// $counterVal = fread($f, filesize($counter_name));
// fclose($f);

// Has visitor been counted in this session?
// If not, increase counter value by one
// if(!isset($_SESSION['hasVisited'])){
  // $_SESSION['hasVisited']="yes";
  // $counterVal++;
  // $f = fopen($counter_name, "w");
  // fwrite($f, $counterVal);
  // fclose($f);
// }

// Output
// echo "You are visitor number $counterVal to this site";

?>
