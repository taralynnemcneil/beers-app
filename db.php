<?php
// connecting to the database
$conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc', '', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>