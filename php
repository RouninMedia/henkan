<?php

  //***************************************//
 //* CORE FUNCTIONS :: ASHIVA FORMATTING *//
//***************************************//

function format($Page, $Style = 'henkan', $Case = 'No_Case_Applied') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = urldecode($Page);

  switch ($Case) {

    // 'No_Case_Applied', 'PascalCase', 'camelCase', 'Serpent_Case', 'snake_case'

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
  $Page = str_replace(['_', ' '], '-', $Page);
  $Page = str_replace(['----', '-/-'], '-[\]-', $Page);
  $Page = str_replace('---', '-[:]-', $Page);
  $Page = str_replace(['--', ',-'], '-[@]-', $Page);
  $Page = str_replace(['/', '-&#9654;-', '&#9654;'], '[>]', $Page);
  $Page = str_replace(['-&-', '-&amp;-', '-and-', '-et-', '-und-', '-y-'], '-[$]-', $Page);
  $Page = str_replace('-(', '-[{]-', $Page);
  $Page = str_replace(')-', '-[}]-', $Page);

  return $Page;
}


function url($Page, $Style = 'henkan', $Case = 'No_Case_Applied') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = format($Page, $Style, $Case);

  $Page = str_replace('[>]', '/', $Page);
  $Page = str_replace('-[\]-', '----', $Page);
  $Page = str_replace('-[:]-', '---', $Page);
  $Page = str_replace('-[@]-', '--', $Page);


  switch (getLanguage()) {

    case ('de') : $Page = str_replace('-[$]-', '-und-', $Page); break;
    case ('es') : $Page = str_replace('-[$]-', '-y-', $Page); break;
    case ('fr') : $Page = str_replace('-[$]-', '-et-', $Page); break;
    default : $Page = str_replace('-[$]-', '-and-', $Page);
  }
  
  $Page = str_replace('-[{]-', '_(', $Page);
  $Page = str_replace('-[}]-', ')_', $Page);
  $Page = (mb_strlen($Page) !== strlen($Page)) ? mb_strtolower($Page) : strtolower($Page);

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

function txt($Page, $Style = 'henkan', $Case = 'No_Case_Applied') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = format($Page, $Style, $Case);

  if ($Case === 'No_Case_Applied') {$Page = mb_convert_case($Page, MB_CASE_TITLE, 'UTF-8');}

  $Page = str_replace('[>]', ' &#9654; ', $Page);
  $Page = str_replace('-', ' ', $Page);

  $Page = str_replace(' [$] ', ' &amp; ' ,$Page);
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

  if (strlen($Page) !== mb_strlen($Page)) {

    $Page_Array = preg_split('//u', $Page, -1, PREG_SPLIT_NO_EMPTY);

    for ($i = 0; $i < count($Page_Array); $i++) {

      if (strlen($Page_Array[$i]) !== mb_strlen($Page_Array[$i])) {

        $Page_Array[$i] = htmlentities($Page_Array[$i], ENT_HTML5, 'UTF-8');
      }
    }

    $Page = implode('', $Page_Array);
  }


  if ($Style === 'raw') {

    $Page = str_replace('&#9654;', '>', $Page);
    $Page = str_replace(' &amp; ', ' & ', $Page);

    $Raw_Page_Array = explode('>', $Page);
  
    for ($i = 0; $i < count($Raw_Page_Array); $i++) {

      $Raw_Page_Array[$i] = html_entity_decode($Raw_Page_Array[$i], ENT_HTML5, 'UTF-8');
    }

    $Page = implode('>', $Raw_Page_Array);
  }
  

  if ($Case === 'camelCase') {

    $Page = strtolower($Page[0]).substr($Page, 1);
  }

  return $Page;
}

function src($Page, $Style = 'henkan', $Case = 'No_Case_Applied') {

  if (!in_array($Style, ['henkan', 'raw'])) {$Case = $Style; $Style = 'henkan';}

  $Page = txt($Page);
  $Page = str_replace(' ', '_', $Page);
  $Page = str_replace(['_&#9654;_', '&#9654;_', '&#9654;'], '[>]', $Page);
  $Page = str_replace('_&amp;_','_[$]_', $Page);
  $Page = str_replace('_/_','_[\]_', $Page);
  $Page = str_replace('_-_','_[:]_', $Page);
  $Page = str_replace(',_','_[@]_', $Page);
  $Page = str_replace('_(','_[{]_', $Page);
  $Page = str_replace('(','_[{]_', $Page);
  $Page = str_replace(')_','_[}]_', $Page);
  $Page = str_replace(')','_[}]_', $Page);

  if ($Style === 'raw') {

    $Page = str_replace('[>]','__', $Page);
  }

  $Page_Array = explode('[>]', $Page);
  
  for ($i = 0; $i < count($Page_Array); $i++) {

    $Page_Array[$i] = html_entity_decode($Page_Array[$i], ENT_HTML5, 'UTF-8');
  }

  $Page = implode('[>]', $Page_Array);
  

  return $Page;
}

?>
