<?php
class Category
{
	private $catId;
	private $catName;
	private $description;
	protected static $table_cat="lbs_biz_main_categories";
	protected static $table_sub_cat="lbs_biz_sub_categories";

	/**
	 * Get category by id
	 *
	 * @param $catId integer  indicator to find a category
	 * @return boolean on failure
	 * @return string on success
	 */
	public static function getCategoryName($catId="")
	{
		global $gdbObj;
		$sql = "SELECT name FROM ".self::$table_cat. " where main_category_id = '$catId' ";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{

			while($row = mysql_fetch_array($resut))
			{
				$results = $row[1];
					
			}
			return $results;
		}
	}

	/**
	 * Fetch all categories
	 *
	 * @return boolean on failure
	 * @return string on success
	 */
	public function fetchAllCategories()
	{
		global $gdbObj;
		$sql = "SELECT * FROM ".self::$table_cat;
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$id = $row[0];
				$name = $row[1];
				$results.= formatCategory($id,$name);
				$counter++;
			}
			return $results;
		}
	}

	/**
	 * Fetch all sub categories for a category
	 *
	 * @param $catId integer  category ID to fetch its child categories
	 * @param $catName string  category name
	 * @return boolean on failure
	 * @return string on success
	 */
	public function fetchAllSubCategories($catId="",$catName="")
	{

		global $gdbObj;
		$sql = "SELECT s.sub_category_id,s.name FROM ".self::$table_cat. " m,".self::$table_sub_cat." s where
		s.main_category_id = '$catId' AND  m.main_category_id = s.main_category_id" ;
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
			$counter = 1;
			while($row = mysql_fetch_array($resut))
			{
				$subCatId = $row[0];
				$subCatName = $row[1];
				$results.= formatSubCategory($catId,$catName,$subCatId,$subCatName);
				$counter++;
			}
			return $results;
		}
	}

	/**
	 * Verify category exists or not
	 *
	 * @param $catId integer  category ID to verify
	 * @return boolean on failure
	 * @return string on success
	 */
	public function verifyCategory($catId="")
	{
		global $gdbObj;
		$sql = "SELECT name FROM ".self::$table_cat. " where main_category_id = '$catId' ";
		$resut = $gdbObj->query($sql);

		$existCount = $gdbObj->num_rows($resut);
		if ($existCount < 1)
		{
			return false;
		}
		else
		{
				
			while($row = mysql_fetch_array($resut))
			{
				$results = $row[0];
					
			}
			return $results;
		}
	}

}
$gcatObj = new Category();
?>