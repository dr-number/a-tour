<?php
/* @var $title app\Models\UserModel */
?>

<style>
    .active{
        background-color: #5BC0DE;
    }
</style>

Только для авторизованного пользователя
<br>
Пользователь: <span style="color: #0066ff"><?= $user_email ?></span> авторизирован
<br>
<br>

<?php
    if(isset($users)){
        foreach ($users as $user){
            if($user->user_email == $user_email)
                $active = "active";
            else
                $active = "";


            print '<div class="'.$active.'">
                    <b>user: </b>'.$user->user_name.'
                    <b>mail: </b>'.$user->user_email.'
                    <b>created at: </b>'.$user->user_created_at.'
            </div>';
        }
    }
?>

<br>
<a href="<?= site_url('authorization/logout'); ?>">Выйти</a>
<br>
<a href="<?= site_url('registration'); ?>">Зарегистрироваться</a>
