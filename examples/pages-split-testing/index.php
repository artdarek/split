<?php

// include library
include('../../src/Artdarek/Split.php');
// config
$config = include('config.php');

// run
$r = new Artdarek\Split();
$r->setData($config['data'])->run( $config['keep'] );

// make redirection
echo( 'Location: '.$r->value().( !empty( $_SERVER['QUERY_STRING'] ) ? '?'.$_SERVER['QUERY_STRING'] : '' ));
exit;
