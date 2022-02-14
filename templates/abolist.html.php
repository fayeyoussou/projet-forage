<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="/abonnement/delete">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>numero abonnes</th>
                                <th>Nom abonnes</th>
                                <th>Date abonnement</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($abonnements as $abo) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $abo->getId() ?></td>
                                    <td><?= $abo->getHabitant()->getNom()?></td>
                                    <td><?= $abo->getDateAbo()->format('d F Y')?></td>
                                    <td><?= $abo->getDescription() ?></td>
                                    <td class="center"><a href="/abonnement/manage?id=<?= $abo->getId() ?>">Modifier</a>&emsp;&emsp;<input type="checkbox" name="abonnements[]" value="<?= $abo->getId() ?>"></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>numero abonnes</th>
                                <th>Nom abonnes</th>
                                <th>Date abonnement</th>
                                <th>Description</th>
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