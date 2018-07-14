<html>
<head>
    <title>Register</title>
</head>
 
<body>
    <a href="/demowebsite/">Home</a> <br />
    <?php
    //include("connection.php");
	global $wpdb;
	$table_name = $wpdb->prefix . "login";
 
    if(isset($_POST['submit'])) {
        $name = $_POST['Fullname'];  
        $email = $_POST['email']; 
        $user = $_POST['username'];
        $pass = $_POST['password'];
		//echo $name . $email . $user . $pass ;
        if($user == "" || $pass == "" || $name == "" || $email == "") {
			
            echo "All fields should be filled. Either one or many fields are empty.";
            echo "<br/>";
            echo "<a href='/demowebsite/register/'>Go back</a>";
			

        } else {
            //mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
            
			$wpdb->insert(
                $table_name, //table
                array('name' => $name, 'email' => $email, 'username' => $user, 'password'=> md5($pass)), //data
                array('%s', '%s' ,'%s', '%s') //data format			
				)
				or die("Could not execute the insert query.");
            
            echo "Registration successful";
            echo "<br/>";
            echo "<a href='login.php'>Login</a>";
        }
    } else {
?>
        <p><font size="+2">Register</font></p>
        <form name="form1" method="post" action="">
            <table width="75%" border="0">
                <tr> 
                    <td width="10%">Full Name</td>
                    <td><input type="text" name="Fullname"></td>
                </tr>
                <tr> 
                    <td>Email</td>
                    <td><input type="text" name="email"></td>
                </tr>            
                <tr> 
                    <td>Username</td>
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
    ?>
</body>
</html>