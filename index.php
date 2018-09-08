<?php
//header
include_once './header.php';



/*
get all categories and list them here
big "submit question" button
get questions of selected category and list them 
(chronological or by alphabet)
*/

$stmt = $link->prepare("SELECT * FROM topics;");
        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);
        
		
		while($row = mysqli_fetch_assoc($result)){
			echo $row['name'];
			
		}
//footer
include_once './footer.php';
?>
