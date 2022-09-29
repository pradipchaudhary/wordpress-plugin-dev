<?php 
    global $wpdb;
    $table_name = $wpdb->prefix. 'adsmanage';
    $all_ads = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * from $table_name", ""
        ),ARRAY_A
    );
    // echo "<pre>";
    // print_r($all_ads);

?>
        <div class="ads-list">
            <h1> Ads List </h1>
        <table class="">
        <tr>
            <th>S.N.</th>
            <th>Name </th>
            <th>Position </th>
            <th>Image</th>
            <th>Link</th>
            <th>Action </th>
        </tr>
        <?php 
        $count = 1;
        if(count($all_ads) > 0 ){
            foreach($all_ads as $index => $ads){
        ?>
            <tr>
                <td><?php echo $count++; ?> </td>
                <td><?php echo $ads['name'] ?> </td>
                <td><?php echo $ads['location']; ?> </td>
                <td><img src="<?php echo $ads['image'] ?>" alt="" > </td>
                <td><?php echo $ads['link'] ?> </td>
                <td>
                <a href="admin.php?page=wp-ads-add&action=edit&id=<?php echo $ads['id']; ?>"  class="edit-btn"> edit </a>
                </td> 
            </tr>

            <?php 
            }
            
        }
       else{
        ?>
     
        <tr>
            <td colspan="6" style="text-align:center; padding: 10px; font-size:1.1rem">No data </td>
        </tr>
       <?php
       }
        ?>
        </table>
    </div>
