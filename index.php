<?php
$mysqli=new mysqli('localhost','root','','kino');
if ($mysqli->connect_errno) {
echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
return false;
};
$mysqli->set_charset("utf8_unicode_ci");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET'){
    $a=array();
    if ($_GET['id']==1){
        $text="select * from cinema where name like '%".$_GET['name']."%' or address like '%".$_GET['name']."%'";
        $result=$mysqli->query($text);
        while ($row = mysqli_fetch_assoc($result)){
            $b=array("name"=>$row['name'],"address"=>$row['address']);
            $a[]=$b;
        }
		echo json_encode($a);
    }
	if ($_GET['id']==2){
  			$text=" select * from film where name like '%".$_GET['name']."%'";
			$result=$mysqli->query($text);
			while ($row = mysqli_fetch_assoc($result)){
				$b=array("name"=>$row['name']);
				$a[]=$b;
			}
			echo json_encode($a);
		}		
	if ($_GET['id']==3){
			$text="select * from cinema";
			$result=$mysqli->query($text);
			while ($row = mysqli_fetch_assoc($result)){
				$b=array("name"=>$row['name'],"id"=>$row['ID']);
				$a[]=$b;
			}
			echo json_encode($a);
		}
	};
	if ($method == 'POST'){
		
		if ($_POST['id']==1){
			$text="INSERT INTO `cinema`(`name`, `address`) VALUES ('".$_POST['name']."','".$_POST['address']."')";
			$result=$mysqli->query($text);
			echo $result;
		}
		if ($_POST['id']==2){
			$text="INSERT INTO `film`(`name`) VALUES ('".$_POST['name']."')";
			$result=$mysqli->query($text);
			$text="SELECT MAX(`ID`) as id FROM `film`"; 
			$result=$mysqli->query($text);
			if ($row = mysqli_fetch_assoc($result)){
				echo $row['id'];
			}
		}
		if ($_POST['id']==3){
			$text="INSERT INTO `connection`(`cinemaID`, `filmID`) VALUES (".$_POST['cinemaID'].",".$_POST['filmID'].")";
			$result=$mysqli->query($text);
			echo $result;
		}
	};
?>