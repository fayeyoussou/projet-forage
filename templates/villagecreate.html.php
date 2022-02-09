<div class="module module-login span4 offset4">
	<form class="form-vertical" method="POST" enctype="multipart/form-data">
		<div class="module-head">
			<h3>Creation de village</h3>
		</div>
		<div class="module-body">


			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" placeholder="Nom du village" name="village[nom]" value="<?= isset($village) ? $village->getNom() : "" ?>">
				</div>
			</div>
			<?php if (isset($clients)) { ?>
				<div class="control-group">
					<div class="controls row-fluid">
						<label for="user[role]">Choisir un chef de village</label>
						<select class="span12" name="village[chef]">

							<?php foreach ($clients as $client) { ?>
								<option value="<?= $client->getId() ?>" 
								<?php
									if (isset($village) && $village->getChefVillage() == $client) {
										echo "selected";
										}?>
										><?=$client->getNom() ?></option>
							<?php } ?>
						</select>
						</input>
					</div>
				</div> <?php }
						?>




		</div>
		<?php if (isset($village)) { ?>
			<input type="hidden" value="<?= isset($village) ? $village->getId() : 0 ?>" name="village[etat]"> <?php } ?>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-right"><?= isset($village) ? "modifier Village" : "creer Village" ?></button>
				</div>
			</div>
		</div>
	</form>
</div