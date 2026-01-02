<?php
session_start();
require_once('../models/technicianModel.php');

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
?>

<h3>Pending Technicians</h3>

<table border="1" cellpadding="10">
<tr>
    <th>Email</th>
    <th>Username</th>
    <th>Specialist</th>
    <th>Action</th>
</tr>

<?php
$result = getPendingTechnicians();
if(mysqli_num_rows($result) > 0){
    while($tech = mysqli_fetch_assoc($result)){
        echo "<tr>
            <td>{$tech['email']}</td>
            <td>{$tech['username']}</td>
            <td>{$tech['specialization']}</td>
            <td>
                <a href='../controllers/admin_auth.php?approve={$tech['id']}'>Approve</a> |
                <a href='../controllers/admin_auth.php?decline={$tech['id']}'>Decline</a>
            </td>
        </tr>";
    }
}else{
    echo "<tr><td colspan='4'>No pending technicians</td></tr>";
}
?>
</table>