<?php

  //***************************************//
 //* CORE FUNCTIONS :: ASHIVA FORMATTING *//
//***************************************//

function format($Page, $Style = 'henkan', $Case = 'inherited') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  switch ($Case) {
  
    // 'inherited', 'PascalCase', 'camelCase', 'Serpent_Case', 'snake_case'

    case ('camelCase') :

      $Page = preg_split("/[\s|_|-]/", $Page);
      for ($i = 0; $i < count($Page); $i++) {if ($Page[$i] === '') continue; $Page[$i] = strtoupper($Page[$i][0]).substr($Page[$i], 1);}
      $Page = implode('', $Page);
      $Page = strtolower($Page[0]).substr($Page, 1);
      break;

    case ('Serpent_Case') :

      $Page = strtoupper($Page[0]).substr($Page, 1);
      $Page = preg_replace('/([a-z])([A-Z])/', '$1_$2', $Page);
      break;
  }

  $Page = str_replace('T_3', 'T3', $Page);
  $Page = str_replace('t_3', 't3', $Page);

  $Page = str_replace('__', '[>]', $Page);
  $Page = str_replace('_', '-', $Page);
  $Page = str_replace(' ', '-', $Page);

  $Page = str_replace('-/-', '-[\]-', $Page);
  $Page = str_replace('----', '-[\]-', $Page);
  $Page = str_replace('---', '-[:]-', $Page);
  $Page = str_replace('--', '-[@]-', $Page);
  $Page = str_replace(',-', '-[@]-', $Page);

  $Page = str_replace('/', '[>]', $Page);
  $Page = str_replace('-&#9654;-', '[>]', $Page);
  $Page = str_replace('&#9654;', '[>]', $Page);
  $Page = str_replace('->-', '[>]', $Page);

  $Page = str_replace('-&amp;-', '-[+]-', $Page);
  $Page = str_replace('&amp;', '-[+]-', $Page);
  $Page = str_replace('-and-', '-[+]-', $Page);
  $Page = str_replace('-&-', '-[+]-', $Page);

  $Page = str_replace('-(', '-[{]-', $Page);
  $Page = str_replace(')-', '-[}]-', $Page);

  /* CUSTOM */
  $Page = str_replace('sicherheitsdatenblaetter', 'sicherheitsdatenblätter', $Page);

  return $Page;
}

function url($Page, $Style = 'henkan', $Case = 'inherited') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = format($Page, $Style, $Case);

  $Page = str_replace('[>]', '/', $Page);
  $Page = str_replace('-[\]-', '----', $Page);
  $Page = str_replace('-[:]-', '---', $Page);
  $Page = str_replace('-[@]-', '--', $Page);
  $Page = str_replace('-[+]-', '-and-', $Page);
  $Page = str_replace('-[{]-', '_(', $Page);
  $Page = str_replace('-[}]-', ')_', $Page);
  $Page = strtolower($Page);

  /* CUSTOM */
  $Page = str_replace('sicherheitsdatenblätter', 'sicherheitsdatenblaetter', $Page);

  // Convert all extended European characters into their restricted equivalents?

  if ($Style === 'raw') {

    $Page = str_replace('/','--', $Page);
  }

  return $Page;
}

function val($Page) {
  $Page = url($Page);
  $Page = str_replace('/', '__', $Page);
  return $Page;
}

function txt($Page, $Style = 'henkan', $Case = 'inherited') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = format($Page, $Style, $Case);

  $Page = explode('[>]', $Page);
  for ($i = 0; $i < count($Page); $i++) {if ($Page[$i] === '') continue; $Page[$i] = strtoupper($Page[$i][0]).substr($Page[$i], 1);}
  $Page = implode(' &#9654; ', $Page);

  $Page = explode('-', $Page);
  for ($i = 0; $i < count($Page); $i++) {if ($Page[$i] === '') continue; $Page[$i] = strtoupper($Page[$i][0]).substr($Page[$i], 1);}
  $Page = implode(' ', $Page);

  $Page = str_replace(' [+] ', ' &amp; ' ,$Page);
  $Page = str_replace(' [\] ', ' / ' ,$Page);
  $Page = str_replace(' [:] ', ' - ' ,$Page);
  $Page = str_replace(' [@] ', ', ' ,$Page);
  $Page = str_replace(' [{] ', ' (' ,$Page);
  $Page = str_replace(' [}] ', ') ' ,$Page);
  $Page = trim($Page);

  /* CUSTOM */
  $Page = str_replace('Soak Off', 'Soak-Off', $Page);
  $Page = str_replace('Hema', 'HEMA', $Page);
  $Page = str_replace('Led', 'LED', $Page);
  $Page = str_replace('For', 'for', $Page);
  $Page = str_replace('Uv', 'UV', $Page);
  $Page = str_replace('3d', '3D', $Page);
  $Page = str_replace('Sb', 'SB', $Page);

  if ($Style === 'raw') {

    $Page = str_replace(' &#9654; ',' > ', $Page);
    $Page = str_replace(' &amp; ',' & ', $Page);
  }

  if ($Case === 'camelCase') {

    $Page = strtolower($Page[0]).substr($Page, 1);
  }

  return $Page;
}

function src($Page) {

  $Page = txt($Page);
  $Page = str_replace(' &#9654; ','[>]', $Page);
  $Page = str_replace(' ','_', $Page);
  $Page = str_replace('_&amp;_','_[+]_', $Page);
  $Page = str_replace('_/_','_[\]_', $Page);
  $Page = str_replace('_-_','_[:]_', $Page);
  $Page = str_replace(',_','_[@]_', $Page);
  $Page = str_replace('_(','_[{]_', $Page);
  $Page = str_replace('(','_[{]_', $Page);
  $Page = str_replace(')_','_[}]_', $Page);
  $Page = str_replace(')','_[}]_', $Page);
  return $Page;
}

?>
