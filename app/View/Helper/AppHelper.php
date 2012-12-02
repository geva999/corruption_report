<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

  public function number_or_zero($number = 0) {
    return (isset($number) ? $number : 0);
  }

  public function number_to_percent($number, $total) {
    if (!isset($number)) $number = 0;
    if (!isset($total) || $total == 0) {
      $number = 0;
      $total = 1;
    }
    return number_format($number / $total * 100, 2);
  }

  public function content_for_pdf($content = null) {
    //$content = preg_replace("/(\S)(-)(\S)/i", "$1<span class=\"zero-space\">-</span>$3", $content);

    return nl2br($content);
  }

}
