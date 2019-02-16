<?php 
	ini_set('display_errors', 1);
	error_reporting(E_ALL|E_STRICT);
    //<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/css/template.css' ?>" />
        <link rel="stylesheet" href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/css/gallery.css' ?>" />
        <link rel="stylesheet" href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/css/montage.css' ?>" />
        <link rel="icon" type="image/png" href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/images/favicon.ico' ?>" sizes="32x32" />
        
        
        <script src="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/js/template.js' ?>"></script>
        <script src="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/public/js/ajax/getXHR.js' ?>"></script>

        <title><?= $title ?></title>
    </head>
        
    <body>
        <nav id="nav">
            <ul>
                <li><i class="fab fa-cuttlefish" id="logo"></i></li>

                <li><a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/index.php' ?>"><i class="fas fa-home"></i></a></li>
                <li><a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/gallery.php' ?>" ><i class="far fa-images"></i></a></li>
                
                <?php 
                    if (isset($_SESSION['login']) && !empty($_SESSION['login']))
                    {
                ?>
                        <li><a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/montage.php' ?>" ><i class="fas fa-camera-retro"></i></a></li>
                        <li>
                            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/manage.php' ?>">
                                <i class="far fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <form id="logout" method="POST" action="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/controllers/session.php' ?>">
                                <a href="#" onclick="document.getElementById('logout').submit();return false;">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <input type="hidden" name="logout" value="logout">
                            </form>
                        </li>
                <?php
                    }
                    else
                    {
                ?>
                        <li><a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/montageGuest.php' ?>" ><i class="fas fa-camera-retro"></i></a></li>
                        <li>
                            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/inscription.php' ?>">
                                <i class="fas fa-file-alt"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?= '//' . $_SERVER['HTTP_HOST'] . '/camagru/views/connexion.php' ?>">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </nav>
        <div id="main-page">
            <header id="header">
                <p>Camagru</p>
            </header>
            <section id="content">
                <?= $content ?>
            </section>
            <div id="footer">
                <div class="copyright"> &copy; Camagru 2019</div>
            </div>
        </div>
    </body>
</html>