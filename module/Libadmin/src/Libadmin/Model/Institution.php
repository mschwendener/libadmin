<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swissbib
 * Date: 12/13/12
 * Time: 2:59 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Libadmin\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

use Libadmin\Model\BaseModel;



class Institution extends BaseModel {

	public $bib_code;
	public $sys_code;

	public $is_active;

	public $label_de;
	public $label_fr;
	public $label_it;
	public $label_en;

	public $name_de;
	public $name_fr;
	public $name_it;
	public $name_en;

	public $url_de;
	public $url_fr;
	public $url_it;
	public $url_en;

	public $address;
	public $zip;
	public $city;
	public $country;
	public $canton;

	public $website;
	public $email;
	public $phone;
	public $skype;
	public $facebook;
	public $coordinates;
	public $isil;
	public $notes;




	/**
	 * @return InputFilter|InputFilterInterface
	 */
	public function getInputFilter() {
		if( !$this->inputFilter ) {
			$this->inputFilter	= new InputFilter();
			$factory     		= new InputFactory();

			$this->inputFilter->add($factory->createInput(array(
				'name'     => 'id',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			)));

			$this->inputFilter->add($factory->createInput(array(
				'name'		=> 'bib_code',
				'required'	=> true,
				'filters'	=> array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim')
				)
			)));
		}

		return $this->inputFilter;
	}

	public function getListLabel() {
		return $this->bib_code . ': ' . $this->label_de;
	}

	public function getTypeLabel() {
		return 'Institution';
	}


//	public function getInputFilter() {
//		if( !$this->inputFilter ) {
//			$inputFilter = new InputFilter();
//			$factory = new InputFactory();
//
//			$inputFilter->add($factory->createInput(array(
//				'name' => 'tablekey',
//				'required' => true,
//				'filters' => array(
//					array('name' => 'Int'),
//				),
//			)));
//
//			$inputFilter->add($factory->createInput(array(
//				'name' => 'libraryid',
//				'required' => true,
//				'filters' => array(
//					array('name' => 'StripTags'),
//					array('name' => 'StringTrim'),
//				),
//				'validators' => array(
//					array(
//						'name' => 'StringLength',
//						'options' => array(
//							'encoding' => 'UTF-8',
//							'min' => 1,
//							'max' => 25,
//						),
//					),
//				),
//			)));
//
//			$inputFilter->add($factory->createInput(array(
//				'name' => 'contentXML',
//				'required' => true,
//				'filters' => array(
//					array('name' => 'StringTrim'),
//				),
//			)));
//
//			$this->inputFilter = $inputFilter;
//		}
//
//		return $this->inputFilter;
//	}




//	public function parseContentXML() {
//
//		try {
//			$sxml = new \SimpleXMLElement($this->contentXML);
//		} catch( \Exception $e ) {
//			echo $e->getMessage();
//		}
//
//		$libraryItem = array();
//		foreach($sxml->children() as $attr => $val) {
//
//			//echo $val;
//			switch( $attr ) {
//				case "adress":
//					$adress = array();
//					foreach($val->children() as $adressPart => $val) {
//						$adress[$adressPart] = (string)$val;
//					}
//
//					$libraryItem["adress"] = $adress;
//
//					break;
//				case "translations":
//					$translations = array();
//					foreach($val->children() as $langName => $val) {
//						$t = (array)$val->attributes();
//						$lang_code = $t["@attributes"]["lang"];
//						$translations[$lang_code] = (string)$val;
//					}
//
//					$libraryItem["translations"] = $translations;
//
//					break;
//				default:
//					$libraryItem[$attr] = (string)$val;
//			}
//
//		}
//
//		$this->libraryElements = $libraryItem;
//
//	}


//
//	public function getLibraryElements() {
//		return $this->libraryElements;
//	}

}