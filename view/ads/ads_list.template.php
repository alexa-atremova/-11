<!doctype html>
<html lang="en">
<?php require __DIR__ . '/../../src/parts/header.template.php' ;?>
<body>

<?php require __DIR__ . '/../../src/parts/nav.template.php' ;?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="margin: 20px 0;">Ads create</h1>
            <?php foreach ($comments as $comment) { ?>
                <div class="jumbotron">

                    <h1 class="display-4"><?= $comment['title']; ?></h1>
                    <p class="lead"><?= $comment['comments']; ?></p>

                    <hr class="my-4">
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="/ads/edit?title=<?= $comment['title'];?>" role="button">Edit</a>
                        <a class="btn btn-primary btn-lg" href="/ads/delete?title=<?= $comment['title'];?>" role="button">Delete</a>
                    </p>

                </div>

            <?php } ?>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../../src/parts/scripts.template.php' ;?>

</body>
</html>