<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="/compteurs/delete">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>numero Compteurs</th>
                                <th>Infos</th>
                                <th>Cumuls</th>
                                <th>Etat</th>
                                <th>ACtion</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($compteurs as $cpt) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $cpt->getNumero() ?></td>
                                    <td><?= $cpt->getInfo()?></td>
                                    <td><?= "[".$cpt->getCumul()." - ".$cpt->getLastCumul()."]" ?></td>
                                    <td><?= $cpt->getEtat() ?></td>
                                    <td class="center"><a href="/compteur/consommation?id=<?= $cpt->getNumero() ?>">Consommation</a>&emsp;&emsp;<input type="checkbox" name="compteurs[]" value="<?= $cpt->getNumero() ?>"></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                        <tfoot>
                            <tr>
                            <th>numero Compteurs</th>
                                <th>Infos</th>
                                <th>Cumuls</th>
                                <th>Etat</th>
                                <th>ACtion</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br><br>
                    <button type="submit" class="btn btn-primary pull-right">supprimer compteur</button>
                </form>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>