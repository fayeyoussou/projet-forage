
<div class="module module-login span4 offset4">
	<form class="form-vertical" method="POST" enctype="multipart/form-data">
		<div class="module-head">
			<h3>Sign In</h3>
		</div>
		<div class="module-body">

			<div class="control-group">
				<div class="controls row-fluid ">
					<input class="inputstyle" type="file" placeholder="prenom" id="file-image" name="user[image]">
					<label for="file-image">Choisir une image</label>
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" placeholder="prenom" name="user[prenom]" value="<?= isset($user) ? $user->getPrenom() : "" ?>">
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" placeholder="nom" name="user[nom]" value="<?= isset($user) ? $user->getNom() : "" ?>">
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="email" placeholder="email" name="user[email]" value="<?= isset($user) ? $user->getEmail() : "" ?>">
				</div>
			</div>
			<?php if (isset($roles) && $connected==1) { ?>
				<div class="control-group">
					<div class="controls row-fluid">
						<label for="user[role]">Choisir un role</label>
						<select class="span12" name="user[role]">

							<?php foreach ($roles as $role) {
							?>
								<option value="<?= $role->getId() ?>" <?php
																		if (isset($user) && $user->getRole() == $role) {
																			echo "selected";
																		}
																		?>><?= $role->getNom() ?></option>
							<?php } ?>
						</select>
						</input>
					</div>
				</div> <?php }
						?>
			<?php if (isset($user)){?>
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-center btn-link" ><a href="/user/password?id=<?=$user->getId()?>" class="link">Changer mot de passe</a></button>
				</div>
			</div>
				<?php } else {?>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" placeholder="Password" name="user[password]">
				</div>
			</div>
			<?php } ?>

		</div>
		<input type="hidden" value="<?=isset($user)?$user->getId():0?>" name="user[etat]">
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-right"><?= isset($user) ? "modifier" : "creer user" ?></button>
				</div>
			</div>
		</div>
	</form>
</div>