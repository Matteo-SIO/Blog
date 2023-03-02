<?php

require '../../api/mainloader.php';

requireSession();
$user = getUser();
$role = $user->getRolesObj();
if (!$role || !$role->getCanwrite()) {
    header('Location: ' . url('index.php'));
    exit('NOT_ALLOWED');
}

$header = new Header();
$header->setTitle("Rédaction");
$header->setDescription("Chaque lapin a quelque chose à réconter !");
$header->addCss('../assets/css/style.css');
$header->render();

?>

<div class="block boxed" id="publish-block">
    <h3>Écrire un article</h3>
    <form method="post" action="<?php echo url('publisher/process_article.php'); ?>">
        <div id="publishTitle" class="blockMember">
            <input type="text" name="title" size="60" placeholder="Titre de l'article" required />
        </div>
        <div id="publishContent" class="blockMember">
            <textarea name="content" rows="10" cols="80" placeholder="Contenu de l'article" required></textarea>
        </div>
        <div id="publishSubmit" class="blockMember">
            <input type="submit" value="Publier">
        </div>
    </form>
</div>
