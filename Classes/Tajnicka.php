<?php
/**
 * Project: tajnicka
 * Filename: Tajnicka.php
 *
 * Created by: Mgr. Rene Klauco, PhD.
 * Created: 10. 4. 2016 12:28
 *
 * All rights reserved.
 */

// Zakazanie priameho pristupu
defined('_EXEC') or die('Priamy prístup nie je povolený!');



/**
 * Class Tajnicka
 */
class Tajnicka
{
    private $riadky;
    private $nazov;
    private $zobrazCisla = false;
    private $sirkaBunky = '30px';
    private $vyskaBunky = '30px';
    private $farbaTajnicky = '#666';
    private $zahlavieVelkostPisma = '18px';
    private $zahlavieFarbaPisma = '#000';
    private $zahlavieFarbaPozadia = '#fff';
    private $zobrazLegendu = false;
    private $zobrazRiesenie = false;
    private $nazovRiesenia = null;



    /**
     * Method pridajRiadok.
     * Prida novy riadok do tajnicky
     *
     * @param $pocetPismen
     * @param $polohaTajnicky
     * @param $otazkaTajnicky
     */
    public function pridajRiadok($pocetPismen, $polohaTajnicky, $otazkaTajnicky)
    {
        if (!$pocetPismen || !$polohaTajnicky) {
            throw new RuntimeException('Nezadali ste pocet pismen alebo polohu tajnicky.');
        }

        if ($polohaTajnicky > $pocetPismen) {
            throw new RuntimeException('Poloha bunky tajnicky nemoze byt dalej, ako je sirka tajnicky.');
        }

        $riadok = new riadok($pocetPismen, $polohaTajnicky, $otazkaTajnicky);
        $riadok->setCisloRiadku(count($this->riadky) + 1);
        $this->riadky[] = $riadok->getRiadok();
    }



    /**
     * Method zadajNazovTajnicky.
     * Vytvori nazov tajnicky ako nadpis
     *
     * @param $nazov
     */
    public function zadajNazovTajnicky($nazov)
    {
        $this->nazov = $nazov;
    }



    /**
     * Method zobrazCisla.
     * Zobrazi bunku s cislom pred kazdym riadkom tajnicky
     */
    public function zobrazCisla()
    {
        $this->zobrazCisla = true;
    }



    /**
     * Method zistiNajdalej.
     * Zisti najvzdialenejsiu bunku tajnicky smerom doprava
     * podla ktorej sa posuvaju bunky, aby bola tajnicka zarovno
     * @return mixed
     */
    private function zistiNajdalej()
    {
        $max = $this->riadky[0]->polohaTajnicky;

        foreach ($this->riadky as $riadok) {
            if ($riadok->polohaTajnicky > $max) {
                $max = $riadok->polohaTajnicky;
            }
        }

        return $max;
    }



    /**
     * Method nastavVelkostBunky.
     * Nastavi velkost bunky
     *
     * @param $sirkaBunky
     * @param $vyskaBunky
     */
    public function nastavVelkostBunky($sirkaBunky, $vyskaBunky)
    {
        $this->sirkaBunky = $sirkaBunky;
        $this->vyskaBunky = $vyskaBunky;
    }



    /**
     * Method nastavFarbuTajnicky.
     * Nastavi farbu pozadia buniek stlpca tajnicky
     *
     * @param $farbaTajnicky
     */
    public function nastavFarbuTajnicky($farbaTajnicky)
    {
        $this->farbaTajnicky = $farbaTajnicky;
    }



    /**
     * Method nastavZahlavie.
     * Nastavi velkost pisma, farbu a pozadie zahlavia tajnicky
     *
     * @param $velkostPisma
     * @param $farbaPisma
     * @param $farbaPozadia
     */
    public function nastavZahlavie($velkostPisma, $farbaPisma, $farbaPozadia)
    {
        $this->zahlavieVelkostPisma = $velkostPisma;
        $this->zahlavieFarbaPisma = $farbaPisma;
        $this->zahlavieFarbaPozadia = $farbaPozadia;
    }



    /**
     * Method zobrazLegendu.
     * Zobrazi legendu pod tajnickou
     *
     * @param bool $zobrazLegendu
     */
    public function zobrazLegendu($zobrazLegendu = true)
    {
        $this->zobrazLegendu = $zobrazLegendu;
    }



    /**
     * Method zobrazRiesenie.
     * Zobrazi pod tajnickou bunky pre vyplnenie riesenia tajnicky
     *
     * @param null $nazovRiesenia (napr.: riesenie, riesenie tajnicky...)
     */
    public function zobrazRiesenie($nazovRiesenia = null)
    {
        $this->zobrazRiesenie = true;
        $this->nazovRiesenia = $nazovRiesenia;
    }



    /**
     * Method vykresli.
     * Vykresli vytvorenu tajnicku
     */
    public function vykresli()
    {
        // Kontrola, ci tajnicka obsahuje nejake riadky
        if (!$this->riadky) {
            throw new RuntimeException('Tajnicka neobsahuje ziadne riadky. Pred vykreslenim tajnicky musite najskor vytvorit riadky.');
        }

        // Zobrazi nazov tajnicky
        if (!empty($this->nazov)) {
            echo '<h1>' . $this->nazov . '</h1>';
        }

        // Zisti najvzdialenejsiu polohu tajnicky, podla ktorej ju posuva
        $maximumPolohaTajnicky = $this->zistiNajdalej();

        // Zacne vykreslovat tabulku
        echo '<table cellpadding="0" cellspacing="0" style="border-collapse: collapse;">';

        // Zacne vykreslovat riadky
        foreach ($this->riadky as $riadok) {

            echo '<tr>';

            // Vypocita posun, t.j. kolko prazdnych buniek pred slovom
            $posun = $maximumPolohaTajnicky - $riadok->polohaTajnicky;

            // Ak je potrebne, vykresli najprv prazdne bunky
            for ($j = 0; $j <= $posun; $j++) {
                echo '<td style="border:none;height:' . $this->vyskaBunky . ';width:' . $this->sirkaBunky . ';background-color:#fff;"></td>';
            }

            // Potom vykresli bunku s cislom
            if ($this->zobrazCisla) {
                echo '<td style="border:1px solid #000;height:' . $this->vyskaBunky . ';width:' . $this->sirkaBunky . ';background-color:' . $this->zahlavieFarbaPozadia . ';text-align:center;vertical-align:middle;font-weight:bold;font-size:' . $this->zahlavieVelkostPisma . ';color:' . $this->zahlavieFarbaPisma . '">' . $riadok->cisloRiadku . '</td>';
            }

            // Potom pokracuje vykreslovanim bunky slova
            for ($i = 1; $i <= $riadok->pocetPismen; $i++) {

                // Ak je dana bunka bunkou tajnicky, zvoli sa ina farba
                if ($i == $riadok->polohaTajnicky) {
                    $farba = $this->farbaTajnicky;
                } else {
                    $farba = '#fff';
                }

                // Vykresli sa bunka
                echo '<td style="border:1px solid #000;height:' . $this->vyskaBunky . ';width:' . $this->sirkaBunky . ';background-color:' . $farba . ';"></td>';
            }

            // Koniec riadku tajnicky
            echo '</tr>';
        }

        // Koniec tajnicky
        echo '</table>';


        // Vykreslenie legendy pod tajnickou
        if ($this->zobrazLegendu) {
            echo '<p style="font-size:12px;">';
            foreach ($this->riadky as $riadok) {
                echo $riadok->cisloRiadku . ' - ' . $riadok->otazkaTajnicky . '; ';
            }
            echo '</p>';
        }

        // Vykreslenie buniek riesenia pod tajnickou
        if ($this->zobrazRiesenie) {
            echo '<p><table cellpadding="0" cellspacing="0" style="border-collapse: collapse;"><tr>';
            if ($this->nazovRiesenia) {
                echo '<h3>' . $this->nazovRiesenia . '</h3>';
            }
            foreach ($this->riadky as $riadok) {
                echo '<td style="border:1px solid #000;height:' . $this->vyskaBunky . ';width:' . $this->sirkaBunky . ';background-color:' . $this->farbaTajnicky . ';"></td>';
            }
            echo '</tr></table></p>';
        }
    }
}