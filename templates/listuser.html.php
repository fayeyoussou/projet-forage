<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Liste des utilisateurs</h3>
            </div>
            <div class="module-body table">
            <form class="form-vertical" method="POST" action="/user/delete">
                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                    
                            <?php
                            foreach ($users as $user) {
                            ?>
                                <tr class="gradeA">
                                    
                                    <td><?= $user->getPrenom() ?></td>
                                    <td><?= $user->getNom() ?></td>
                                    <td><?= $user->getEmail() ?></td>
                                    <td><?= $user->getRole()->getNom() ?></td>
                                    <td class="center"><a href="/user/see?id=<?=$user->getId()?>">Voir</a>&emsp;&emsp;<input type="checkbox" name="users[]" value="<?=$user->getId()?>"></td>
                                </tr>
                            <?php } ?>
                            
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
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