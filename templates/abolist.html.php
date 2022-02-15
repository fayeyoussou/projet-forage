<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
                <form class="form-vertical" method="POST" action="<?=$role==''?'/abonnement/delete':'/compteur/assign'?>">
                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                        <thead>
                            <tr>
                                <th>numero abonnes</th>
                                <th>Nom abonnes</th>
                                <th>Date abonnement</th>
                                <th>Description</th>
                                <th><?=$role=''?'Action':'Compteur'?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($abonnements as $abo) {
                            ?>
                                <tr class="gradeA">

                                    <td><?= $abo->getNumero() ?></td>
                                    <td><?= $abo->getHabitant()->getNom()?></td>
                                    <td><?= $abo->getDateAbo()->format('d F Y')?></td>
                                    <td><?= $abo->getDescription() ?></td>
                                    <td class="center"><?php if($role==='') { ?><a href="/abonnement/manage?id=<?= $abo->getNumero() ?>">Modifier</a>&emsp;&emsp;<input type="checkbox" name="abonnements[]" value="<?= $abo->getNumero() ?>"><?php } else if ($abo->getAttribution()===NULL){ ?>
                                        
                                        <select class="span2" name="attributions[<?=$abo->getNumero()?>]">
                                        <option value="nothing">Ne rien Faire</option>
                                            <?php
                                                foreach ($compteurs as $cpt ) { ?>
                                                    <option value="<?= $cpt->getNumero() ?>"><?= $cpt->getNumero()?></option>
                                            <?php    }    ?>                                        
                                            <option value="createnew">Creer</option>
                                        </select>
                                    
                                    <?php } else echo  $abo->getAttribution()->getCompteur()->getNumero() ?>
                                    </td>
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
                    <button type="submit" class="btn btn-primary pull-right"><?=$role=''?'supprimer' : 'attribuer' ?></button>
                </form>
            </div>
        </div>
        <!--/.module-->

        <br />

    </div>
    <!--/.content-->
</div>