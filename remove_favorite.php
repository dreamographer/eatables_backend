<?php
include "dbconnect.php";
session_start();
$user_id = $_SESSION['id'];

$id = $_GET['id'];

$sql = "DELETE FROM favourite WHERE fav_id = $id AND uid = $user_id";
$res = $con->query($sql);

if ($res) {
    echo "<script>alert('Item removed from favourites.')</script>";
    echo "<script>window.location.href='userprofile.php'</script>";
} else {
    echo "An error occurred while trying to remove the item from your favourites.";
}
?>