<?php
/**
 * This file is part of the ckWebServicePlugin
 *
 * @package   ckWebServicePlugin
 * @author    Christian Kerl <christian-kerl@web.de>
 * @copyright Copyright (c) 2008, Christian Kerl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id: soapFaultNoDebugTest.php 20950 2009-08-08 20:45:00Z chrisk $
 */

$app = 'frontend';
$env = 'soapTestServiceApi';
$debug = false;

include_once(dirname(__FILE__).'/../bootstrap/functional.php');

$c = new ckTestSoapClient();

// test executeException
$c->test_exception()
  ->hasFault('Internal Server Error');

// test executeSoapFault
$c->test_soapFault()
  ->hasFault('TestSoapFault');