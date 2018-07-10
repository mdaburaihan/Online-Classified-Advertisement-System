<?php include("inc/header.php"); ?>
 <div class="well">
  <h4>Manage Category & Subcategory...</h4>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_cat_subcat.php?add_Category';">Add New Category</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_cat_subcat.php?category_list';">All Category List</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_cat_subcat.php?add_Subcategory';">Add New Subcategory</button>
  <button type="button" class="btn btn-primary btn-md" onclick="location.href = 'manage_cat_subcat.php?subcategory_list';">All Subcategory List</button>
</div>
<div>
	<?php 
	if(isset($_GET['add_Category']))
	{
		?>
		<div>
			<?php
			include("add_Category.php");
		}
		?>
	</div>
	<?php 
	if(isset($_GET['add_Subcategory']))
	{
		?>
		<div>
			<?php
			include("add_Subcategory.php");
		}
		?>
	</div>
	<?php 
	if(isset($_GET['category_list']))
	{
		?>
		<div>
			<?php
			include("category_list.php");
		}
		?>
	</div>
	<?php 
	if(isset($_GET['subcategory_list']))
	{
		?>
		<div>
			<?php
			include("subcategory_list.php");
		}
		?>
	</div>
<div class="panel panel-default">
  <div class="panel-body"><button type="button" class="btn btn-primary" onclick="location.href = 'admin_panel.php';"><< Go Back</button></div>
</div>
<?php include("inc/footer.php"); ?>
