<?php include '../services/DatabaseConnection.class.php';

$db = DatabaseConnection ::getInstance();
echo 'Instance found' . "\n";

$mysqli = $db -> getConnection();
echo 'Connection found' . "\n";
?>

<!DOCTYPE html>
<html>
<body>
<p> Hello World </p>
</body>
</html>