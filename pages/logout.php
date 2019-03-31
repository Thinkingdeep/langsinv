<?php
Input::get('Admin');
if(isset($_SESSION['Admin'])){
    session_destroy();
    Redirect::to('index.php?page=login');
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

