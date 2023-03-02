<?php

use Blog\ArticleQuery;

require '../api/mainloader.php';

$header = new Header();
$header->setTitle(TITLE);
$header->setDescription(DESCRIPTION);
$header->addCss('../assets/css/style.css');
$header->render();
?>

<div class="wrapper block">

    <?php
        // show 10 last articles
        $articles = ArticleQuery::create()
            ->orderByCreatedAt('desc')
            ->limit(10)
            ->find();

        foreach ($articles as $article) {
            $title = $article->getTitle();
            $content = $article->getContent();
            $max = 100;
            $content = (strlen($content) > $max) ? substr($content,0,$max-3).'...' : $content;

            ?>

            <div class="wrappedArticle boxed">
                <h3><?php echo $title; ?></h3>
                <p><?php echo $content; ?></p>
                <a href="<?php echo url('view/view.php?id=' . $article->getId()); ?>">Voir l'article</a>
            </div>

            <?php
        }

    ?>

</div>

