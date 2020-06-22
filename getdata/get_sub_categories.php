<?php
error_reporting(0);
include "../config/koneksi.php";

$category = $_GET['category'];

$querySubCategory = "SELECT * FROM sub_categories WHERE categoryID = '$category' ORDER BY subCategoryName ASC";
$sqlSubCategory = mysql_query($querySubCategory);
$numsSubCategory = mysql_num_rows($sqlSubCategory);

if ($numsSubCategory > 0)
{
	echo "<option value='' SELECTED></option>";
}
else
{
	echo "<option value='0'>None</option>";
}
while ($dtSubCategory = mysql_fetch_array($sqlSubCategory))
{
	echo "<option value='$dtSubCategory[subCategoryID]'>&nbsp;$dtSubCategory[subCategoryName]</option>";
}
?>