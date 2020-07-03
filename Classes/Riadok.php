<?php
/**
 * Project: tajnicka
 * Filename: Riadok.php
 *
 * Created by: Mgr. Rene Klauco, PhD.
 * Created: 10. 4. 2016 12:28
 *
 * All rights reserved.
 */

// Zakazanie priameho pristupu
defined('_EXEC') or die('Priamy prístup nie je povolený!');



/**
 * Class Riadok
 */
class Riadok
{
    private $pocetPismen;
    private $polohaTajnicky;
    private $cisloRiadku;
    private $otazkaTajnicky;



    /**
     * Riadok constructor.
     *
     * @param $pocetPismen
     * @param $polohaTajnicky
     * @param $otazkaTajnicky
     */
    public function __construct($pocetPismen, $polohaTajnicky, $otazkaTajnicky)
    {
        $this->pocetPismen = $pocetPismen;
        $this->polohaTajnicky = $polohaTajnicky;
        $this->otazkaTajnicky = $otazkaTajnicky;
    }



    /**
     * Method setCisloRiadku.
     * Nastavi pre dany riadok cislo riadku
     *
     * @param $cisloRiadku
     */
    public function setCisloRiadku($cisloRiadku)
    {
        $this->cisloRiadku = $cisloRiadku;
    }



    /**
     * Method getRiadok.
     * Vrati riadok ako objekt
     * @return stdClass
     */
    public function getRiadok()
    {
        $result = new stdClass();
        $result->pocetPismen = $this->pocetPismen;
        $result->polohaTajnicky = $this->polohaTajnicky;
        $result->cisloRiadku = $this->cisloRiadku;
        $result->otazkaTajnicky = $this->otazkaTajnicky;

        return $result;
    }

}