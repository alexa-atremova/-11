<!doctype html>
<html lang="en">
<?php require __DIR__ . '/../parts/head.template.php'; ?>
<body>
<?php require __DIR__ . '/../parts/nav.template.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <form action="/user/registration" method="POST">
                <div class="form-group">
                    <h1>User update form</h1>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>">
                    <span style="color:red;font-size: 14px;"><?= error('name'); ?></span>
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" class="form-control" name="email" value="<?= $user['email']; ?>">
                    <span style="color:red;font-size: 14px;"><?= error('email'); ?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    <span style="color:red;font-size: 14px;"><?= error('password'); ?></span>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <?php if ($user['status'] == 1) { ?>
                            <option value="1" selected>Active</option>
                        <?php } else { ?>
                            <option value="1">Active</option>
                        <?php } ?>
                        <?php if ($user['status'] == 0) { ?>
                            <option value="0" selected>Inactive</option>
                        <?php } else { ?>
                            <option value="0">Inactive</option>
                        <?php } ?>
                    </select>
                    <span style="color:red;font-size: 14px;"><?= error('status'); ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>

</div>
<?php require __DIR__ . '/../parts/script.template.php'; ?>
</body>
</html><?php
