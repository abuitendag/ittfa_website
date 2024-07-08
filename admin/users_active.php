<?php
include('../includes/connect.php'); 
include('../templates/header.php');   

//Fetch active sessions
function fetchActiveSessions() {
    $active_sessions = [];

    //Check if last_activity is set in session
    if (isset($_SESSION['last_activity'])) {
        $active_sessions[] = [
            'user_email' => $_SESSION['user_email'], // Use email from session
            'last_activity' => date('Y-m-d H:i:s', $_SESSION['last_activity']),
        ];
    }

    return $active_sessions;
}

//Fetch active session data
$online_users = fetchActiveSessions();
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="container mt-4">
    <h1>Active Users</h1>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Last Activity</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Display active users
        $count = 1;
        foreach ($online_users as $user) {
            echo "<tr>";
            echo "<th scope='row'>$count</th>";
            echo "<td>" . htmlspecialchars($user['user_email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['last_activity']) . "</td>";
            echo "</tr>";
            $count++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>