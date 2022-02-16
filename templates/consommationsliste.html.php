<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Gestion consommations :</h3>
                <?= $toAdd ? '<h3>Consommation a enregistrer cliquez <a href="/consommation/add?id=' . $compteur->getNumero() . '">ici</a> pour enregistrer la consommation pour ce mois</h3>' : '' ?>
            </div>

            <div class="module-body table">
                <?php
                $consommations = $compteur->getConsommations();
                if (count($consommations) > 0) { ?>
                    <form class="form-vertical" method="POST" action="/facture/generate">
                        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                            <thead>
                                <tr>
                                    <th>Periode </th>
                                    <th>Numero Compteur</th>
                                    <th>Numero Abonnement</th>
                                    <th>Quantite Consommation</th>
                                    <th>Facture</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($consommations as $consommation) {
                                ?>
                                    <tr class="gradeA">

                                        <td><?= $consommation->getPeriode() ?></td>
                                        <td><?= $consommation->getCompteur()->getNumero() ?></td>
                                        <td><?= $consommation->getCompteur()->getAttribution()->getAbonnement()->getNumero() ?></td>
                                        <td><?= $consommation->getQuantite() ?></td>
                                        <td class="center">
                                            <?php
                                            if ($consommation->getFacture() ===NULL) { ?>
                                                <input type="checkbox" name="consommations[]" value="<?= $consommation->getId() ?>"> 
                                                <?php 
                                            } 
                                            else 
                                                $consommation->getFacture()->getNumero();
                                                ?>
                                        </td>
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
                        <button type="submit" class="btn btn-primary pull-right">generer les factures</button>
                    </form>
                <?php } else echo "<h3>Ce compteur na pas engistre de consommations</h3>"; ?>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>