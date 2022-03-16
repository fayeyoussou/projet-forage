<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="/client/delete">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>Nom du Client</th>
                                <th>Adresse du client</th>
                                <th>Village du client</th>
                                <th>Createur du client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($clients as $client) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $client->getNom() ?></td>
                                    <td><?= $client->getAdresse()?></td>
                                    <td><?= $client->getVillage()->getNom()?></td>
                                    <td><?= $client->getUser()->getPrenom() . " " . $client->getUser()->getNom() ?></td>
                                    <td class="center"><a href="/client/manage/<?= $client->getId() ?>">Modifier</a>&emsp;&emsp;<a href="/abonnement/list/<?= $client->getId() ?>">Abonnement</a>&emsp;&emsp;<input type="checkbox" name="clients[]" value="<?= $client->getId() ?>"></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom du village</th>
                                <th>Chef de Village</th>
                                <th>Nombre d'habitant</th>
                                <th>Createur du village</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br><br>
                    <button type="submit" class="btn btn-primary pull-right">supprimer Les utilisateur Selectionnes</button>
                </form>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>