<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>numero Facture</th>
                                <th>Numero Compteur</th>
                                <th>Abonnement</th>
                                <th>Montant</th>
                                <th>Choisir</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($factures as $facture) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $facture->getNumero() ?></td>
                                    <td><?= $facture->getConsommation()->getCompteur()->getNumero() ?></td>
                                    <td><?php
                                        $abo = $facture->getConsommation()->getCompteur()->getAttribution()->getAbonnement();
                                        echo $abo->getHabitant()->getNom();
                                        echo "<br>[" . $abo->getNumero() . " ]";
                                        ?></td>
                                    <td><?= $facture->getMontantFacture() ?></td>
                                    <td class="center">
                                        <input type="checkbox" name="factures[]" value="<?= $facture->getNumero() ?>">
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>numero Facture</th>
                                <th>Numero Compteur</th>
                                <th>Abonnement</th>
                                <th>Montant</th>
                                <th>Choisir</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br><br>
                    <button type="submit" class="btn btn-primary pull-right">Generer Les Factures</button>
                </form>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>