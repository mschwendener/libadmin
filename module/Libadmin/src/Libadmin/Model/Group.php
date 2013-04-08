<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swissbib
 * Date: 12/13/12
 * Time: 2:58 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Libadmin\Model;

//use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
//use Zend\InputFilter\InputFilter;                 // <-- Add this import
//use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
//use Zend\InputFilter\InputFilterInterface;        // <-- Add this import

use Libadmin\Model\BaseModel;

/**
 * Group
 *
 * @package	Libadmin\Model
 */
class Group extends BaseModel {

	public $code;
	public $is_active;

	public $label_de;
	public $label_fr;
	public $label_it;
	public $label_en;

	public $notes;

	public $views = array();


	public function extractBaseData() {
		$data	= parent::extractBaseData();

		unset($data['views']);

		return $data;
	}



	/**
	 * Get listing label
	 *
	 * @return	String
	 */
	public function getListLabel() {
		return $this->code . ': ' . $this->label_de;
	}



	public function getIsActive() {
		return $this->is_active;
	}



	public function getLabel_de() {
		return $this->label_de;
	}



	public function getLabel_en() {
		return $this->label_en;
	}



	public function getLabel_fr() {
		return $this->label_fr;
	}



	public function getLabel_it() {
		return $this->label_it;
	}



	public function getNotes() {
		return $this->notes;
	}



	/**
	 * Get type label
	 *
	 * @return	String
	 */
	public function getTypeLabel() {
		return 'Group';
	}

	public function getCode() {
		return $this->code;
	}

	public function getIs_Active() {
		return $this->is_active;
	}


	public function setCode($code) {
		$this->code = $code;
	}



	public function setIsActive($is_active) {
		$this->is_active = $is_active;
	}



	public function setLabel_De($label_de) {
		$this->label_de = $label_de;
	}



	public function setLabel_En($label_en) {
		$this->label_en = $label_en;
	}



	public function setLabel_Fr($label_fr) {
		$this->label_fr = $label_fr;
	}



	public function setLabel_It($label_it) {
		$this->label_it = $label_it;
	}



	public function setNotes($notes) {
		$this->notes = $notes;
	}








	/**
	 * @return	Integer[]
	 */
	public function getViews() {
		return $this->views;
	}


	public function setViews($views) {
		$this->views = $views;

		return $this;
	}

}
