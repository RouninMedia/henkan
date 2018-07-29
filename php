<?php

function format($Page) {

	$Page = str_replace('>','/',$Page); 
	$Page = str_replace('__','/',$Page);
	$Page = str_replace(' &#9655; ','/',$Page);

	$Page = str_replace('_','-',$Page);
	$Page = str_replace('-','-',$Page);
	$Page = str_replace(' ','-',$Page);
	
	return $Page;
}

function url($Page) {

	$Page = format($Page);
	$Page = strtolower($Page);
	
	return $Page;
}

function txt($Page) {

	$Page = str_replace(' - ',' @ ',$Page);
	$Page = format($Page);

	$Page = explode('/', $Page);
	for ($i = 0; $i < count($Page); $i++) {if ($Page[$i] == '') continue; $Page[$i] = strtoupper($Page[$i][0]).substr($Page[$i], 1);}
	$Page = implode(' &#9655; ', $Page);

	$Page = explode('-', $Page);
	for ($i = 0; $i < count($Page); $i++) {if ($Page[$i] == '') continue; $Page[$i] = strtoupper($Page[$i][0]).substr($Page[$i], 1);}
	$Page = implode(' ', $Page);

	$Page = str_replace(' @ ',' - ',$Page);
	$Page = str_replace(' And ',' and ',$Page);
    
        return $Page;
}

function val($Page) {
	$Page = url($Page);
	$Page = str_replace('/','__',$Page);
	if ($Page == 'hands-off-nhs-homepage') {$Page = 'home';}
	
	return $Page;
}

function src($Page) {
	$Page = txt($Page);
	$Page = str_replace(' &#9655; ','>',$Page);
	$Page = str_replace(' ','_',$Page);
	
	return $Page;
}

?>
