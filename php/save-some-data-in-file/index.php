<?php

// SAVE SOME DATA IN FILE

// file modes:
// - r:  open for reading only, pointer at the beggining of the file
// - r+: open for reading and writing, pointer at the beginning of the file
// - w:  open for writing only, pointer at the beginning of the file and truncate the file to zero length
//       if the file does not exist, attempt to create it
// - w+: open for reading and writing, pointer at the beginning of the file and truncate the file to zero length
//       if the file does not exist, attempt to create it
// - a:  open for writing only, pointer at the end of the file
//       if the file does not exist, attempt to create it
// - a+: open for reading and writing, pointer at the end of the file
//       if the file does not exist, attempt to create it

function saveData( $data ) {
	$log_file = get_stylesheet_directory() . '/resources/log_file.txt';

    $file = fopen( $log_file, 'w' );
    fwrite( $file,  print_r($data, TRUE) . '\n');
	fclose( $file );
}

?>
