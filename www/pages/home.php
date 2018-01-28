<?php include '../services/DatabaseConnection.class.php';

echo 'Attempting to connect....';

$db = Database::getInstance();
echo 'Instance found';

$mysqli = $db->getConnection();
echo 'Connection found';
?>

<!DOCTYPE html>
<html>
<body>
<p> Hello World </p>
</body>
</html>