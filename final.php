<?php
// Connect to database
$connection = mysqli_connect("localhost", "cgauthi", "Biologia1!2@", "gene_disease") or die("Error " . mysqli_error($connection));

// Query Data for DB tables
$sql = "SELECT distinct geneName FROM gene_disease";
$result = mysqli_query($connection, $sql) or die ("Error " . mysqli_error($connection));
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<link rel="stylesheet" href="/css/final/css">
		<title>Find Your Disease Here</title>
	</head>
	
	<body>
		<h1>Gene-Disease Association Tool</h1>
		<form action="/cgi-bin/gene_search.cgi" method="POST">
			<label for='gene_name'>Which gene are you curious about?</label>
			<input id ='gene_name' name='gene_name' type='text' list='geneSymbol' autocomplete='off' placeholder='Input gene symbol (i.e. BRCA1)' autofocus id='gene_name'>
			<datalist id='geneSymbol'>
				<?php while($row = mysqli_fetch_array($result)) { ?>
					<option value="<?php echo $row['geneName']; ?>"> <?php echo $row['geneName']; ?></option>
				<?php } ?>
			</datalist>
			<input type='submit' name='submit' value='Associate!'>
		</form>
		<?php mysqli_close($connection); ?>
	</body>
</html>


