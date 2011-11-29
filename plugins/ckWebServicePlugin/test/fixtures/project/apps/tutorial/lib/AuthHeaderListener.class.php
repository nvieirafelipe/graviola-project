<?php

/**
 * AuthHeaderListener class.
 *
 * @package    project
 * @subpackage lib
 * @author     Christian Kerl <christian-kerl@web.de>
 * @version    SVN: $Id: AuthHeaderListener.class.php 13821 2008-12-07 20:34:32Z chrisk $
 */
class AuthHeaderListener
{
  const HEADER = 'AuthHeader';

  public static function handleAuthHeader($event)
  {
    if($event['header'] == self::HEADER)
    {
      if($event['data']->username == 'test' && $event['data']->password == 'secret')
      {
        sfContext::getInstance()->getUser()->setAuthenticated(true);
      }

      return true;
    }
    else
    {
      return false;
    }
  }
}