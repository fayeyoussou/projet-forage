<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des villages</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="/village/delete">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>Nom du village</th>
                                <th>Chef de Village</th>
                                <th>Nombre d'habitant</th>
                                <th>Createur du village</th>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($villages as $village) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $village->getNom() ?></td>
                                    <td><?= $village->getChefVillage() !== null ? $village->getChefVillage()->getNom() : "No chef de village" ?></td>
                                    <td><?= $village->nbrHabitant[0][1] ." Habitant"  ?></td>
                                    <td><?= $village->getUser()->getPrenom() . " " . $village->getUser()->getNom() ?></td>
                                    <td class="center"><a href="/village/manage/<?= $village->getId() ?>">Modifier</a>&emsp;&emsp;<input type="checkbox" name="villages[]" value="<?= $village->getId() ?>"></td>
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
                    <button type="submit" class="btn btn-primary pull-right">supprimer Les villages selectionnes</button>
                </form>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>