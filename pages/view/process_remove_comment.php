<?php

use Blog\ArticleQuery;
use Blog\CommentQuery;

require '../../api/mainloader.php';
$user = requireSession();

requirePost('id');
$comment = CommentQuery::create()->findOneById(post('id'));
if (!$comment) {
    header('Location: ' . url('index.php'));
    exit('NOT_FOUND');
}

$articleId = $comment->getArticleObj()->getId();

if ($comment->getPublisherObj()->getId() == $user->getId()) {
    $comment->delete();
} else {
    $role = $user->getRolesObj();
    if (!$role || !$role->getCanModerate()) {
        header('Location: ' . url('index.php'));
        exit('NOT_ALLOWED');
    }

    $comment->setDeleted(true);
}

header('Location: ' . url('view/view.php?id=' . $articleId));
exit('OK');