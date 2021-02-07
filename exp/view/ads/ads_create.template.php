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
            <form action="/ads/create" method="POST">
                <div class="form-group">
                    <h1>Ads create</h1>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="adsTitle"
                           value="<?php echo isset($_SESSION['data']['adsTitle']) ? $_SESSION['data']['adsTitle'] : ''; ?>">
                    <span style="color:red;font-size: 14px;"><?= error('adsTitle'); ?></span>
                </div>
                <div class="form-group">
                    <label>Ad text</label>
                    <textarea type="text" class="form-control" name="body"
                              value="<?php echo isset($_SESSION['data']['body']) ? $_SESSION['data']['body'] : ''; ?>"
                              rows="5"><?php echo isset($_SESSION['data']['body']) ? $_SESSION['data']['body'] : ''; ?></textarea>
                    <span style="color:red;font-size: 14px;"><?= error('body'); ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-lg-3">
        </div>
    </div>
</div>
<?php require __DIR__ . '/../parts/script.template.php'; ?>
</body>
</html>