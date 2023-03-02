<?php

use Blog\ArticleQuery;

require '../../api/mainloader.php';

requireSession();

requirePost('id');
$article = ArticleQuery::create()->findOneById(post('id'));
if (!$article) {
    header('Location: ' . url('index.php'));
    exit('NOT_FOUND');
}

if ($article->getPublisherObj()->getId() == getUser()->getId()) {
    // delete comments
    $comments = $article->getComments();
    foreach ($comments as $comment) {
        $comment->delete();
    }
    $article->delete();
} else {
    $role = getUser()->getRolesObj();
    if (!$role || !$role->getCanModerate()) {
        header('Location: ' . url('index.php'));
        exit('NOT_ALLOWED');
    }

    // delete comments
    $comments = $article->getComments();
    foreach ($comments as $comment) {
        $comment->delete();
    }
    $article->setDeleted(true);
}

header('Location: ' . url('index.php'));
exit('OK');