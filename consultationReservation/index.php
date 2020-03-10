<?php
include_once "../_gestionBase.inc.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Consultation des reservations</title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	</head>

	<body>
		<main>
			<?php
			$listeReservation = listeReservation();
			foreach ($listeReservation as $reservation):
				$client = jointure($reservation["codeClient"], "personne", "contact", "code");
				$villeDepart = jointure($reservation["codeVilleMiseDispo"], "ville", "nomVille", "codeVille");
				$villeArrive = jointure($reservation["codeVilleRendre"], "ville", "nomVile", "codeVille");
			?><section>
				<p><?php echo $client["contact"] ?></p>
				<p><?php echo $villeDepart["nomVille"] ?></p>
				<p><?php echo $villeArrive["nomVille"] ?></p>
				<p><?php echo $reservation["dateDebutReservation"] ?></p>
				<p><?php echo $reservation["dateFinReservation"] ?></p>
				<p><?php echo $reservation["dateReservation"] ?></p>
				<p><?php echo $reservation["volumeEstime"] ?></p>
			</section>
			<br>

			<?php endforeach; ?>

		</main>
	</body>
</html>