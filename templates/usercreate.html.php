<div class="wrapper">
	<div class="container">
		<div class="row">
			<div class="module module-login span4 offset4">
				<form class="form-vertical" method="POST">
					<div class="module-head">
						<h3>Sign In</h3>
					</div>
					<div class="module-body">
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="text" placeholder="prenom" name="user[prenom]">
							</div>
						</div>
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="text" placeholder="nom" name="user[nom]">
							</div>
						</div>
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="email" placeholder="email" name="user[email]">
							</div>
						</div>
						<?php if (isset($roles)) { ?>
						<div class="control-group">
							<div class="controls row-fluid">
							<label for="user[role]">Choisir un role</label>
								<select class="span12" name="user[role]">
									
									<?php foreach ($roles as $role) {
										?>
										<option value="<?=$role->getId()?>"><?=$role->getNom()?></option>
									<?php } ?>
								</select>
								</input>
							</div>
						</div> <?php } ?>
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="password" placeholder="Password" name="user[password]">
							</div>
						</div>

					</div>
					<div class="module-foot">
						<div class="control-group">
							<div class="controls clearfix">
								<button type="submit" class="btn btn-primary pull-right">Login</button>

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--/.wrapper-->
<?php var_dump($test) ?>