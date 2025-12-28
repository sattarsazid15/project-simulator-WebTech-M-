<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}
?>

<h2>Admin Dashboard</h2>

<h3>Pending Technicians</h3>

<?php
if (!empty($_SESSION['pending_technicians'])) {
    foreach ($_SESSION['pending_technicians'] as $index => $tech) {
        echo $tech['username'];
        echo " <a href='../controllers/admin_auth.php?approve=$index'>Approve</a><br>";
    }
} else {
    echo "No pending requests";
}

?>

<br>
<a href="../controllers/logout.php">Logout</a>