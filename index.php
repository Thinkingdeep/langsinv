
<?php

//echo 'Display';
 session_start();
// $_SESSION['getin_role'] = 'Administrator';
require_once 'functions/functions.php';
include 'core/init.php';
$date_today = date('Y-m-d');
error_reporting(E_ALL);
// $uuid = exec('python makeuuid.py');
//$passwordHasher=new PBKDF2PasswordHasher();
$crypt = new Encryption();
//echo date("Y-m-d h:i:s");
// Current / default page
//$encoded_page = isset($_GET['page']) ? $_GET['page'] : $crypt->encode('login');
$encoded_page = isset($_GET['page']) ? $_GET['page'] : ('login');
//$page = $crypt->decode($encoded_page);
$page = $encoded_page;

switch ($page) {
    default:
        $page = "error";
        //check_login_status();
        include 'pages/error.php';
        break;

    case 'index':
        //check_login_status();
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'login':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
    case 'logout':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'dashboard':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'profile':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'print':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'print_receipt':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'record_input':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'new_purchase':
        if (file_exists('pages/stock/' . $page . '.php'))
            include 'pages/stock/' . $page . '.php';
        break;

    case 'view_purchases':
        if (file_exists('pages/stock/' . $page . '.php'))
            include 'pages/stock/' . $page . '.php';
        break;

    case 'view_purchases_single':
        if (file_exists('pages/stock/' . $page . '.php'))
            include 'pages/stock/' . $page . '.php';
        break;

    case 'view_stock':
        if (file_exists('pages/stock/' . $page . '.php'))
            include 'pages/stock/' . $page . '.php';
        break;

    case 'new_customer':
        if (file_exists('pages/customer/' . $page . '.php'))
            include 'pages/customer/' . $page . '.php';
        break;

    case 'view_customers':
        if (file_exists('pages/customer/' . $page . '.php'))
            include 'pages/customer/' . $page . '.php';
        break;

    case 'new_supplier':
        if (file_exists('pages/supplier/' . $page . '.php'))
            include 'pages/supplier/' . $page . '.php';
        break;

    case 'view_suppliers':
        if (file_exists('pages/supplier/' . $page . '.php'))
            include 'pages/supplier/' . $page . '.php';
        break;

    case 'new_sale':
        if (file_exists('pages/sales/' . $page . '.php'))
            include 'pages/sales/' . $page . '.php';
        break;

    case 'view_sales':
        if (file_exists('pages/sales/' . $page . '.php'))
            include 'pages/sales/' . $page . '.php';
        break;
        
    case 'new_schedule':
        if (file_exists('pages/schedules/' . $page . '.php'))
            include 'pages/schedules/' . $page . '.php';
        break;

    case 'view_schedules':
        if (file_exists('pages/schedules/' . $page . '.php'))
            include 'pages/schedules/' . $page . '.php';
        break;
        
    case 'view_sales_single':
        if (file_exists('pages/sales/' . $page . '.php'))
            include 'pages/sales/' . $page . '.php';
        break;

    case 'new_income':
        if (file_exists('pages/incomes/' . $page . '.php'))
            include 'pages/incomes/' . $page . '.php';
        break;

    case 'view_incomes':
        if (file_exists('pages/incomes/' . $page . '.php'))
            include 'pages/incomes/' . $page . '.php';
        break;

    case 'new_expense':
        if (file_exists('pages/expenses/' . $page . '.php'))
            include 'pages/expenses/' . $page . '.php';
        break;

    case 'view_expenses':
        if (file_exists('pages/expenses/' . $page . '.php'))
            include 'pages/expenses/' . $page . '.php';
        break;

    case 'payment_report':
        if (file_exists('pages/reports/' . $page . '.php'))
            include 'pages/reports/' . $page . '.php';
        break;

    case 'income_statement':
        if (file_exists('pages/reports/' . $page . '.php'))
            include 'pages/reports/' . $page . '.php';
        break;

    case 'balance_sheet':
        if (file_exists('pages/reports/' . $page . '.php'))
            include 'pages/reports/' . $page . '.php';
        break;

    case 'company_account_settings':
        if (file_exists('pages/settings/' . $page . '.php'))
            include 'pages/settings/' . $page . '.php';
        break;

    case 'company_product_settings':
        if (file_exists('pages/settings/' . $page . '.php'))
            include 'pages/settings/' . $page . '.php';
        break;

    // case 'company_stock_settings':
    //     if (file_exists('pages/settings/' . $page . '.php'))
    //         include 'pages/settings/' . $page . '.php';
    //     break;

    case 'company_income_settings':
        if (file_exists('pages/settings/' . $page . '.php'))
            include 'pages/settings/' . $page . '.php';
        break;

    case 'company_expenditure_settings':
        if (file_exists('pages/settings/' . $page . '.php'))
            include 'pages/settings/' . $page . '.php';
        break;
}
?>
