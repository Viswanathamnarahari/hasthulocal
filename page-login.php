<?php session_start(); ?>
<html>
<head>
    <title>Login</title>
</head>
 
<body>
<a href="/demowebsite/">Home</a> <br />
<?php
//include("connection.php");

global $wpdb;
$table_name = $wpdb->prefix . "login";

if(isset($_POST['submit'])) {
	//https://stackoverflow.com/questions/15194051/mysqli-real-escape-string-returns-empty-string
    $user = esc_sql($_POST['username']);
    $pass = esc_sql($_POST['password']);
	
 
    if($user == "" || $pass == "") {
        echo "Either username or password field is empty.";
        echo "<br/>";
        echo "<a href='login.php'>Go back</a>";
    } else {
		 global $wpdb;
		 $table_name = $wpdb->prefix . "login";
		 echo "$user <br>	  $pass <br> 	 echo $table_name <br>";
        //$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5($pass)")
		$sql= "SELECT * FROM $table_name WHERE username = '$user' AND password=md5('$pass') ";
        
		//$result = $wpdb->get_results($sql)or die("LIP- Could not execute the select query.");
		//$result = $wpdb->get_results("SELECT * FROM $table_name WHERE username = '$user' ")
			
		$row = $wpdb->get_results($sql,ARRAY_A);
		echo "<pre>"; 
		print_r($row); 
		echo "/<pre>"; 
        
        if(is_array($row) && !empty($row)) {
            $validuser = $row[0]['username'];
            $_SESSION['valid'] = $validuser;
			
            $_SESSION['name'] = $row[0]['name'];
            //$_SESSION['id'] = $row['id'];
        } else {
            echo "Invalid username or password.";
            echo "<br/>";
            echo "<a href='login.php'>Go back</a>";
        }
 
        if(isset($_SESSION['valid'])) {
            //header('Location: https://www.google.com/');  
			//header('Location: ../custom-php-submit2');
			header('Location: ../user');
			//echo $validuser ;
			/* Make sure that code below does not get executed when we redirect. */
			exit ;
        }
    }
} else {
?>
    <p><font size="+2">Login</font></p>
    <form name="form1" method="post" action="">
        <table width="75%" border="0">
            <tr> 
                <td width="10%">Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr> 
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr> 
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
<?php
}