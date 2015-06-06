<?php

$rawInput = "4 6";


if(strlen($rawInput) > 5)
	echo "Maximum input is '99 99'.	\n";
else{
	
	$input = explode(" ", $rawInput );

	if( !is_int((int)$input[0]) or !is_int((int)$input[1]) ) //NOT YET RIFGT
		echo "Valid input is two integers separated by a space.\n";
	else{
		createMineField($input[0],$input[1]);
	}

	global $input;
}


function createMineField($width, $height){


$difficulty = 20;
$field = [];

	for($i = 0; $i < $width; $i++){
		for($j = 0; $j < $height; $j++){

			if(mt_rand(0,100) > $difficulty)
				array_push($field, 0);  //ADJACENT											
			else
				array_push($field, "*");
				

			if($j == $height-1)
				array_push($field, PHP_EOL );
		}
	}
	calculateDigits($field);
}

function calculateDigits($field){

	global $input;

	for($i = 0; $i < count($field); $i++ ){

			if($field[$i] === "*"){

				

				@$before = $field[$i-1];
				$after = $field[$i+1];
				
				@$above = $field[$i-$input[1]-1];
				@$below = $field[$i+$input[1]+1];

				//back n forward
				if( is_int($before) )
					$field[$i-1] += 1; 

				if( is_int($after) )
					$field[$i+1] += 1;

				//up n down
				if( is_int($above) )
					$field[$i-$input[1]-1] += 1;
				
				if( is_int($below) )
					$field[$i+$input[1]+1] += 1;

			}

	}  renderField($field);
}


function renderField( $field )
{
	for ($i=0; $i < count($field) ; $i++) { 
		echo $field[$i];
	}
}