<?php include 'header.php'; ?>
<div class="admin-content-container">
<h2 class="admin-heading">Menu</h2>
<a class="add-new pull-right" href="add_menu.php">Add New</a>
<table class="table table-striped table-hover table-bordered">
    <?php 
    $limit = 5;
    $db = new Database();
    $db->select('menu','*','','','id Desc','');
    $result= $db->getResult();
    if(count($result) > 0 ){
        ?>
        <thead></thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
        <tbody>
            <?php 
            
            foreach($result as $row){
                ?>
                <tr>
                    <tbody>
                        <td><?php echo $row['menu_name'] ?></td>
                        <td><?php echo $row['menu_title'] ?></td>
                        <?php 
                        if($row['status'] == 1){
                            ?>
                            <td><a href="javascript:void()" data-status="<?php echo $row['status']; ?>" 
                            class="label label-success menu_status" data-id="<?php echo $row['id'];?>">Block</td>
                            <?php
                        }
                        else{
                            ?>
                            <td><a href="javascript:void()" data-status="<?php echo $row['status']; ?>" 
                            class="label label-danger menu_status" data-id="<?php echo $row['id'] ?>">Unblock</td>
                            <?php
                        }
                        ?>

                        <td><a href="javascript:void()"class="label label-warning menuDelete" data-id="<?php echo $row['id'];?>">Delete</td>

                        <td><a href="add_menu.php?id=<?php echo $row['id']?>" class="label label-primary " data-id="<?php echo $row['id'];?>">Edit</td>

                        
                    </body>
                </tr>
                <?php
            }
            ?>

        
        </tbody>
        <?php
    }
    else{
        ?><div class="alert alert-danger">Data Not Found</div><?php
    }
    ?>
    
</table>
</div>
<?php include 'footer.php'; ?>