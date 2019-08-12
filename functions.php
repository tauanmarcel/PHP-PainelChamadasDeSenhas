<?php

/* Print Pre */
function pp($str = ""){
	echo "<pre>";
	echo $str;
	echo "</pre>";
}

/* Dump */
function dump($arg = ""){
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
}

/* Dump e Die */
function dd($arg = ""){
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
	die;
}

