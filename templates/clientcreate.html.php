
<div class="module module-login span4 offset4">
	<form class="form-vertical" method="POST" enctype="multipart/form-data">
		<div class="module-head">
			<h3>Creer Client</h3>
		</div>
		<div class="module-body">
			
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" placeholder="nom du client" name="client[nom]" value="<?= isset($client) ? $client->getNom() : "" ?>">
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="number" placeholder="telephone" name="client[telephone]" value="<?= isset($client) ? $client->getTelephone() : "" ?>">
				</div>
			</div>
            <div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" placeholder="adresse" name="client[adresse]" value="<?= isset($client) ? $client->getAdresse() : "" ?>">
				</div>
			</div>
			
				<div class="control-group">
					<div class="controls row-fluid">
						<label for="client[village]">Village du client</label>
						<select class="span12" name="client[village]" required>

							<?php foreach ($villages as $village) {
							?>
								<option value="<?= $village->getId() ?>" <?php
																		if (isset($client) && $client->getVillage() == $village) {
																			echo "selected";
																		}
																		?>><?= $village->getNom() ?></option>
							<?php } ?>
						</select>
						</input>
					</div>
				</div> 
			
			

		</div>
		<?php if(isset($client)) { ?>
		<input type="hidden" value="<?=isset($client)?$client->getId():0?>" name="client[etat]"> <?php } ?>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-right"><?= isset($client) ? "modifier client" : "creer nouveau client" ?></button>
				</div>
			</div>
		</div>
	</form>
</div>