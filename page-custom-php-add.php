<?php
session_start(); echo $_SESSION['valid'] ;
//function sinetiks_schools_create() {
	echo $_SESSION['valid'] ;	$CreatedBY = $_SESSION['valid'] ;
    $FirstName = $_POST["FirstName"];
    $Value = $_POST["Value"];
	$Subject = $_POST["Subject"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "hasthu_user_data";

        
		$wpdb->insert(
                $table_name, //table
                array('FirstName' => $FirstName, 'Value' => $Value, 'CreatedBy' => $CreatedBY, 'HasthuSubject' => $Subject ), //data
				array( '%s', '%s' , '%s' , '%s' ) //data format			
        );
        //$message .= "School inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/hasthu-data/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Bless New Person</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action= "<?php echo $_SERVER['REQUEST_URI']; ?>">
            <p>Enter the person name you want to bless </p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">FirstName</th>
                    <td><input type="text" name="FirstName" value="<?php echo $FirstName; ?>" class="ss-field-width" /></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Value</th>
                    <td><input type="text" name="Value" value="<?php echo $Value; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
					<th class="ss-th-width">Subject</th>
					<td> 
							<select name="Subject">
							  <option value="Select">Select</option>}
							  <option value="Money lend">Money lend</option>
							  <option value="EDucation expenses">EDucation expenses xx</option>
							  <option value="Vote for Presidency">Vote for Presidency</option>
							  <option value="Crime certification 0-10">Crime certification 0-10</option>
							  <option value="Respect in Society 0-10">Respect in Society 0-10</option>
							  <option value="Defaulted money 0-10 ">Defaulted money 0-10 </option>
							  <option value="My property share">My property share</option>
							  <option value="My money share">My money share</option>
							  <option value="Drinking 0-10">Drinking 0-10 </option>
							  <option value="Driving 0-10"> Driving 0-10</option>
							  <option value="Relegious 0-10">Relegious 0-10 </option>
							  <option value="God fear 0-10">God fear 0-10 </option>
							</select> 
					</td>
				</tr>
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
			<button formaction="<?php echo site_url('user') ?>">Go back to List</button
        </form>
    </div>
    <?php
//}