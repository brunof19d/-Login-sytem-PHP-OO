<?php
/* Controller View */
require_once "config.php";
/* Controller View */
require_once "controller/admin_controller.php";
/* Includes Header */
require_once "lib/includes/header.php";
?>

<div class="card-header p-5 text-center">
    <h3 class="h2 mb-0">Admin Page - Register User </h3>
</div>
<div class="card-body p-5">
    <div class="form-group">
        <label for="inputEmail">Email:</label>
        <input type="text" name="input_email" id="inputEmail" placeholder="user@email.com"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="inputPassword">Password:</label>
        <input type="password" name="input_password" id="inputPassword" placeholder="*****"
               class="form-control"/>
    </div>
    <div class="form-group">
        <button name="register_user" class="btn btn-dark btn-block">
            Register
        </button>
    </div>
</div>
<table class="table table-striped text-center">
    <thead>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Active</th>
        <th>#</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody style="font-size: 14px;">
    <?php foreach ($userList as $user): ?>
        <tr>
            <th style="width: 5%"><?php echo $user->getId(); ?></th>
            <td><?php echo $user->getEmail(); ?></td>
            <td style="width: 5%"><?php echo $user->getActive(); ?></td>
            <td style="width: 10%"><a class="btn btn-info">Remove access</a></td>
            <td style="width: 10%"><a href="index.php?delete=<?=$user->getId();?>" class="btn btn-danger">Delete User</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once "lib/includes/footer.php"; ?>

