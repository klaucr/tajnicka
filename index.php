<?php

// Executable security
define('_EXEC', 1);

// Class autoloader
spl_autoload_register(function ($className) {
    require_once(dirname(__FILE__) . '/Classes/' . $className . '.php');
});

// Vytvorenie inštancie tajničky
$tajnicka = new Tajnicka();

// Zadanie názvu tajničky
$tajnicka->zadajNazovTajnicky('Pohraj sa so slovníkom');

// Ak chceme, zobrazenie legendy tajničky
$tajnicka->zobrazLegendu();

// Ak chceme, zobrazenie čísla riadku tajničky
$tajnicka->zobrazCisla();

// Ak chceme, zobrazenie buniek s riešením tajničky
$tajnicka->zobrazRiesenie('Lösung:');

// Nastavenie veľkosti buniek priamo tu, aby sme ich manuálne nemuseli po jednej upravovať vo Worde
$tajnicka->nastavVelkostBunky('25px', '25px');

// Nastaví farbu pozadia tajničky
$tajnicka->nastavFarbuTajnicky('#ddd');

// Nastaví záhlavie tajničky /veľkosť písma, farba písma, farba pozadia/
$tajnicka->nastavZahlavie('16px', '#000', '#ff99ff');

// Pridávanie riadkov tajničky /počet buniek riadku, poloha bunky zľava, v ktorej sa nachádza tajnička, otázka/
$tajnicka->pridajRiadok(7, 5, 'klopať');
$tajnicka->pridajRiadok(8, 3, 'skákať');
$tajnicka->pridajRiadok(6, 3, 'kvitnúť');
$tajnicka->pridajRiadok(5, 1, 'počuť');
$tajnicka->pridajRiadok(7, 5, 'hrať sa');
$tajnicka->pridajRiadok(7, 3, 'piť');
$tajnicka->pridajRiadok(6, 6, 'učiť sa');
$tajnicka->pridajRiadok(6, 4, 'spievať');

// Nakoniec vykreslenie tajničky
$tajnicka->vykresli();
