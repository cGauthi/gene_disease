Dissonant Genetics
Created by: Christian Gauthier (cgauthi2@jhu.edu)
Date: April 15, 2017

Purpose:
To create a website in which a user can input a gene of interest and have the server send back basic information on any genetic diseases that are associated with the gene as well as links to further information.  The program will serve a similar (though severely stripped-down) functionality of both the DisGeNET project in Catalonia (www.disgenet.org) as well as the Online Mendelian Inheritance in Man (OMIM) project curated by McKusick-Nathans Institute of Genetic Medicine at Johns Hopkins University. 

Requirements:
This app was created using Python3, mySQL, PHP7.0, HTML5, CSS3, and Git.
Github repository: https://github.com/gautch726/gene_disease
 
Usage:
The code is currently uploaded on the Johns Hopkins University bfx server and can be ran as is at:
http://bfx.eng.jhu.edu/cgauthi2/final/final.php

The user can simply type in a gene of interest and the application will return any diseases that are associated with mutations in that gene.  That's it!  There is a dropdown menu component that will assist users in selecting genes that are present in the database.

Components:
There are four primary components to the application: the gene_disease.sql database, the final.php search page, the gene_search.cgi Python script, and the assoc.html template page.

1) gene_disease.sql
	This is the mySQL database schema that stores all the data that defines the associations between genes and their diseases.  It was downloaded from the disgenet.com website under the Open Database License (see LICENSING.txt).  It contains curated information compiled from UNIPROT, CTD (human subset) ClinVar, Orphanet, and the GWAS Catalog.  It contains 32,855 associations and represents curated data pulled from a multitude of scientific sources.  As a curated list, it is concerned more with accuracy than quantity.  Other sources such as MEDLINE were not included in this database.  It can be loaded into your own mySQL server by utilizing the SOURCE command in sql.

2) final.php
	This is the script that loads the search page.  It's main job is to allow the user to successfully query a gene.  It does this by preloading every distinct gene entry from the database into a dropdown menu that user can then winnow down by inserting text.  Pressing "Enter" or clicking the Associate button will query the server.

3) gene_search.cgi
	This is the Python3 script that will take the posted query data from final.php and pull data out of the database.  It compiles the queried data in a series of variables and transmits it to the assoc.html template page for proper display.

4) assoc.html
	This is the results display page.  It display the queried gene and some basic information about it followed by a table that shows all of its disease associations along with a score that defines the strength of the correletion.  Below are descriptions of each column:
	- Index - the index of the entry.  Simply a count.
	- Score - strength of correlation - Provided by DisGeNET association algorithm
	- Disease - name of the disease
	- Disease ID - UMLD identifier code specifically assigned to that disease by scientific 		community


