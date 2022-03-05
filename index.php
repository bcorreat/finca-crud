<?php
require_once 'layout/Header.php';
?>
    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3">
                    <a class="active" href="#test1">
                        Fincas
                    </a>
                </li>
                <li class="tab col s3">
                    <a href="#test2">
                        Usuarios
                    </a>
                </li>
            </ul>
        </div>
        <div id="test1" class="col s12">
            <?php require_once 'views/Farm.php'; ?>
        </div>
        <div id="test2" class="col s12">
            <?php require_once 'views/Home.php'; ?>
        </div>
    </div>
<?php
require_once 'layout/Footer.php'
?>