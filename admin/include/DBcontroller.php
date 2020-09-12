<?php
class adminsetup
{
private $ServerName ="localhost";

private $UserName = "root";

private $PassWord = "";

private $DatabaseName ="htu_firstdb";

private static $conn;
function __construct()
{
self::$conn = mysqli_connect($this->ServerName, $this->UserName, $this->PassWord, $this->DatabaseName);
}
public static function getConnection()
{
	return self::$conn;
}
public function insert_admin($adminemail,$adminpassword,$adminfullname)
{
	$query="INSERT INTO admin (admin_email,admin_password,admin_fullname)
				VALUES  ('$adminemail','$adminpassword','$adminfullname')";

		if(mysqli_query(self::$conn,$query)){
			header("Location:manage_adminOOP.php");
			//echo "done";
		}// if for query
		else
			echo "Error: " . $query . "<br>" . mysqli_error(self::$conn);
}//insert

public function view_admin($admin_id)
{
	$query="SELECT * FROM admin WHERE admin_id={$admin_id}";
	 	if(mysqli_query(self::$conn,$query))
	 	{
	 		$result=mysqli_query(self::$conn,$query);
	 		$admin=mysqli_fetch_assoc($result);
	 	
	 	return $admin; }
}//view
public function view_alladmin()
{
	$query="SELECT * FROM admin";
	 	if(mysqli_query(self::$conn,$query))
	 	{
	 		$result=mysqli_query(self::$conn,$query);
	 		$admin=mysqli_fetch_assoc($result);
	 	}
	 	return $admin; 
}
public function delet_admin($admin_id)
{
	 $query="DELETE FROM admin WHERE admin_id={$admin_id}";
	    if(mysqli_query(self::$conn,$query))	 {
	 	header("Location:manage_adminOOP.php");
	    	//echo "donedelet";
	 }
}//delet

public function update_admin($admin_id,$adminemail,$adminpassword,$adminfullname)
{
$query="UPDATE admin SET admin_email    ='$adminemail',
						 admin_password ='$adminpassword',
						 admin_fullname ='$adminfullname'
				WHERE admin_id={$admin_id}	";

		if(mysqli_query(self::$conn,$query)){
			header("Location:manage_admin.php");
			//echo "updatedone";
		}// if for query
		else
			echo "Error: " . $query . "<br>" . mysqli_error(self::$conn);
}//update

}//end of class

