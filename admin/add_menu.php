<?php include 'header.php'; ?>
<div class="admin-content-container">
<?php 
        if(isset($_GET['id']) && $_GET['id']){
            $db =new Database();
            $id = $db->escapeString($_GET['id']);

            $db->select('menu','*',"","id={$id}","id Desc","");
            $result = $db->getResult();
            if(isset($result)){
                ?>
                 <h2 class="admin-header">
                    Edit Menu
                </h2>
                <div class="row">
                <!-- Form -->
                <form id="updateMenu" class="add-post-form col-md-6" method="POST"
                    autocomplete="off">
                    <input type="hidden" class="id" id="id" value="<?php echo $result[0]['id'] ?>">
                    <div class="form-group">
                            <label>Menu Title</label>
                            <input type="text" name="menu_title" value="<?php echo $result[0]['menu_title'] ?>" class="form-control menu_title" 
                            placeholder="Menu Title"/>
                        </div>
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="menu_name" value="<?php echo $result[0]['menu_name']?>" class="form-control menu_name" placeholder="Menu Name"/>
                    </div>
                    <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
                </form>
                <!-- /Form -->
                <?php
            }
            
        }
        else{
            ?>
                 <h2 class="admin-header">
                    Add Menu
                </h2>
                <div class="row">
                <!-- Form -->
                <form id="createMenu" class="add-post-form col-md-6" method="POST"
                    autocomplete="off">
                    <div class="form-group">
                        <label>Menu Title</label>
                        <input type="text" name="menu_title" class="form-control menu_title" 
                        placeholder="Menu Title"/>
                    </div>
                    <div class="form-group">
                        <label>Menu Name</label>
                        <input type="text" name="menu_name" class="form-control menu_name" placeholder="Menu Name"/>
                    </div>
                    <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
                </form>
                <!-- /Form -->
            <?php
        }
    ?>
</div>
</div>
<?php include 'footer.php'; ?>