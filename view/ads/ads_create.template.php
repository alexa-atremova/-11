<!doctype html>
<html lang="en">
<?php require __DIR__ . '/../../src/parts/header.template.php' ;?>
<body>
<?php require __DIR__ . '/../../src/parts/nav.template.php' ;?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-6">
            <form action="/ads/create" method="POST">
                <div class="form-group">
                    <h1>Ads creation  form</h1>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo isset($_SESSION['data']['title']) ? $_SESSION['data']['title'] : '' ;?>">
                    <span style="color:red;font-size: 14px;"><?= error('title'); ?></span>
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <input type="text" class="form-control" name="comments" value="<?php echo isset($_SESSION['data']['comments']) ? $_SESSION['data']['comments'] : '' ;?>">
                    <span style="color:red;font-size: 14px;"><?= error('comments'); ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-lg-3">

        </div>
    </div>
</div>
<?php require __DIR__ . '/../../src/parts/scripts.template.php' ;?>
</body>
</html>