<?php
namespace Libadmin\Controller;


use Libadmin\Helper\RelationOverview;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;

//use Libadmin\Table\ViewTable;
use Libadmin\Form\ViewForm;
use Libadmin\Model\View;


/**
 * [Description]
 *
 */
class ViewController extends BaseController {


	/**
	 *
	 * @return	ViewForm
	 */
	protected function getViewForm() {
		return $this->serviceLocator->get('ViewForm');
	}



	/**
	 * Add view
	 *
	 * @return	Response|ViewModel
	 */
	public function addAction() {
		$form			= $this->getViewForm();
		$request		= $this->getRequest();
		$flashMessenger	= $this->flashMessenger();

		if( $request->isPost() ) {
			$view = new View();
			$form->setInputFilter($view->getInputFilter());
			$form->setData($request->getPost());

			if( $form->isValid() ) {
				$view->exchangeArray($form->getData());
				$idView	= $this->getTable()->save($view);

				$flashMessenger->addSuccessMessage('New view added');

				return $this->redirectTo('edit', $idView);
			} else {
				$flashMessenger->addErrorMessage('Form not valid');
			}
		}

		$form->setAttribute('action', $this->makeUrl('view', 'add'));

		return $this->getAjaxView(array(
			'form'	=> $form,
			'title'	=> 'Add View'
		), 'libadmin/view/edit');
	}



	/**
	 * Edit view
	 *
	 * @return	ViewModel
	 */
	public function editAction() {
		$idView	= (int)$this->params()->fromRoute('id', 0);
		$flashMessenger	= $this->flashMessenger();

		if( !$idView ) {
			return $this->forwardTo('home');
		}

		try {
			/** @var View $view  */
			$view = $this->getTable()->getRecord($idView);
			$view->setGroups($this->getTable()->getGroupIDs($idView));
		} catch(\Exception $ex ) {
			$flashMessenger->addErrorMessage('Group not found');

			return $this->forwardTo('home');
		}

		$form = $this->getViewForm();
		$form->bind($view);

		$request = $this->getRequest();
		if( $request->isPost() ) {
			$form->setInputFilter($view->getInputFilter());
			$form->setData($request->getPost());

			if( $form->isValid() ) {
				$this->getTable()->save($form->getData());
				$flashMessenger->addSuccessMessage('View saved');
			} else {
				$flashMessenger->addErrorMessage('Form not valid');
			}
		}

		$form->setAttribute('action', $this->makeUrl('view', 'edit', $idView));

		/** @var RelationOverview $relationHelper  */
		$relationHelper	= $this->serviceLocator->get('RelationOverviewHelper');

		return $this->getAjaxView(array(
			'form'		=> $form,
			'title'		=> 'Edit View',
			'relations'	=> $relationHelper->getData($view)
		));
	}

}

?>