<?php include '../services/DatabaseConnection.class.php';

$db = Database::getInstance();
echo 'Instance found' . "\n";

$mysqli = $db->getConnection();
echo 'Connection found' . "\n";
?>

<!DOCTYPE html>
<html>
<body>
<p> Hello World </p>
</body>
</html>