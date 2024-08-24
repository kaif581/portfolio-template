<?php include 'header.php'; ?>

<div class="admin-content-container">
<h2 class="admin-heading">Abouts</h2>
<a class="add-new pull-right" href="add_about.php">Add New</a>
<table class="table table-striped table-hover table-bordered">
    <?php 
    $limit = 3;
    $db = new Database();
    $db->select('about','about.id,about.user_id,about.sort_desc,about.long_desc,about.profile,about.status,users.id,users.name',
    'users ON about.user_id = users.id',null,'about.id DESC',$limit);
    $result= $db->getResult();
    if(count($result) > 0 ){
        ?>
        <thead></thead>
        <tr>
            <th>Name</th>
            <th>Sort Description</th>
            <th>Description</th>
            <th>Profile </th>
            <th colspan="3">Action</th>
        </tr>
        <tbody>
            <?php 
            
            foreach($result as $row){
                ?>
                <tr>
                    <tbody>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['sort_desc'] ?></td>
                        <td><?php echo $row['long_desc'] ?></td>
                        <td><img hight="50" width="50" src="<?php echo $base_url."profile/".$row['profile'] ?>"> </td>
                        <?php 
                        if($row['status'] == 1){
                            ?>
                            <td><a href="" data-status="<?php echo $row['status']; ?>" 
                            class="label label-success status" data-id="<?php echo $row['id'];?>">Block</td>
                            <?php
                        }
                        else{
                            ?>
                            <td><a href="" data-status="<?php echo $row['status']; ?>" 
                            class="label label-danger status" data-id="<?php echo $row['id'] ?>">Unblock</td>
                            <?php
                        }
                        ?>

                        <td><a href="javascript:void()"class="label label-warning aboutDelete" data-id="<?php echo $row['id'];?>">Delete</td>

                        <td><a href="add_about.php?id=<?php echo $row['id']?>" class="label label-primary " data-id="<?php echo $row['id'];?>">Edit</td>

                        
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
<div class="pagination-outer">
    echo $db->pagination('about','',$limit);
</div>
</div>

<?php include 'footer.php'; ?>
