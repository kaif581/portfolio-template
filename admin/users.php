<?php 
include 'header.php';
?>
<div class="admin-content-container">
    <h2 class="admin-heading">Users</h2>

    <table class="table table-striped table-hover table-bordered">
        <?php 
        $limit = 5;
        $db = new Database();
        $db->select('users','*','',null,'id DESC',$limit);
        $result= $db->getResult();
        if(count($result) > 0 ){
            ?>
            <thead></thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Address</th>
                <th>Added On</th>
                <th colspan="3">Action</th>
            </tr>
            <tbody>
                <?php 
                
                foreach($result as $row){
                    ?>
                    <tr>
                        <tbody>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['city'] ?> </td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['added_on'] ?></td>
                            <?php 
                            if($row['status'] == 1){
                                ?>
                                <td><a href="javascript:void()" data-status="<?php echo $row['status']; ?>" 
                                class="label label-success user-status" data-id="<?php echo $row['id'];?>">Block</td>
                                <?php
                            }
                            else{
                                ?>
                                <td><a href="javascript:void()" data-status="<?php echo $row['status']; ?>" 
                                class="label label-warning user-status" data-id="<?php echo $row['id'] ?>">Unblock</td>
                                <?php
                            }
                            ?>

                            
                            <td><a href="javascript:void()" class="label label-danger userDelete" 
                            data-id="<?php echo $row['id'];?>">Delete</td>

                            <td><a href="edit-user.php?id=<?php echo $row['id']?>" class="label label-primary " data-id="<?php echo $row['id'];?>">Edit</td>

                            
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