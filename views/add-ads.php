
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <?php wp_enqueue_media(); ?>


<?php
    global $wpdb;
    $table_name = $wpdb->prefix. 'adsmanage';
    // Edit section
        $action = isset($_GET['action']) ? trim($_GET['action']) : "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : "";

        $row_details = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE id = %d", $id
            ),ARRAY_A
            );

    // Save Data
    if(isset($_POST['btnsubmit'])){
        $action = isset($_GET['action']) ? trim($_GET['action']) : "";
        $id = isset($_GET['id']) ? intval($_GET['id']) : "";

        $row_details = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE id = %d", $id
            ),ARRAY_A
            );


 
        if(!empty($action)){
           $wpdb->update("$table_name",array(
            "name" => $_POST["name"],
            "location" => $_POST['location'],
            "image" => $_POST['adsImage'] = '' ? $row_details['image'] : $_POST['adsImage'] ,
            "link" =>$_POST['link'],
            ),array(
            "id"=>$id
           ));
           $msg = "Form data Update successfully";
        }
        else{
            $wpdb->insert("$table_name", array(
                "name" => $_POST['name'],
                "location" => $_POST['location'],
                "image" => $_POST['adsImage'],
                "link" => $_POST['link'],
            ));
            if($wpdb->insert_id > 0 ){
                $msg = "Form data Save successfully";
            }
            else{
                $msg ="Failed to save data";
            }
        }
        
    }

// ?>
    
        <p> <?php echo $msg; ?> </p>
        <div class="ads-add">
            <h1> Add Ads </h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=wp-ads-add<?php if(!empty($action)){ echo '&action=edit&id='.$id;}; ?>" method="post"  enctype="multipart/form-data">
            <div class="name">
                <label for="name"> Ads Name</label>
                <input type="text" name="name" required value="<?php echo isset($row_details['name']) ? $row_details['name'] : ""; ?>" placeholder="Enter ads name" >
            </div>
            
            <div class="location">
                <div class="location-name">Ads  Location </div>

                  <div class="location-data" style="display:flex">
                    <div class="location-group">
                    <?php $location= isset($row_details['location']) ? $row_details['location'] : "";?>
                    <input type="radio" id="top" name="location" value="1" checked >
                        <label for="header">Top </label><br>
                    </div>

                     <div class="location-group">
                        <input type="radio" id="header" name="location" value="2">
                        <label for="nabbutton">After Menu </label><br>
                    </div>

                      <div class="location-group">
                        <input type="radio" id="sidebar" name="location" value="3">
                         <label for="javascript">Sidebar</label>
                    <?php
                        if($location==='1'){
                    ?>
                        <input type="radio" id="top" name="location" value="1" checked >
                        <label for="header">Top </label><br>
                    </div>

                     <div class="location-group">
                        <input type="radio" id="header" name="location" value="2">
                        <label for="nabbutton">After Menu </label><br>
                    </div>

                      <div class="location-group">
                        <input type="radio" id="sidebar" name="location" value="3">
                         <label for="javascript">Sidebar</label>

                        <?php
                        }
                        ?>
                    <?php

                    if($location==='2'){

                    ?>
                    <input type="radio" id="top" name="location" value="1"  >
                        <label for="header"> Top </label><br>
                    </div>

                     <div class="location-group">
                    <input type="radio" id="header" name="location" value="2" checked>
                        <label for="nabbutton">After Menu </label><br>
                    </div>

                      <div class="location-group">
                    <input type="radio" id="sidebar" name="location" value="3">
                     <label for="javascript">Sidebar</label>

                    <?php
                    }
                    ?>
                    <?php
                    if($location==='3'){
                    ?>
                    <input type="radio" id="top" name="location" value="1"  >
                        <label for="header">Top </label><br>
                    </div>

                     <div class="location-group">
                    <input type="radio" id="header" name="location" value="2" >
                        <label for="nabbutton">After Menu </label><br>
                    </div>

                      <div class="location-group">
                    <input type="radio" id="sidebar" name="location" value="3" checked>
                     <label for="javascript">Sidebar</label>

                    <?php
                    }
                    ?>                   
                    </div>
                  </div>
            </div>
            <div class="image">
                <label for="image"> Ads Image</label>
                <div class="image-upload-banner">
                    <div> <input type="button"  required name="Ads Upload" value="Ads Upload"  id="ads_Image"> </div>
                    <div class="image-place">
                        <input type="text"  required  id="adsImage" name="adsImage" value="" style="visibility: hidden;">
                         <img src="<?php echo isset($row_details['image']) ? $row_details['image'] : ""; ?>" id="getImage" alt="">
                    </div>
                </div>
            </div>
            <div class="link">
                <label for="link"> Ads Link  </label>
                <input type="text" name="link" required   value="<?php echo isset($row_details['link']) ? $row_details['link'] : ""; ?>">
            </div>

            <div class="save">
                <label for="save"></label>
                <button class="btn btn-primary" type="submit" name="btnsubmit"> Save </button>
            </div>
        </form>
    </div>

