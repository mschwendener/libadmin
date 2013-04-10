<?php
/**
 * Created by JetBrains PhpStorm.
 * User: swissbib
 * Date: 12/13/12
 * Time: 2:59 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Libadmin\Table;

use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Predicate\PredicateSet;

use Libadmin\Table\BaseTable;
use Libadmin\Model\BaseModel;
use Libadmin\Model\Institution;
use Libadmin\Model\InstitutionRelation;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class InstitutionTable
 * @package Libadmin\Table
 */
class InstitutionTable extends BaseTable {

	/**
	 * @var InstitutionRelationTable
	 */
	protected $relationTabl;



	public function __construct(TableGateway $institutionTableGateway, InstitutionRelationTable $relationTable) {
		parent::__construct($institutionTableGateway);

		$this->relationTable = $relationTable;
	}



	/**
	 * @var	String[]	Fulltext search fields
	 */
	protected $searchFields = array(
		'bib_code',
		'sys_code',
		'label_de',
		'label_fr'
	);



	/**
	 * Find institutions
	 *
	 * @param	String			$searchString
	 * @param	Integer			$limit
	 * @return	BaseModel[]
	 */
	public function find($searchString, $limit = 30) {
		return $this->findFulltext($searchString, 'label_de', $limit);
	}



	/**
	 * Get all institutions
	 *
	 * @param	Integer		$limit
	 * @return	ResultSetInterface
	 */
	public function getAll($limit = 30) {
		return parent::getAll('label_de', $limit);
	}



	/**
	 * Get institution
	 *
	 * @param	Integer		$idInstitution
	 * @return	Institution
	 */
	public function getRecord($idInstitution) {
		return parent::getRecord($idInstitution);
	}



	public function save(Institution $institution) {
		$relations		= $institution->getRelations();
		$idInstitution	= parent::save($institution);

		$this->saveRelations($idInstitution, $relations);

		return $idInstitution;
	}



	/**
	 * @param	Integer		$idInstitution
	 * @param	InstitutionRelation[]	$relations
	 */
	protected function saveRelations($idInstitution, array $relations) {
		$this->relationTable->clear($idInstitution);

		foreach($relations as $relation) {
			if( $relation->hasView() ) {
				$relation->setIdInstitution($idInstitution);
				$this->relationTable->add($relation);
			}
		}
	}

}
