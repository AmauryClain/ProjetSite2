<?php
include('../elements/navbar.php');
include('../connection.php');

?>
<p>test</p>

<?php
// Redirect to a clean URL
header("Location: searchresult/searchresult.php");
exit();
