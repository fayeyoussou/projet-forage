
<div class="module module-login span4 offset4">
	<form class="form-vertical" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="consommations[compteur]" value="<?=$compteur->getNumero()?>">
		<div class="module-head">
			<h3>Enregistrer Consommations</h3>
		</div>
		<div class="module-body">
			
			<div class="control-group">
				<div class="controls row-fluid">
                    <label for="consommations[newi]">Cumul Actuel : <?= $compteur->getLastCumul() ?></label>
					<input class="span12" id = "cumul" type="number" name="consommations[newi]" value="<?= $compteur->getLastCumul()+1000 ?>" min="<?= $compteur->getLastCumul()+1 ?>">
				</div>
			</div>
		</div>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button class="btn btn-primary pull-right">Valider</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php 
// echo "-----------------".$compteur->getLastCumul()."-----------------";