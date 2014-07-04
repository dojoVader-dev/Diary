<?php

namespace Plugin\Diary;

class CategoryModel extends BaseModel {
	/**
	 * Inserts the Category into the Database
	 *
	 * @param Array $data
	 * @return int Record ID or false
	 */
	public $name="diary_category";
	const DRAFT = 0;
	const PUBLISHED = 1;
	public function save($data) {

		return ipDb ()->insert ( "diary_category", $data );

	}
	/**
	 * Returns an Array of Status for the Category
	 *
	 * @return multitype:string
	 */
	public function getCategoryStatus() {
		return array (
				"Draft" => self::DRAFT,
				"Published" => self::PUBLISHED
		);
	}
	public function getCategories() {
		return ipDb ()->selectAll ( "diary_category", array (
				'id',
				'name'
		) );
	}
	public function getCategoryOptions() {
		$options = $this->getCategories ();
		$optionsArray = array ();
		foreach ( $options as $opt ) {
			$optionsArray [] = array (
					$opt ['id'],
					$opt ['name']
			);
		}
		return $optionsArray;
	}
}
