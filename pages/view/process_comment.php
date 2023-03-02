<?php

use Blog\ArticleQuery;
use Blog\Comment;

require '../../api/mainloader.php';
$user = requireSession();

requirePost('content', 'article_id');
$article = ArticleQuery::create()->findOneById(post('article_id'));
if (!$article) {
    header('Location: ' . url('index.php'));
    exit('NOT_FOUND');
}

$comment = new Comment();
$comment->setContent(post('content'));
$comment->setArticleObj($article);
$comment->setPublisherObj($user);
$comment->save();

header('Location: ' . url('view/view.php?id=' . $article->getId()));
exit('OK');