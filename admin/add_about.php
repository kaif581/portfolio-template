<?php 
include 'header.php'; 
?>
<div class="admin-content-container">

<?php 
if(isset($_GET['id']) || !empty($_GET['id'])){
    $db = new Database();
    $limit = 5;
    $id = $db->escapeString($_GET['id']);
    
    $db->select('about','*','',"id='{$id}'",'id DESC',$limit);
    $result1 = $db->getResult();
    if($result1 > 0){
        foreach ($result1 as $row1){
            ?>
            <h2 class="admin-heading">Edit Abouts</h2>
            <div class="row">
                <!-- Form -->
                <form id="updateAbout" class="add-post-form col-md-6" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="aboutId" class="aboutId" value="<?php echo $row1['id'] ?>">
                    <div class="form-group">
                        <label for="">User</label>
                        <?php
                        $db->select('users','*',null,null,null,null);
                        $result = $db->getResult(); ?>
                        <select class="form-control userId" name="userId">
                            <option value="" selected disabled>Select User</option>
                            <?php if (count($result) > 0) { ?>
                            
                                <?php foreach($result as $row) { 
                                    if($row1['id'] == $row['id']){
                                    ?>
                                        <option value="<?php echo $row['id']; ?>" select id=""><?php echo $row['name'];?></option>
                                    <?php  
                                    }
                                    } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort Description</label>
                        <input type="text" name="sort_desc" value="<?php echo $row1['sort_desc']; ?>" class="form-control sort_desc" placeholder="Sort Description"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control desc" name="desc" placeholder="Description.."><?php echo $row1['long_desc']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Profile</label>
                        <input type="file" name="new_profile" class="form-control new_profile" placeholder="Profile"/>
                        <input type="hidden" class="old_profile" name="old_profile"  value="<?php echo $row1['profile']; ?>">
                    </div>
                    <div class="form-group">
                       
                        <img src="<?php echo $base_url."profile/".$row1['profile']?>" height="200" width="200">
                    </div>
                    <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
                </form>
                <!-- /Form -->
            </div>
            <?php
            }
    }
    
    
}
else{
?>
<h2 class="admin-heading">Add New Abouts</h2>
<div class="row">
    <!-- Form -->
    <form id="createAbout" class="add-post-form col-md-6" method="POST"
        autocomplete="off" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">User</label>
            <?php
            $db = new Database();
            $db->select('users','*',null,null,null,null);
            $result = $db->getResult(); ?>
            <select class="form-control userId" name="userId">
                <option value="" selected disabled>Select User</option>
                <?php if (count($result) > 0) { ?>
                    <?php foreach($result as $row) { ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Sort Description</label>
            <input type="text" name="sort_desc" class="form-control sort_desc" placeholder="Sort Description"/>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control desc" name="desc" placeholder="Description.."></textarea>
        </div>
        <div class="form-group">
            <label>Profile</label>
            <input type="file" name="profile" class="form-control profile" placeholder="Profile"/>
        </div>
        <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
    </form>
    <!-- /Form -->
</div>
<?php
}

?>
</div>
<?php include 'footer.php'; ?>