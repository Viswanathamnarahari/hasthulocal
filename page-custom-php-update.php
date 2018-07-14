<?php
session_start(); echo $_SESSION['valid'] ;// echo $_SERVER['REQUEST_URI']; echo WP_PLUGIN_URL;

    global $wpdb;
    $table_name = $wpdb->prefix . "hasthu_user_data";
    $FirstName = $_GET["FirstName"];
    $Value = $_POST["Value"];
	//update
    if (isset($_POST['update'])) {
		$wpdb->update(
                $table_name, //table
                array('Value' => $Value ), //data
                array('FirstName' => $FirstName), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        //$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE FirstName = %s", $FirstName)); 
			$wpdb->update(
                $table_name, //table
                array('Value' => $Value , 'Deleted' => 'Yes'), //data
                array('FirstName' => $FirstName), //where
                array('%s', '%s' ), //data format
                array('%s') //where format
			);	
				
    } else {//Reading value to update front end first time
        $Values = $wpdb->get_results($wpdb->prepare("SELECT FirstName,Value from $table_name where FirstName=%s", $FirstName));
        foreach ($Values as $s) {
            $Value = $s->Value;
        }
    }
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/hasthu-data/style-admin.css" rel="stylesheet" />
<div class="wrap">
	<h2>Update or delete  "<?php echo $FirstName ?>"</h2>

	<?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Entity deleted</p></div>
            <a href="<?php echo site_url('user') ?>">&laquo; Back to your home screen</a>

	<?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Entity updated</p></div>
            <a href="<?php echo site_url('user') ?>">&laquo; Back to your home screen</a>

    <?php } else { ?>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<table >
				<tr><th>Value</th><td>	<input type="text" name="Value" value="<?php echo $Value; ?>"/></td></tr>
			</table>
			<input type='submit' name="update" value='Save' > &nbsp;&nbsp;
			<input type='submit' name="delete" value='Delete' onclick="return confirm('Do you really want to delete ?')"> &nbsp;&nbsp;
			<button formaction="<?php echo site_url('user') ?>">Go back to List</button>		
		</form>
	<?php } ?>
</div>
<?php