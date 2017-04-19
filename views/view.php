<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <link href="../web/alaska.css" rel="stylesheet" />
    <title>Un Ticket pour l'Alaska - Home</title>
</head>
<body>
    <header>
        <h1>Un ticket pour l'Alaska</h1>
    </header>
    <?php
    foreach ($articles as $article): ?>
        <article>
            <h2><?php echo $article->getTitle() ?></h2>
            <p><?php echo $article->getContent() ?></p>
        </article>
    <?php endforeach ?>
<footer class="footer">
    <a href="https://github.com/bpesquet/OC-MicroCMS">MicroCMS</a> is a minimalistic CMS built as a showcase for modern PHP development.
</footer>
</body>
</html>