<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module">
                <div class="module-head">
                    <h3>Verifier Et Valider Reglement</h3>
                </div>
                <div class="module-body">
                    <form action="/reglement/print" method="POST" class="form-horizontal row-fluid">
                        <div class="control-group">
                            <label class="control-label">Factures A Regler </label>
                            <div class="controls">
                                <?php
                                foreach ($factures as $facture) {
                                ?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="factures[<?= $facture->getNumero() ?>]" value="<?= $facture->getMontantFacture() ?>" checked>
                                        <?= "Numero : " . $facture->getNumero() . " (" . $facture->getMontantFacture() . " frs CFA)" ?>
                                    </label>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="basicinput">Sommes Total</label>
                            <div class="controls">
                                <input type="text" id="basicinput" placeholder="<?=$somme?>" class="span8" disabled>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">valider</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>