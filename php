<?php

function format($Page) {
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

    $Page = str_replace('-&amp;-', '-[+]-', $Page);
    $Page = str_replace('-and-', '-[+]-', $Page);
    $Page = str_replace('-&-', '-[+]-', $Page);

    $Page = str_replace('-(', '-[{]-', $Page);
    $Page = str_replace(')-', '-[}]-', $Page);

    /* CUSTOM */
    $Page = str_replace('sicherheitsdatenblaetter', 'sicherheitsdatenblätter', $Page);

    return $Page;
}

function url($Page) {
    $Page = format($Page);
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

    return $Page;
}

function val($Page) {
    $Page = url($Page);
    $Page = str_replace('/', '__', $Page);
    return $Page;
}

function txt($Page) {

    $Page = format($Page);

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

    $Page = str_replace('Led', 'LED', $Page);
    $Page = str_replace('Uv', 'UV', $Page);
    $Page = str_replace('3d', '3D', $Page);
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
