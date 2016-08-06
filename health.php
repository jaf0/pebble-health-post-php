<?php
header('Content-Type: application/json;charset=utf-8');
$start = microtime(true);

/**
 * config options
 */

// output file
$datafile = '/tmp/pebble.txt';

// upload keys
// single record
$single_key = "data";

// bundled
$bundle_key = "bundle";
// delimiter
$delimiter = "%0d%0a";

// date format for output JSON, not pebble health data.
$date_format = "Y-m-d\TH:i:s\Z";

$response['startTime'] = gmdate($date_format, $start);
$response['outputFile'] = $datafile;

if (isset($_POST[$single_key]) || isset($_POST[$bundle_key])) {

    // if this is the first export
    if ($response['create'] = !file_exists($datafile)) {
        // include CSV headers.
        $header = "Time,Steps,yaw,pitch,VMC,ambient light,activity level\n";
        file_put_contents($datafile, $header, FILE_APPEND | LOCK_EX);
    }

    // handle bundle data
    if ($response['bundled'] = isset($_POST[$bundle_key])) {
        $glue = "\n";
        $lines = explode($delimiter, $_POST[$bundle_key]);
        $data = implode($glue, $lines);
        $response['records'] = count($lines);
    }
    // handle single data
    else {
        $data = $_POST[$single_key];
        $response['records'] = 1;
    }
    $data .= "\n";

    // append data to file
    $response['bytes'] = file_put_contents($datafile, $data, FILE_APPEND | LOCK_EX);
}
else {
    $response['records'] = 0;
}

$end = microtime(true);
$response['endTime'] = gmdate($date_format, $end);

$format = 'Processed %d records in %.3fms.';
$response['message'] = sprintf($format, $response['records'], ($end - $start) * 1000);

echo json_encode($response, JSON_PRETTY_PRINT);