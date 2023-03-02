<?php

use Blog\ArticleQuery;

require '../../api/mainloader.php';

requireGet('id');

$article = ArticleQuery::create()->findOneById(get('id'));
if (!$article) {
    header('Location: ' . url('index.php'));
    exit('NOT_FOUND');
}

$header = new Header();
$header->setTitle('Article');
$header->addCss('../assets/css/style.css');
$header->render();

?>

<div class="block boxed" id="view-block">
    <div class="blockMember" id="viewTitle-block">
        <h3><?php echo $article->getTitle(); ?></h3>
    </div>
    <div class="blockMember" id="viewContent-block">
        <?php echo $article->getContent(); ?>
    </div>
</div>


<?php
if (isLogged()) {
    $user = getUser();
    $role = $user->getRolesObj();
    if ($role && $role->getCanModerate()) {

        ?>
        <div class="block boxed" id="view-remove">
            <div class="blockMember">
                <form method="post" action="<?php echo url('view/process_remove.php'); ?>">
                    <input type="hidden" name="id" value="<?php echo $article->getId(); ?>">
                    <input type="submit" value="Supprimer l'article">
                </form>
            </div>
        </div>
        <?php

    }
}
?>

<div class="block boxed" id="view-comments">
    <div class="blockMember" id="view-comments-title">
        <h3>Commentaires</h3>
    </div>
    <div class="blockMember" id="view-comments-list">
        <?php
        $comments = $article->getComments();
        foreach ($comments as $comment) {
            ?>
            <div class="comment boxed">
                <div class="comment-header">
                    <div class="comment-author">

                        <?php
                        if ($comment->getPublisherObj()->getRolesObj()) {
                            echo "[" .$comment->getPublisherObj()->getRolesObj()->getDisplay() ."] ";
                        }
                        ?>

                        <u><?php echo $comment->getPublisherObj()->getDisplay(); ?></u>
                    </div>
                </div>
                <div class="comment-content">
                    <?php echo $comment->getContent(); ?>
                </div>

                <?php
                if (isLogged()) {
                    $user = getUser();
                    $role = $user->getRolesObj();
                    if ($role && $role->getCanModerate()) {
                        ?>
                        <div class="comment-remove">
                            <form method="post" action="<?php echo url('view/process_remove_comment.php'); ?>">
                                <input type="hidden" name="id" value="<?php echo $comment->getId(); ?>">
                                <input type="submit" value="Supprimer le commentaire">
                            </form>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <?php
        }
        ?>
    </div>

    <?php
    if (isLogged()) {
    ?>
        <div class="block" id="view-comments-form">
            <form method="post" action="<?php echo url('view/process_comment.php'); ?>">
                <input type="hidden" name="article_id" value="<?php echo $article->getId(); ?>">
                <div class="blockMember">
                    <textarea name="content" placeholder="Votre commentaire" required></textarea>
                </div>
                <div class="blockMember">
                    <input type="submit" value="Commenter">
                </div>
            </form>
        </div>
    <?php
    }
    ?>
</div>


