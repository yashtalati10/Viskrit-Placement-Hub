<?php 

$originalPassword = "moyemoye";
$originalPassword2 = "danishBhai";

echo "Original Password :". $originalPassword;

$hasedPassword = password_hash($originalPassword, PASSWORD_BCRYPT);

echo "<br>";

echo "Hashed Password :". $hasedPassword;

$isPasswordMatch = password_verify($originalPassword2, $hasedPassword);
echo "<br>";

echo "Is Password Match :". $isPasswordMatch;

?>