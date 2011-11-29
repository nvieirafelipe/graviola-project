<?php

/**
 * njUserProfile actions.
 *
 * @package    graviola
 * @subpackage njUserProfile
 * @author     Felipe Vieira         <nvieirafelipe@gmail.com>;
               Jean Frizo            <jfrizo@gmail.com>;
               Rafael Mardegan       <mardegan.rafael@gmail.com>;
               Yohan Araújo          <yohanaraujo07@gmail.com>;
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class njUserProfileActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->nj_user_profile = $this->getRoute()->getObject();
    $this->forward404Unless($this->nj_user_profile);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NjUserProfileForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($nj_user_profile = $this->getRoute()->getObject(), sprintf('Object nj_user_profile does not exist (%s).', $request->getParameter('id')));
    $this->form = new NjUserProfileForm($nj_user_profile);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($nj_user_profile = Doctrine_Core::getTable('NjUserProfile')->find(array($request->getParameter('id'))), sprintf('Object nj_user_profile does not exist (%s).', $request->getParameter('id')));
    $this->form = new NjUserProfileForm($nj_user_profile);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $nj_user_profile = $form->save();

      $this->redirect('njUserProfile/edit?id='.$nj_user_profile->getId());
    }
  }
}
