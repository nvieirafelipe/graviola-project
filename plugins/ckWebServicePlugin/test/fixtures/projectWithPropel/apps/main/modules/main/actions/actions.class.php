<?php

/**
 * main actions.
 *
 * @package    projectWithPropel
 * @subpackage main
 * @author     Christian Kerl
 * @version    SVN: $Id: actions.class.php 26450 2010-01-10 18:57:55Z chrisk $
 */
class mainActions extends sfActions
{
 /**
  * @WSMethod(name='getFixtureModel')
  *
  * @return Article[] All articles loaded from the database.
  */
  public function executeGetFixtureModel(sfWebRequest $request)
  {
    $this->result = ArticlePeer::doSelect(new Criteria());

    return sfView::SUCCESS;
  }

 /**
  * @WSMethod(name='passFixtureModel')
  *
  *	@param Article[] $articles
  *
  * @return Article[]
  */
  public function executePassFixtureModel(sfWebRequest $request)
  {
    $this->result = $request->getParameter('articles');

    return sfView::SUCCESS;
  }
}
