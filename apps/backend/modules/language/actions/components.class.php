<?php

/**
 * language components.
 *
 * @package    graviola
 * @subpackage language
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageComponents extends sfComponents
{
  public function executeLanguage(sfWebRequest $request)
  {
    $this->form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'pt_BR'))
    );
  }
}
