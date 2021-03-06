<?php
require_once 'core/init.php';
if(Input::exists()){
    $validate = new Validate();
    $validation = $validate->check($_POST,array(
        'username' => array(
            'required' => 'true',
            'min' => 4,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'required' => 'true',
            'min' => 8
        ),
        'password-again' => array(
            'required' => 'true',
            'matches' => 'password'
        ),
        'name' => array(
            'required' => 'true',
            'min' => 4,
            'max' => 50
            )
        ));
    if($validation->passed()){
        echo 'Passed';
    }else{
        print_r($validation->errors());
    }
}
?>
<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>
    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" id="password" name="password">
    </div>
    <div class="field">
        <label for="password-again">Repeat password</label>
        <input type="password" id="password-again" name="password-again">
    </div>
    <div class="field">
        <label for="name">Full name</label>
        <input type="text" name="name" id="name" autocomplete="off">
    </div>
    <input type="submit" value="Register">
</form>

