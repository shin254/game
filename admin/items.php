<?php
require("core.php");
head();


if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $query = mysqli_query($connect, "DELETE FROM `items` WHERE id='$id'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fas fa-shopping-cart"></i> Items</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Items</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">

<?php
if (isset($_POST['add'])) {
    $item        = $_POST['item'];
    $image       = $_POST['image'];
    $category_id = $_POST['category-id'];
    $bonustype   = $_POST['bonustype'];
    $bonusvalue  = $_POST['bonusvalue'];
    $money       = $_POST['money'];
    $gold        = $_POST['gold'];
    $respect     = $_POST['respect'];
    $minlevel    = $_POST['minlevel'];
    $vip         = $_POST['vip'];
    
    $query = mysqli_query($connect, "INSERT INTO `items` (item, image, category_id, bonustype, bonusvalue, money, gold, respect, min_level, vip) VALUES ('$item', '$image', '$category_id', '$bonustype', '$bonusvalue', '$money', '$gold', '$respect', '$minlevel', '$vip')");
}
?>
                    
                <div class="row">
				<div class="col-md-8">
				
				<?php
if (isset($_GET['edit-id'])) {
    $id  = (int) $_GET["edit-id"];
    $sql = mysqli_query($connect, "SELECT * FROM `items` WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=items.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=items.php">';
    }
    
    if (isset($_POST['edit'])) {
        $item        = $_POST['item'];
        $image       = $_POST['image'];
        $category_id = $_POST['category-id'];
        $bonustype   = $_POST['bonustype'];
        $bonusvalue  = $_POST['bonusvalue'];
        $money       = $_POST['money'];
        $gold        = $_POST['gold'];
        $respect     = $_POST['respect'];
        $minlevel    = $_POST['minlevel'];
        $vip         = $_POST['vip'];
        
        $query = mysqli_query($connect, "UPDATE `items` SET `item`='$item', `image`='$image', `category_id`='$category_id', `bonustype`='$bonustype', `bonusvalue`='$bonusvalue', `money`='$money', `gold`='$gold', `respect`='$respect', `min_level`='$minlevel', `vip`='$vip' WHERE id='$id'");
        echo '<meta http-equiv="refresh" content="0; url=items.php">';
        
    }
?>
<form class="form-horizontal" action="" method="post">
                     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Edit Item</h3>
						</div>
				        <div class="box-body">
						      <div class="form-group">
											<label class="col-sm-3 control-label">Item: </label>
											<div class="col-sm-9">
												<input type="text" name="item" class="form-control" value="<?php
    echo $row['item'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Image: </label>
											<div class="col-sm-9">
												<input type="text" name="image" class="form-control" value="<?php
    echo $row['image'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Category: </label>
											<div class="col-sm-9">
	<select name="category-id" class="form-control" required>
									<?php
    $crun = mysqli_query($connect, "SELECT * FROM `item_categories`");
    while ($rw = mysqli_fetch_assoc($crun)) {
        echo '
                                    <option value="' . $rw['id'] . '"';
        if ($rw['id'] == $row['category_id']) {
            echo 'selected';
        }
        echo '>' . $rw['category'] . '</option>
									';
    }
?>
    </select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Bonus Type: </label>
											<div class="col-sm-9">
	<select name="bonustype" class="form-control" required>
        <option value="power"
<?php
    if ($row['bonustype'] == 'power') {
        echo ' selected';
    }
?>>Power</option>
        <option value="agility"
<?php
    if ($row['bonustype'] == 'agility') {
        echo ' selected';
    }
?>>Agility</option>
		<option value="endurance"
<?php
    if ($row['bonustype'] == 'endurance') {
        echo ' selected';
    }
?>>Endurance</option>
		<option value="intelligence"
<?php
    if ($row['bonustype'] == 'intelligence') {
        echo ' selected';
    }
?>>Intelligence</option>
		<option value="energy
<?php
    if ($row['bonustype'] == 'energy') {
        echo ' selected';
    }
?>">Energy</option>
		<option value="health"
<?php
    if ($row['bonustype'] == 'health') {
        echo ' selected';
    }
?>>Health</option>
    </select>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Bonus Value: </label>
											<div class="col-sm-9">
												<input type="number" name="bonusvalue" min="0" class="form-control" value="<?php
    echo $row['bonusvalue'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Money Price: </label>
											<div class="col-sm-9">
												<input type="number" name="money" min="0" class="form-control" value="<?php
    echo $row['money'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Gold Price: </label>
											<div class="col-sm-9">
												<input type="number" name="gold" min="0" class="form-control" value="<?php
    echo $row['gold'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Respect Bonus: </label>
											<div class="col-sm-9">
												<input type="number" name="respect" min="0" class="form-control" value="<?php
    echo $row['respect'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-3 control-label">Minimum Level: </label>
											<div class="col-sm-9">
												<input type="number" name="minlevel" min="0" class="form-control" value="<?php
    echo $row['min_level'];
?>" required>
											</div>
								</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">VIP Only: </label>
											<div class="col-sm-9">
	<select name="vip" class="form-control" required>
        <option value="No" <?php
    if ($row['vip'] == 'No') {
        echo 'selected';
    }
?>>No</option>
        <option value="Yes" <?php
    if ($row['vip'] == 'Yes') {
        echo 'selected';
    }
?>>Yes</option>
    </select>
	                                         </div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
}
?>
				
				    <div class="box">
						<div class="box-header">
							<h3 class="box-title">Items</h3>
						</div>
						<div class="box-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Item</th>
											<th>Category</th>
											<th>Bonus Type</th>
											<th>Bonus Value</th>
											<th>Money Price</th>
											<th>Gold Price</th>
											<th>Respect Bonus</th>
											<th>Minimum Level</th>								
											<th>VIP Only</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$query = mysqli_query($connect, "SELECT * FROM `items`");
while ($row = mysqli_fetch_assoc($query)) {
    $ccid  = $row['category_id'];
    $sqlcc = mysqli_query($connect, "SELECT * FROM `item_categories` WHERE id='$ccid' LIMIT 1");
    $rowcc = mysqli_fetch_assoc($sqlcc);
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td><center><img src="../' . $row['image'] . '" width="50px" height="50px"> ' . $row['item'] . '</center></td>
											<td>' . $rowcc['category'] . '</td>
											<td>' . ucfirst($row['bonustype']) . '</td>
											<td>' . $row['bonusvalue'] . '</td>
											<td>' . $row['money'] . '</td>
											<td>' . $row['gold'] . '</td>
											<td>' . $row['respect'] . '</td>
											<td>' . $row['min_level'] . '</td>
											<td>' . $row['vip'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
											</td>
										</tr>
';
}
?>
									</tbody>
								</table>
                        </div>
                     </div>
                </div>
                    
				<div class="col-md-4">
<form class="form-horizontal" action="" method="post">
				     <div class="box">
						<div class="box-header">
							<h3 class="box-title">Add Item</h3>
						</div>
				        <div class="box-body">
						        <div class="form-group">
											<label class="col-sm-4 control-label">Item: </label>
											<div class="col-sm-8">
												<input type="text" name="item" class="form-control" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Image: </label>
											<div class="col-sm-8">
												<input type="text" name="image" class="form-control" placeholder="images/items/" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Category: </label>
											<div class="col-sm-8">
	<select name="category-id" class="form-control" required>
<?php
$crun = mysqli_query($connect, "SELECT * FROM `item_categories`");
while ($rw = mysqli_fetch_assoc($crun)) {
    echo '
                                    <option value="' . $rw['id'] . '">' . $rw['category'] . '</option>
									';
}
?>
    </select>
											</div>
										</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Bonus Type: </label>
											<div class="col-sm-8">
	<select name="bonustype" class="form-control" required>
        <option value="power" selected>Power</option>
        <option value="agility">Agility</option>
		<option value="endurance">Endurance</option>
		<option value="intelligence">Intelligence</option>
		<option value="energy">Energy</option>
		<option value="health">Health</option>
    </select>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Bonus Value: </label>
											<div class="col-sm-8">
												<input type="number" name="bonusvalue" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Money Price: </label>
											<div class="col-sm-8">
												<input type="number" name="money" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Gold Price: </label>
											<div class="col-sm-8">
												<input type="number" name="gold" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Respect Bonus: </label>
											<div class="col-sm-8">
												<input type="number" name="respect" min="0" class="form-control" value="" required>
											</div>
								</div>
								<div class="form-group">
											<label class="col-sm-4 control-label">Minimum Level: </label>
											<div class="col-sm-8">
												<input type="number" name="minlevel" min="0" class="form-control" value="" required>
											</div>
								</div>
										<div class="form-group">
											<label class="col-sm-4 control-label">VIP Only: </label>
											<div class="col-sm-8">
	<select name="vip" class="form-control" required>
        <option value="No" selected>No</option>
        <option value="Yes">Yes</option>
    </select>
											</div>
										</div>
                        </div>
                        <div class="panel-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>

				</div>
				</div>
                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->

<script>
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );
} );
</script>
<?php
footer();
?>