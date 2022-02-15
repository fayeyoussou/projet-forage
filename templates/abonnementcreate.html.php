<div class="module module-login span4 offset4">
    <form class="form-vertical" method="POST" enctype="multipart/form-data">
        <div class="module-head">
            <h3>Creation d'abonnement</h3>
        </div>
        <div class="module-body">


            <div class="control-group">
                <div class="controls row-fluid">
                    <input class="span12" type="date" placeholder="Nom du village" name="abonnement[date]" value="<?= isset($abonnement) ? $abonnement->getDateAbo()->format('Y-m-d') : "" ?>">
                </div>
            </div>
            <?php if (isset($clients)) { ?>
                <div class="control-group">
                    <div class="controls row-fluid">
                        <label for="abonnement[client]">Nom de l'abonne</label>
                        <select class="span12" name="abonnement[client]">

                            <?php foreach ($clients as $client) { ?>
                                <option value="<?= $client->getId() ?>" <?php
                                                                        if (isset($abonnement) && $abonnement->getHabitant() == $client) {
                                                                            echo "selected";
                                                                        } ?>><?= $client->getNom() ?></option>
                            <?php } ?>
                        </select>
                        </input>
                    </div>
                </div> <?php }
                        ?>
            <div class="control-group">
                <div class="controls row-fluid">
                    <textarea class="span12" placeholder="Description abonnement" name="abonnement[description]" ><?= isset($abonnement) ? $abonnement->getDescription() : "" ?></textarea>
                    <!-- <textarea class="span12" placeholder="Description abonnement" name="abonnement[description]" value="<?= isset($abonnement) ? $abonnement->getDescription() : "" ?>">
                    <\textarea> -->
                </div>
            </div>



        </div>
        <?php if (isset($abonnement)) { ?>
            <input type="hidden" value="<?= isset($abonnement) ? $abonnement->getNumero() : 0 ?>" name="abonnement[etat]"> <?php } ?>
        <div class="module-foot">
            <div class="control-group">
                <div class="controls clearfix">
                    <button class="btn btn-primary pull-right"><?= isset($abonnement) ? "modifier abonnement" : "creer Abonnement" ?></button>
                </div>
            </div>
        </div>
    </form>
</div