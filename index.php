<?php
//Dynamic loading of pages
// Get the 'page' parameter from the URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Switch case for pages
switch ($page) {
    case 'home':
        include('user/home.php');
        break;
    case 'all_entries':
        include('user/all_entries.php');
        break;
    case 'user_analytics':
        include('user/user_analytics.php'); 
        break;
    case 'registration':
        include('registration.php'); 
        break;   
        case 'login':
            include('login.php'); 
            break;             
    default:
        include('error.php'); 
        break;
}
?>