<?php

/**
 * ComplexNumber class.
 *
 * @package    project
 * @subpackage lib
 * @author     Christian Kerl <christian-kerl@web.de>
 * @version    SVN: $Id: ComplexNumber.class.php 13821 2008-12-07 20:34:32Z chrisk $
 */
class ComplexNumber
{
  /**
   * @var float
   */
  public $realPart;

  /**
   * @var float
   */
  public $imaginaryPart;

  public function __construct($realPart, $imaginaryPart)
  {
    $this->realPart      = $realPart;
    $this->imaginaryPart = $imaginaryPart;
  }

  public function __toString()
  {
    return sprintf('%.2f + %.2fi', $this->realPart, $this->imaginaryPart);
  }

  public function multiply($c)
  {
    $real      = $this->realPart * $c->realPart - $this->imaginaryPart * $c->imaginaryPart;
    $imaginary = $this->realPart * $c->imaginaryPart - $this->imaginaryPart * $c->realPart;
    return new ComplexNumber($real, $imaginary);
  }
}