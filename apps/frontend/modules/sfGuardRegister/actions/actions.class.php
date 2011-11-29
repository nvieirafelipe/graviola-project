<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Rafael Mardegan
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
  public function executeRegister(sfWebRequest $request) {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();

    if ($request->isMethod(sfRequest::POST))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        
        // Create a new profile
        $profile = new NjUserProfile();
        $profile->setSfGuardUser($user);
        $profile->save();
        
        $user->addGroupByName('BasicUser');
        $this->getUser()->signIn($user);

        $this->redirect('@homepage');
      }
    }
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $user_id = $this->getUser()->getGuardUser()->getId();
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($user_id)), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardRegisterForm($sf_guard_user);
    if ($request->isMethod(sfRequest::POST))
    {
      $this->processForm($request, $this->form);
    }
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();
    }
  }  
}