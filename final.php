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
		<link rel="stylesheet" href="/css/gene_search.css">
		<title>Find Your Disease Here</title>
	</head>
	
	<div class="container">
	<body>
		<img id="byline" src="./img/testbanner2.jpg">
		<div id="content">
		<h2>Gene-Disease Association Tool</h2>	
			<p>Through the curbing influences of evolution, the human genome has created endless permutations of itself - sampling small changes which can lead to drastic (or not so drastic) results.  The ~3.2 billion nucleotides that are packed within each cell in our bodies are constantly in flux.  They are added, removed, transformed, and silently corrected throughout the genome.  This variability means that each gene has the potential to mutate and manifest an aberrant phenotype in the form of genetic disease.
			</p>
			<p> With advances in molecular biology and bioinformatics technology, we are now able to accurately track down which changes lead to a given disease phenotype.  This knowledge is constantly being updated and stored in massive data repositories for use in research applications.  Scientists can utilize this information to generate new therapies which may help cure these diseases.  So I ask you...
			</p>   
		<form action="/cgi-bin/gene_search.cgi" method="POST">
			<label for='gene_name'>Which gene are you curious about?</label>
			<input id ='gene_name' name='gene_name' type='text' required="required" 
				placeholder="Input gene symbol (i.e. BRCA1)"
				autofocus='true' autocomplete='off'
				list='geneSymbol'>
			<datalist id='geneSymbol'>
				<?php while($row = mysqli_fetch_array($result)) { ?>
					<option value="<?php echo $row['geneName']; ?>"> <?php echo $row['geneName']; ?></option>
				<?php } ?>
			</datalist>
			<input type='submit' name='submit' value='Associate!'>
		</form>
		<?php mysqli_close($connection); ?>
		</div>
	</body>
	</div>
</html>


