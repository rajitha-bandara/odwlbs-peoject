<?php

	include('init.php');

if($_REQUEST)
{
	$id 	= $_REQUEST['parent_id'];
	$query = "select * from lbs_biz_sub_categories where main_category_id = ".$id;
	$results = mysql_query( $query);?>
	
	<select name="listSubcategory"  id="sub_category_id" class="input-xlarge">
	<option value="" selected="selected"></option>
	<?php
	while ($rows = mysql_fetch_assoc(@$results))
	{?>
		<option value="<?php echo $rows['sub_category_id'];?>"><?php echo $rows['name'];?></option>
	<?php
	}?>
	</select>	
	
<?php	
}
?>