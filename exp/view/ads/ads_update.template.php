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
                    <h1>Ads update form</h1>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="<?= $ads['title']; ?>">
                    <span style="color:red;font-size: 14px;"><?= error('title'); ?></span>
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <textarea type="text" class="form-control" name="body" value="<?= $ads['body']; ?>"
                              rows="5"><?= $ads['body']; ?></textarea>
                    <span style="color:red;font-size: 14px;"><?= error('title'); ?></span>
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
