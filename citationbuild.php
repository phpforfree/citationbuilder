<?php
	//Include the functions file
	include ('includes/functions.php');
	
	$style = $_POST['styleholder'];
	$source = $_POST['sourceholder'];
	$medium = $_POST['mediumholder'];
	
	//Creates a citation
	citationcontainstart($style);
		switch ($source) {
				case "book":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						}
					}
					$publicationyearinput = cleanvars($_POST['publicationyearinput']);
					$booktitleinput = cleanvars($_POST['booktitleinput']);
					$publisherlocationinput = cleanvars($_POST['publisherlocationinput']);
					$publisherinput = cleanvars($_POST['publisherinput']);
					if ($medium=="website") {
						$websitetitleinput = cleanvars($_POST['websitetitleinput']);
						$webaccessdateday = cleanvars($_POST['webaccessdateday']);
						$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
						$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
						$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
						$doiwebsiteinput = cleanvars($_POST['doiwebsiteinput']);
					}
					if ($medium=="db") {
						$databaseinput = cleanvars($_POST['databaseinput']);
						$dbaccessdateday = cleanvars($_POST['dbaccessdateday']);
						$dbaccessdatemonth = cleanvars($_POST['dbaccessdatemonth']);
						$dbaccessdateyear = cleanvars($_POST['dbaccessdateyear']);
						$urldbinput = cleanvars($_POST['urldbinput']);
						$doidbinput = cleanvars($_POST['doidbinput']);
					}
					if ($medium=="ebook") {
						$yearpublishedinput = cleanvars($_POST['yearpublishedinput']);
						$mediuminput = cleanvars($_POST['mediuminput']);
						$urlebookinput = cleanvars($_POST['urlebookinput']);
						$doiebookinput = cleanvars($_POST['doiebookinput']);
					}
					
					//Execute the citation
					if ($style=="apa6") {
						apa6bookcite($style, $medium, $contributors, $publicationyearinput, $booktitleinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput, $yearpublishedinput, $mediuminput, $urlebookinput, $doiebookinput);
					}
					if ($style=="mla7") {
						mla7bookcite($style, $medium, $contributors, $publicationyearinput, $booktitleinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput, $yearpublishedinput, $mediuminput, $urlebookinput, $doiebookinput);
					}
				break;
					
				case "bookchapter":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						}
					}
					$publicationyearinput = cleanvars($_POST['publicationyearinput']);
					$chapteressayinput = cleanvars($_POST['chapteressayinput']);
					$booktitleinput = cleanvars($_POST['booktitleinput']);
					$pagesstartinput = cleanvars($_POST['pagesstartinput']);
					$pagesendinput = cleanvars($_POST['pagesendinput']);
					$pagesnonconsecutiveinput = cleanvars($_POST['pagesnonconsecutiveinput']);
					if ($pagesnonconsecutiveinput) {
						$pagesnonconsecutivepagenumsinput = cleanvars($_POST['pagesnonconsecutivepagenumsinput']);
					}
					$publisherlocationinput = cleanvars($_POST['publisherlocationinput']);
					$publisherinput = cleanvars($_POST['publisherinput']);
					if ($medium=="website") {
						$websitetitleinput = cleanvars($_POST['websitetitleinput']);
						$webaccessdateday = cleanvars($_POST['webaccessdateday']);
						$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
						$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
						$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
						$doiwebsiteinput = cleanvars($_POST['doiwebsiteinput']);
					}
					if ($medium=="db") {
						$databaseinput = cleanvars($_POST['databaseinput']);
						$dbaccessdateday = cleanvars($_POST['dbaccessdateday']);
						$dbaccessdatemonth = cleanvars($_POST['dbaccessdatemonth']);
						$dbaccessdateyear = cleanvars($_POST['dbaccessdateyear']);
						$urldbinput = cleanvars($_POST['urldbinput']);
						$doidbinput = cleanvars($_POST['doidbinput']);
					}
					
					//Execute the citation
					if ($style=="apa6") {
						apa6chapteressaycite($style, $medium, $contributors, $publicationyearinput, $chapteressayinput, $booktitleinput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput);
					}
					if ($style=="mla7") {
						mla7chapteressaycite($style, $medium, $contributors, $publicationyearinput, $chapteressayinput, $booktitleinput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput);
					}
				break;
					
				case "magazine":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						}
					}
					$articletitleinput = cleanvars($_POST['articletitleinput']);
					$magazinetitleinput = cleanvars($_POST['magazinetitleinput']);
					$datepublishedday = cleanvars($_POST['datepublishedday']);
					$datepublishedmonth = cleanvars($_POST['datepublishedmonth']);
					$datepublishedyear = cleanvars($_POST['datepublishedyear']);
					if ($medium=="print") {
						$pagesstartinput = cleanvars($_POST['pagesstartinput']);
						$pagesendinput = cleanvars($_POST['pagesendinput']);
						$pagesnonconsecutiveinput = cleanvars($_POST['pagesnonconsecutiveinput']);
						if ($pagesnonconsecutiveinput) {
							$pagesnonconsecutivepagenumsinput = cleanvars($_POST['pagesnonconsecutivepagenumsinput']);
						}
						$printadvancedinfovolume = cleanvars($_POST['printadvancedinfovolume']);
						$printadvancedinfoissue = cleanvars($_POST['printadvancedinfoissue']);
					}
					if ($medium=="website") {
						$websitetitleinput = cleanvars($_POST['websitetitleinput']);
						$websiteadvancedinfovolume = cleanvars($_POST['websiteadvancedinfovolume']);
						$websiteadvancedinfoissue = cleanvars($_POST['websiteadvancedinfoissue']);
						$webpagesstartinput = cleanvars($_POST['webpagesstartinput']);
						$webpagesendinput = cleanvars($_POST['webpagesendinput']);
						$webpagesnonconsecutiveinput = cleanvars($_POST['webpagesnonconsecutiveinput']);
						if ($webpagesnonconsecutiveinput) {
							$webpagesnonconsecutivepagenumsinput = cleanvars($_POST['webpagesnonconsecutivepagenumsinput']);
						}
						$webaccessdateday = cleanvars($_POST['webaccessdateday']);
						$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
						$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
						$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
					}
					if ($medium=="db") {
						$dbpagesstartinput = cleanvars($_POST['dbpagesstartinput']);
						$dbpagesendinput = cleanvars($_POST['dbpagesendinput']);
						$dbpagesnonconsecutiveinput = cleanvars($_POST['dbpagesnonconsecutiveinput']);
						if ($dbpagesnonconsecutiveinput) {
							$dbpagesnonconsecutivepagenumsinput = cleanvars($_POST['dbpagesnonconsecutivepagenumsinput']);
						}
						$dbadvancedinfovolume = cleanvars($_POST['dbadvancedinfovolume']);
						$dbadvancedinfoissue = cleanvars($_POST['dbadvancedinfoissue']);
						$databaseinput = cleanvars($_POST['databaseinput']);
						$dbaccessdateday = cleanvars($_POST['dbaccessdateday']);
						$dbaccessdatemonth = cleanvars($_POST['dbaccessdatemonth']);
						$dbaccessdateyear = cleanvars($_POST['dbaccessdateyear']);
						$urldbinput = cleanvars($_POST['urldbinput']);
					}
					
					//Execute the citation
					if ($style=="apa6") {
						apa6magazinecite($style, $medium, $contributors, $articletitleinput, $magazinetitleinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $printadvancedinfovolume, $printadvancedinfoissue, $websitetitleinput, $webpagesstartinput, $webpagesendinput, $webpagesnonconsecutiveinput, $webpagesnonconsecutivepagenumsinput, $websiteadvancedinfovolume, $websiteadvancedinfoissue, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $dbadvancedinfovolume, $dbadvancedinfoissue, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput);
					}
					if ($style=="mla7") {
						mla7magazinecite($style, $medium, $contributors, $articletitleinput, $magazinetitleinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $printadvancedinfovolume, $printadvancedinfoissue, $websitetitleinput, $webpagesstartinput, $webpagesendinput, $webpagesnonconsecutiveinput, $webpagesnonconsecutivepagenumsinput, $websiteadvancedinfovolume, $websiteadvancedinfoissue, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $dbadvancedinfovolume, $dbadvancedinfoissue, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput);
					}
				break;
					
				case "newspaper":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						} 
					}										
					$articletitleinput = cleanvars($_POST['articletitleinput']);
					$newspapertitleinput = cleanvars($_POST['newspapertitleinput']);
					if ($medium=="print") {
						$newspapercityinput = cleanvars($_POST['newspapercityinput']);
						$datepublishedday = cleanvars($_POST['datepublishedday']);
						$datepublishedmonth = cleanvars($_POST['datepublishedmonth']);
						$datepublishedyear = cleanvars($_POST['datepublishedyear']);
						$editioninput = cleanvars($_POST['editioninput']);
						$sectioninput = cleanvars($_POST['sectioninput']);
						$pagesstartinput = cleanvars($_POST['pagesstartinput']);
						$pagesendinput = cleanvars($_POST['pagesendinput']);
						$pagesnonconsecutiveinput = cleanvars($_POST['pagesnonconsecutiveinput']);
						if ($pagesnonconsecutiveinput) {
							$pagesnonconsecutivepagenumsinput = cleanvars($_POST['pagesnonconsecutivepagenumsinput']);
						}
					}
					if ($medium=="website") {
						$websitetitleinput = cleanvars($_POST['websitetitleinput']);
						$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
						$electronicpublishday = cleanvars($_POST['electronicpublishday']);
						$electronicpublishmonth = cleanvars($_POST['electronicpublishmonth']);
						$electronicpublishyear = cleanvars($_POST['electronicpublishyear']);
						$webaccessdateday = cleanvars($_POST['webaccessdateday']);
						$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
						$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
					}
					if ($medium=="db") {
						$dbnewspapercityinput = cleanvars($_POST['dbnewspapercityinput']);
						$dbdatepublisheddateday = cleanvars($_POST['dbdatepublisheddateday']);
						$dbdatepublisheddatemonth = cleanvars($_POST['dbdatepublisheddatemonth']);
						$dbdatepublisheddateyear = cleanvars($_POST['dbdatepublisheddateyear']);
						$dbeditioninput = cleanvars($_POST['dbeditioninput']);
						$dbpagesstartinput = cleanvars($_POST['dbpagesstartinput']);
						$dbpagesendinput = cleanvars($_POST['dbpagesendinput']);
						$dbpagesnonconsecutiveinput = cleanvars($_POST['dbpagesnonconsecutiveinput']);
						$databaseinput = cleanvars($_POST['databaseinput']);
						$dbaccessdateday = cleanvars($_POST['dbaccessdateday']);
						$dbaccessdatemonth = cleanvars($_POST['dbaccessdatemonth']);
						$dbaccessdateyear = cleanvars($_POST['dbaccessdateyear']);
						$urldbinput = cleanvars($_POST['urldbinput']);
					}
					
					//Execute the citation
					if ($style=="apa6") {
						apa6newspapercite($style, $medium, $contributors, $articletitleinput, $newspapertitleinput, $newspapercityinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $editioninput, $sectioninput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $websitetitleinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $dbnewspapercityinput, $dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear, $dbeditioninput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput);
					}
					if ($style=="mla7") {
						mla7newspapercite($style, $medium, $contributors, $articletitleinput, $newspapertitleinput, $newspapercityinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $editioninput, $sectioninput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $websitetitleinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $dbnewspapercityinput, $dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear, $dbeditioninput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput);
					}
				break;
				
				case "scholar":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						} 
					}
					$yearpublishedinput = cleanvars($_POST['yearpublishedinput']);
					$articletitleinput = cleanvars($_POST['articletitleinput']);
					$journaltitleinput = cleanvars($_POST['journaltitleinput']);
					$volume = cleanvars($_POST['advancedinfovolume']);
					$issue = cleanvars($_POST['advancedinfoissue']);
					$pagesstartinput = cleanvars($_POST['pagesstartinput']);
					$pagesendinput = cleanvars($_POST['pagesendinput']);
					$pagesnonconsecutiveinput = cleanvars($_POST['pagesnonconsecutiveinput']);
					if ($pagesnonconsecutiveinput) {
						$pagesnonconsecutivepagenumsinput = cleanvars($_POST['pagesnonconsecutivepagenumsinput']);
					}
					if ($medium=="website") {
						$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
						$doiwebsiteinput = cleanvars($_POST['doiwebsiteinput']);
						$webaccessdateday = cleanvars($_POST['webaccessdateday']);
						$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
						$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
					}
					if ($medium=="db") {
						$databaseinput = cleanvars($_POST['databaseinput']);
						$dbaccessdateday = cleanvars($_POST['dbaccessdateday']);
						$dbaccessdatemonth = cleanvars($_POST['dbaccessdatemonth']);
						$dbaccessdateyear = cleanvars($_POST['dbaccessdateyear']);
						$urldbinput = cleanvars($_POST['urldbinput']);
						$doidbinput = cleanvars($_POST['doidbinput']);
					}
					
					//Execute the citation
					if ($style=="apa6") {
						apa6scholarjournalcite($style, $medium, $contributors, $yearpublishedinput, $articletitleinput, $journaltitleinput, $volume, $issue, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $urlwebsiteinput, $doiwebsiteinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput);
					}
					if ($style=="mla7") {
						mla7scholarjournalcite($style, $medium, $contributors, $yearpublishedinput, $articletitleinput, $journaltitleinput, $volume, $issue, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $urlwebsiteinput, $doiwebsiteinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput);
					}
				break;
					
				case "website":
					//Clean and load the variables from the form
					$contributors = array();
					$addidvalue = cleanvars($_POST['addidvalue']);
					for ($i = 0; $i < $addidvalue; $i++) {
						$cselect = cleanvars($_POST['contributorselect'.$i]);
						$fname = cleanvars($_POST['contributorfname'.$i]);
						$mi = cleanvars($_POST['contributormi'.$i]);
						$lname = cleanvars($_POST['contributorlname'.$i]);
						
						$addcontributor = array();
						if ($lname) {
							$addcontributor['cselect'] = $cselect;
							$addcontributor['fname'] = $fname;
							$addcontributor['mi'] = $mi;
							$addcontributor['lname'] = $lname;
							$contributors[] = $addcontributor;
						} 
					}
					$articletitleinput = cleanvars($_POST['articletitleinput']);
					$websitetitleinput = cleanvars($_POST['websitetitleinput']);
					$publishersponsorinput = cleanvars($_POST['publishersponsorinput']);
					$urlwebsiteinput = cleanvars($_POST['urlwebsiteinput']);
					$electronicpublishday = cleanvars($_POST['electronicpublishday']);
					$electronicpublishmonth = cleanvars($_POST['electronicpublishmonth']);
					$electronicpublishyear = cleanvars($_POST['electronicpublishyear']);
					$webaccessdateday = cleanvars($_POST['webaccessdateday']);
					$webaccessdatemonth = cleanvars($_POST['webaccessdatemonth']);
					$webaccessdateyear = cleanvars($_POST['webaccessdateyear']);
					
					//Execute the citation
					if ($style=="apa6") {
						apa6websitecite($style, $medium, $contributors, $articletitleinput, $websitetitleinput, $publishersponsorinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear);
					}
					if ($style=="mla7") {
						mla7websitecite($style, $medium, $contributors, $articletitleinput, $websitetitleinput, $publishersponsorinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear);
					}
				break;
			}
	citationcontainend();
	citationcontainend();
?>