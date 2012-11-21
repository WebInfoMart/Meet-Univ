<?php
/**
 * Numbers_Words
 *
 * PHP version 4
 *
 * Copyright (c) 1997-2006 The PHP Group
 *
 * This source file is subject to version 3.0 of the PHP license,
 * that is bundled with this package in the file LICENSE, and is
 * available at through the world-wide-web at
 * http://www.php.net/license/3_0.txt.
 * If you did not receive a copy of the PHP license and are unable to
 * obtain it through the world-wide-web, please send a note to
 * license@php.net so we can mail you a copy immediately.
 *
 * @category Numbers
 * @package  Numbers_Words
 * @author   Laurynas Butkus <lauris@night.lt>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @version  CVS: $Id: lang.lt.php,v 1.2 2008/11/25 03:48:32 clockwerx Exp $
 * @link     http://pear.php.net/package/Numbers_Words
 */

/**
 * Class for translating numbers into Lithuanian.
 *
 * @author Laurynas Butkus
 * @package Numbers_Words
 */

/**
 * Include needed files
 */
require_once "Numbers/Words.php";

/**
 * Class for translating numbers into Lithuanian.
 *
 * @category Numbers
 * @package  Numbers_Words
 * @author   Laurynas Butkus <lauris@night.lt>
 * @license  PHP 3.0 http://www.php.net/license/3_0.txt
 * @link     http://pear.php.net/package/Numbers_Words
 */
class Numbers_Words_lt extends Numbers_Words
{

    // {{{ properties

    /**
     * Locale name
     * @var string
     * @access public
     */
    var $locale = 'lt';

    /**
     * Language name in English
     * @var string
     * @access public
     */
    var $lang = 'Lithuanian';

    /**
     * Native language name
     * @var string
     * @access public
     */
    var $lang_native = 'lietuvi�kai';

    /**
     * The word for the minus sign
     * @var string
     * @access private
     */
    var $_minus = 'minus'; // minus sign

    /**
     * The sufixes for exponents (singular and plural)
     * @var array
     * @access private
     */
    var $_exponent = array(
        0 => array(''),
        3 => array('t�kstantis','t�kstan�iai','t�kstan�i�'),
        6 => array('milijonas','milijonai','milijon�'),
        9 => array('bilijonas','bilijonai','bilijon�'),
       12 => array('trilijonas','trilijonai','trilijon�'),
       15 => array('kvadrilijonas','kvadrilijonai','kvadrilijon�'),
       18 => array('kvintilijonas','kvintilijonai','kvintilijon�')
        );

    /**
     * The array containing the digits (indexed by the digits themselves).
     * @var array
     * @access private
     */
    var $_digits = array(
        0 => 'nulis', 'vienas', 'du', 'trys', 'keturi',
        'penki', '�e�i', 'septyni', 'a�tuoni', 'devyni'
    );

    /**
     * The word separator
     * @var string
     * @access private
     */
    var $_sep = ' ';

    /**
     * The default currency name
     * @var string
     * @access public
     */
    var $def_currency = 'LTL';

    // }}}
    // {{{ toWords()

    /**
     * Converts a number to its word representation
     * in Lithuanian language
     *
     * @param integer $num       An integer between -infinity and infinity inclusive :)
     *                           that need to be converted to words
     * @param integer $power     The power of ten for the rest of the number to the right.
     *                           Optional, defaults to 0.
     * @param integer $powsuffix The power name to be added to the end of the return string.
     *                            Used internally. Optional, defaults to ''.
     *
     * @return string  The corresponding word representation
     *
     * @access public
     * @author Laurynas Butkus <lauris@night.lt>
     * @since  PHP 4.2.3
     */
    function toWords($num, $power = 0, $powsuffix = '')
    {
        $ret = '';

        // add a minus sign
        if (substr($num, 0, 1) == '-') {
            $ret = $this->_sep . $this->_minus;
            $num = substr($num, 1);
        }

        // strip excessive zero signs and spaces
        $num = trim($num);
        $num = preg_replace('/^0+/', '', $num);

        if (strlen($num) > 3) {
            $maxp = strlen($num)-1;
            $curp = $maxp;
            for ($p = $maxp; $p > 0; --$p) { // power

                // check for highest power
                if (isset($this->_exponent[$p])) {
                    // send substr from $curp to $p
                    $snum = substr($num, $maxp - $curp, $curp - $p + 1);
                    $snum = preg_replace('/^0+/', '', $snum);
                    if ($snum !== '') {
                        $cursuffix = $this->_exponent[$power][count($this->_exponent[$power])-1];
                        if ($powsuffix != '') {
                            $cursuffix .= $this->_sep . $powsuffix;
                        }

                        $ret .= $this->toWords($snum, $p, $cursuffix);
                    }
                    $curp = $p - 1;
                    continue;
                }
            }
            $num = substr($num, $maxp - $curp, $curp - $p + 1);
            if ($num == 0) {
                return $ret;
            }
        } elseif ($num == 0 || $num == '') {
            return $this->_sep . $this->_digits[0];
        }

        $h = $t = $d = 0;

        switch(strlen($num)) {
        case 3:
            $h = (int)substr($num, -3, 1);

        case 2:
            $t = (int)substr($num, -2, 1);

        case 1:
            $d = (int)substr($num, -1, 1);
            break;

        case 0:
            return;
            break;
        }

        if ( $h > 1 ) {
            $ret .= $this->_sep . $this->_digits[$h] . $this->_sep . '�imtai';
        } elseif ( $h ) {
            $ret .= $this->_sep . '�imtas';
        }

        // ten, twenty etc.
        switch ($t) {
        case 9:
            $ret .= $this->_sep . 'devyniasde�imt';
            break;

        case 8:
            $ret .= $this->_sep . 'a�tuoniasde�imt';
            break;

        case 7:
            $ret .= $this->_sep . 'septyniasde�imt';
            break;

        case 6:
            $ret .= $this->_sep . '�e�iasde�imt';
            break;

        case 5:
            $ret .= $this->_sep . 'penkiasde�imt';
            break;

        case 4:
            $ret .= $this->_sep . 'keturiasde�imt';
            break;

        case 3:
            $ret .= $this->_sep . 'trisde�imt';
            break;

        case 2:
            $ret .= $this->_sep . 'dvide�imt';
            break;

        case 1:
            switch ($d) {
            case 0:
                $ret .= $this->_sep . 'de�imt';
                break;

            case 1:
                $ret .= $this->_sep . 'vienuolika';
                break;

            case 2:
                $ret .= $this->_sep . 'dvylika';
                break;

            case 3:
                $ret .= $this->_sep . 'trylika';
                break;

            case 4:
                $ret .= $this->_sep . 'keturiolika';
                break;

            case 5:
                $ret .= $this->_sep . 'penkiolika';
                break;

            case 6:
                $ret .= $this->_sep . '�e�iolika';
                break;

            case 7:
                $ret .= $this->_sep . 'septyniolika';
                break;

            case 8:
                $ret .= $this->_sep . 'a�tuoniolika';
                break;

            case 9:
                $ret .= $this->_sep . 'devyniolika';
                break;

            }
            break;
        }

        // add digits only in <0>,<1,9> and <21,inf>
        if ($t != 1 && $d > 0) {
            if ( $d > 1 || !$power || $t ) {
                $ret .= $this->_sep . $this->_digits[$d];
            }
        }

        if ($power > 0) {
            if (isset($this->_exponent[$power])) {
                $lev = $this->_exponent[$power];
            }

            if (!isset($lev) || !is_array($lev)) {
                return null;
            }

            //echo " $t $d  <br>";

            if ($t == 1 || ($t > 0 && $d == 0 )) {
                $ret .= $this->_sep . $lev[2];
            } elseif ( $d > 1 ) {
                $ret .= $this->_sep . $lev[1];
            } else {
                $ret .= $this->_sep . $lev[0];
            }
        }

        if ($powsuffix != '') {
            $ret .= $this->_sep . $powsuffix;
        }

        return $ret;
    }
    // }}}

}

?>