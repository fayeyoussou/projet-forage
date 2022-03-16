
<div class="module module-login span4 offset4">
	<form class="form-vertical" method="POST" enctype="multipart/form-data">
		<div class="module-head">
			<h3>Changement de Mot de Passe</h3>
		</div>
		<div class="module-body">
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" placeholder="ancien password" name="password[old]" value="<?= isset($user) ? $user->getPrenom() : "" ?>">
				</div>
			</div>
            <div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" placeholder="nouveau password" name="password[new]" value="<?= isset($user) ? $user->getPrenom() : "" ?>">
				</div>
			</div>
            <div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" placeholder="repeat password" name="password[repeat]" value="<?= isset($user) ? $user->getPrenom() : "" ?>">
				</div>
			</div>
            
            <?php 
            if(isset($id)) echo "<input type='hidden' value='$id' name='password[$id]'>";
            if(isset($err)) echo "<h4 class='error' >$err</h4>"; 
            
            ?>
        </div>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-right">Changer</button>
				</div>
			</div>
		</div>
	</form>
</div>