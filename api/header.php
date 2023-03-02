<?php
class Header {

    private $title;
    private $description;
    private $css = [];
    private $js = [];

    function setTitle ($title) {
        $this->title = $title;
        return $this;
    }

    function setDescription ($description) {
        $this->description = $description;
        return $this;
    }

    function addCss ($css) {
        $this->css[] = $css;
        return $this;
    }

    function addJs ($js) {
        $this->js[] = $js;
        return $this;
    }

    function render () {
        echo '<head>';
        echo '<title>' . $this->title . '</title>';
        echo '<meta name="description" content="' . $this->description . '">';
        foreach ($this->css as $css) {
            echo '<link rel="stylesheet" href="' . $css . '">';
        }
        foreach ($this->js as $js) {
            echo '<script src="' . $js . '"></script>';
        }
        echo '</head>';
        // head

        $ariane = "<a href='" . url('index.php') . "'>Accueil</a>";

        $user = getUser();
        if ($user) {
            $accountMessage = "<p>Bonjour <b>{$user->getDisplay()}</b></p>";
            $accountMessage .= "<a href='" . url('login/process_logout.php') ."'>Se déconnecter</a>";

            if ($user->getRolesObj()) {
                if ($user->getRolesObj()->getCanAdministrate()) {
                    $ariane .= " | <a href='" . url('admin/admin.php') . "'>Administration</a>";
                }
                if ($user->getRolesObj()->getCanwrite()) {
                    $ariane .= " | <a href='" . url('publisher/publisher.php') . "'>Publier un article</a>";
                }
            }
        } else {
            $accountMessage = "<a href='" . url('login/login.php') ."'>Se connecter</a>";
        }

        echo "
        <header id='header'>
            <div id='header-content'>
                <h1>{$this->title}</h1>
                <h2>{$this->description}</h2>
            </div>
            <div id='header-menu'>
                {$ariane}
                {$accountMessage}
            </div>
        </header>";

    }


}


?>