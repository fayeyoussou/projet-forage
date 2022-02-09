<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>
                    Tous les utilisateurs</h3>
            </div>
            <div class="module-option clearfix">
                <form>
                    <div class="input-append pull-left">
                        <input type="text" class="span3" placeholder="Filter by name...">
                        <button type="submit" class="btn">
                            <i class="icon-search"></i>
                        </button>
                    </div>
                </form>
                <div class="btn-group pull-right" data-toggle="buttons-radio">
                    <button type="button" class="btn">
                        All</button>
                    <button type="button" class="btn">
                        compteur </button>
                    <button type="button" class="btn">
                        clientele</button>
                    <button type="button" class="btn">
                        commercial</button>
                </div>
            </div>
            <form class="form-vertical" method="POST" action="/user/delete">
                <div class="module-body">
                    <?php
                    $i = 0;
                    // echo count($users);
                    foreach ($users as $user) {
                        // echo ($i%2)."/$i";
                        if (($i % 2 == 0)) {
                    ?>
                            <div class="row-fluid">
                            <?php
                        }
                            ?>
                            <div class="span6">
                                <div class="media user">
                                    <a class="media-avatar pull-left" href="#">
                                        <img src="/resources/userimage/user-<?= $user->getId() . '.' . $user->getExtension() ?>">
                                    </a>
                                    <div class="media-body">
                                        <h3 class="media-title">
                                            <?= $user->getPrenom() . " " . $user->getNom() ?>
                                        </h3>
                                        <p>
                                            <small class="muted"><?= $user->getRole()->getNom() ?></small>
                                        </p>
                                        <div class="media-option btn-group shaded-icon">
                                            <button class="btn btn-small">
                                                <input type="checkbox" name="users[]" value="<?= $user->getId() ?>">
                                            </button>
                                            <button class="btn btn-small">
                                                <a href="/user/manage?id=<?= $user->getId() ?>"><i class="icon-edit"></i> edit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        if (($i % 2 == 1) || count($users) == ($i + 1)) {
                            echo "</div>";
                        }
                        $i++;
                    }
                        ?>
                        <!--/.row-fluid-->
                        <br />
                        <div class="pagination pagination-centered">
                            <ul>
                                <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                            </ul>
                        </div>
                            </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">supprimer Les utilisateur Selectionnes</button>
            </form>
        </div>
    </div>