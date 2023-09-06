
<main>

	<div class="acceuil">
		<h2> Vivez sans limite avec la musique </h2>


	</div>

	<div id="container3">
	<h5><?= $messageGenres ?></h5>
	<h5><?= $messageGroupes ?></h5>

	</div>
	
	<h2> TOP-5 des genres les plus représentés</h2>

	<ul class="inside">


	<?php  foreach($top5G as $top5G) { ?>
		<li>
			<?= $top5G['IDGenre'] ?>
		</li>
	<?php } ?>
	</ul> 
	
	<h2> Musiques qui peuvent peut etre vous plaire </h2>

	<ul class="inside">

	<?php  foreach($rand5 as $rand5) { ?>
		<li>
			<?= $rand5['IDC'] ?>
		</li>
	<?php } ?>
	</ul> 




</main>







