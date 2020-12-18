<?php

// WP database methods: insert, update, delete, get_results, get_column, get_row, get_var
// %s - string, %d - integer, %f - float


// tables
global $wpdb;
$table = $wpdb->prefix . 'table';


// insert -> first array (columns and values), second array (data types)
// wpdb->insert( table, data, format );
$insert = $wpdb->insert( $table, array('column1' => (int)$some_id1, 'column2' => $some_id2), array('%d', '%d') );

// update -> first array (update column), second array (where conditions), third array (data types of first array), fourth array (data types of second array)
// wpdb->update( table, data, where, format = null, where_format = null );
$update = $wpdb->update( $table, array('column1' => $some_id1), array('column2' => $some_id2, 'column3' => $some_id3 ), array('%d'), array('%d', '%d') );

// delete -> first array (row), second array (data type)
// wpdb->delete( table, where, where_format = null );
// delete = wpdb->query( "DELETE FROM table WHERE column1 = some_id" );
$delete = $wpdb->delete( $table, array('column1' => 1), array('%d') );

// get_results -> get multiple columns
$results = $wpdb->get_results( "SELECT column1, column2 FROM $table WHERE column2 = $some_id" );

// get_column -> get single column
$get_column = $wpdb->get_col( "SELECT DISTINCT column1 FROM $table" );

// get row -> get single row
$get_row = $wpdb->get_row( "SELECT * FROM $table WHERE row1 = 10" );

// get_variable -> get single result, cell, or count | distinct | max(column)
$get_variable = $wpdb->get_var( "SELECT MAX(column) FROM $table" );

?>
