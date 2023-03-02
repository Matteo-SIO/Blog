<?php


use Blog\Article;

require '../../api/mainloader.php';

requireSession();
$user = getUser();
$role = $user->getRolesObj();
if (!$role || !$role->getCanWrite()) {
    header('Location: ' . url('index.php'));
    exit('NOT_ALLOWED');
}

requirePost('title', 'content');

$article = new Article();
$article->setTitle(post('title'));
$article->setContent(post('content'));
$article->setPublisherObj($user);
$article->save();

header('Location: ' . url('view/view.php?id=' . $article->getId()));