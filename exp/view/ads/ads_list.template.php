<!doctype html>
<html lang="en">
<?php require __DIR__ . '/../parts/head.template.php'; ?>
<body>
<?php require __DIR__ . '/../parts/nav.template.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="margin: 20px 0;">Ads</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ad Title</th>
                    <th scope="col">Ad text</th>
                    <th scope="col">Created</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($adsAll as $ads) { ?>
                    <tr>
                        <th scope="row"><?= $ads['id']; ?></th>
                        <td><?= $ads['title']; ?></td>
                        <td><?= $ads['body']; ?></td>
                        <td>
                            <?php
                            $date = new DateTime($ads['created_at']);
                            echo $date->format('Y-m-d');
                            ?>
                        </td>
                        <td>
                            <a href="/ads/edit?id=<?= $ads['id']; ?>">Edit</a>
                            <a href="/ads/delete?id=<?= $ads['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../parts/script.template.php'; ?>
</body>
</html>