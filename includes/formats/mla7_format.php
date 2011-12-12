<?php
/****************************************************/
/*     Modern Language Asoociation (MLA) format     */
/****************************************************/

//Format a date published (MLA)
function mlanewspublishdate($datepublishedday, $datepublishedmonth, $datepublishedyear) {
	if (!$datepublishedday && !$datepublishedmonth && !$datepublishedyear) {
		$mlanewspublishdate .= 'n.d';
	}else{
			if (dayshow($datepublishedmonth)==0) {
				$mlanewspublishdate = $datepublishedday . " ";
			}
			$mlanewspublishdate .= shortenmonth($datepublishedmonth) . " ";
			$mlanewspublishdate .= $datepublishedyear;
	}
	return $mlanewspublishdate;
}

//Format an access date for website or database (MLA)
function mlaaccessdate($dateaccessedday, $dateaccessedmonth, $dateaccessedyear) {
		if (dayshow($dateaccessedmonth)==0) {
			$mlaaccessdate = $dateaccessedday . " ";
		}
		$mlaaccessdate .= shortenmonth($dateaccessedmonth) . " ";
		$mlaaccessdate .= $dateaccessedyear;
	return $mlaaccessdate;
}

//Shorten a full month name into an abbreviation (MLA)
function shortenmonth($month) {
	switch($month) {
		case "January":
			$month = "Jan.";
			break;
		case "February":
			$month = "Feb.";
			break;
		case "March":
			$month = "Mar.";
			break;
		case "April":
			$month = "Apr.";
			break;
		case "May":
			$month = "May";
			break;
		case "June":
			$month = "June";
			break;
			case "July":
			$month = "July";
			break;
		case "August":
			$month = "Aug.";
			break;
		case "September":
			$month = "Sept.";
			break;
			case "October":
			$month = "Oct.";
			break;
		case "November":
			$month = "Nov.";
			break;
		case "December":
			$month = "Dec.";
			break;
		}
		return $month;
}

//Ensure that ed. is at the end of edition (MLA)
function editionabbrev($editioninput) { 
	$mlaedition = preg_replace("/edition/", "ed.", $editioninput);
	$mlaedition = preg_replace("/ed/", "ed.", $mlaedition);
	$mlaedition = preg_replace("/ed../", "ed.", $mlaedition);
	if (preg_match("/ed./", $mlaedition)) {
		$mlaedition = $mlaedition;
	}
	elseif ($mlaedition != "") {
		$mlaedition = $mlaedition . " ed.";
	}
	return $mlaedition;
}

//Creates the page number output (MLA)
function mlapagenumbers($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput) {
	if (!$pagesstartinput && !$pagesendinput && !$pagesnonconsecutiveinput) {
		//There are no page numbers
		$html = "N. pag. ";
		return $html;
	}elseif (($pagesstartinput==$pagesendinput) || ($pagesstartinput && !$pagesendinput)) {
		//The article is only on one page
		$html = uppercasewords($pagesstartinput) . ". ";
		return $html;
	}
	if ($pagesstartinput<$pagesendinput && !$pagesnonconsecutiveinput) {
		//There is a consecutive range of pages
		$html = uppercasewords($pagesstartinput) . "-" . uppercasewords($pagesendinput) . ". ";
		return $html;
	}
	if ($pagesnonconsecutiveinput) {
		//There are nonconsecutive pages
		$html = uppercasewords($pagesstartinput) . "+. ";
		return $html;
	}
}

//Format section number for a newspaper citing (MLA)
function mlanewspapersection($sectioninput) {
	if (ctype_alpha($sectioninput)) {
		$html = $sectioninput . ' sec.';
	}else{
		$html = 'sec. ' . $sectioninput;
	}
	return $html;
}

//Format the author/editor names (MLA)
function mlaauthorformat($contributors) {
	$countcontributors = count($contributors);
	//Count the number of authors in the array
	$countauthors = 0;
	//Count the number of editors in the array
	$counteditors = 0;
	foreach ($contributors as $contributor) {
		if ($contributor['cselect']=='author') {
			$countauthors++;
		}elseif($contributor['cselect']=='editor') {
			$counteditors++;
		}
	}
	$html = '';
	for ($i=0; $i<$countcontributors; $i++) {
		if ($contributors[$i]['cselect']=='author') {
		//If this contributor is an author
			if ($i==0) {
				//First time through the loop
				if ($countauthors>1) {
					//There is more than one author
					$html .= uppercasewords($contributors[$i]['lname']);
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The author is a person and not a corporation
						$html .= ', ' . uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '.';
						}
					}
					$html .= ',';
				}else{
					//There is only one author
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The author is not Anonymous or blank
						$html .= uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
							//The author is a person and not a corporation
							$html .= ', ' . uppercasewords($contributors[$i]['fname']);
							if ($contributors[$i]['mi']) {
								$html .= ' ' . uppercasewords($contributors[$i]['mi']);
							}
						}
						$html .= '. ';
					}
				}
			}elseif (($i+1)==$countcontributors) {
				//Last time through the loop
				if ($countauthors>1) {
					//There is more than one author
					$html .= ' and ' . uppercasewords($contributors[$i]['fname']) . ' ';
					if ($contributors[$i]['mi']) {
						$html .= uppercasewords($contributors[$i]['mi']) . '. ';
					}
					$html .= uppercasewords($contributors[$i]['lname']) . '. ';
				}else{
					//There is only one author
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The author is not Anonymous or blank
						$html .= uppercasewords($contributors[$i]['lname']) . ', ';
						$html .= uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']);
						}
						$html .= '. ';
					}
				}
			}else{
				$html .= ' ' . uppercasewords($contributors[$i]['fname']) . ' ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . '. ';
				}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}
		}elseif(($contributors[$i]['cselect']=='editor' && $countauthors==0)) {
		//If this contributor is an editor and there are no authors listed
			if ($i==0) {
				//First time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					$html .= uppercasewords($contributors[$i]['lname']);
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The editor is a person and not a corporation
						$html .= ', ' . uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '.';
						}
					}
					if ($counteditors>2) {
						$html .= ',';
					}
				}else{
					//There is only one editor
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The editor is not Anonymous or blank
						$html .= uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
							//The editor is a person and not a corporation
							$html .= ', ' . uppercasewords($contributors[$i]['fname']);
							if ($contributors[$i]['mi']) {
								$html .= ' ' . uppercasewords($contributors[$i]['mi']);
							}
						}
						$html .= ', ed. ';
					}
				}
			}elseif (($i+1)==$countcontributors) {
				//Last time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					$html .= ' and ' . uppercasewords($contributors[$i]['fname']) . ' ';
					if ($contributors[$i]['mi']) {
						$html .= uppercasewords($contributors[$i]['mi']) . '. ';
					}
					$html .= uppercasewords($contributors[$i]['lname']) . ', eds. ';
				}else{
					//There is only one editor
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The editor is not Anonymous or blank
						$html .= uppercasewords($contributors[$i]['lname']) . ', ';
						$html .= uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']);
						}
						$html .= ', ed. ';
					}
				}
			}else{
				$html .= ' ' . uppercasewords($contributors[$i]['fname']) . ' ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . '. ';
				}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}	
		}
	}
	return $html;
}

//Format the translator names (MLA)
function mlatranslators($contributors) {
	$countcontributors = count($contributors);
	//Count the number of authors in the array
	$countauthors = 0;
	//Count the number of translators in the array
	$counttranslators = 0;
	foreach ($contributors as $contributor) {
		if ($contributor['cselect']=='author') {
			$countauthors++;
		}elseif($contributor['cselect']=='translator') {
			$counttranslators++;
		}
	}
	$html = '';
	//Translator iterative counter
	$t=0;
	for ($i=0; $i<$countcontributors; $i++) {
		if ($contributors[$i]['cselect']=='translator') {
		//If this contributor is an translator
			if ($t==0) {
				//First time through the loop
				if ($counttranslators>1) {
					//There is more than one translator
					$html .= 'Trans. ';
						$html .= uppercasewords($contributors[$i]['fname']) . ' ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . ' ';
						}
					$html .= uppercasewords($contributors[$i]['lname']);
					//If there are more than two translators, add a comma after the name
					if ($countranslators>2) {
						$html .= ',';
					}
				}else{
					//There is only one translator
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The translator is not Anonymous or blank
						$html .= 'Trans. ';
						$html .= uppercasewords($contributors[$i]['fname']) . ' ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . ' ';
						}
						$html .= uppercasewords($contributors[$i]['lname']) . '. ';
					}
				}
			}elseif (($t+1)==$counttranslators) {
				//Last time through the loop
				if ($counttranslators>1) {
					//There is more than one translator
					$html .= ' and ' . uppercasewords($contributors[$i]['fname']) . ' ';
					if ($contributors[$i]['mi']) {
						$html .= uppercasewords($contributors[$i]['mi']) . ' ';
					}
					$html .= uppercasewords($contributors[$i]['lname']) . '. ';
				}else{
					//There is only one translator
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The translator is not Anonymous or blank
						$html .= 'Trans. ';
						$html .= uppercasewords($contributors[$i]['fname']) . ' ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . ' ';
						}
						$html .= uppercasewords($contributors[$i]['lname']) . '. ';
					}
				}
			}else{
				$html .= ' ' . uppercasewords($contributors[$i]['fname']) . ' ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . ' ';
				}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}
			$t++;
		}
	}
	return $html;
}

//Format the editor names, if there is an author (MLA)
function mlaeditors($contributors) {
	$countcontributors = count($contributors);
	//Count the number of authors in the array
	$countauthors = 0;
	//Count the number of editors in the array
	$counteditors = 0;
	foreach ($contributors as $contributor) {
		if ($contributor['cselect']=='author') {
			$countauthors++;
		}elseif($contributor['cselect']=='editor') {
			$counteditors++;
		}
	}
	$html = '';
	//editor iterative counter
	$t=0;
	for ($i=0; $i<$countcontributors; $i++) {
		if (($contributors[$i]['cselect']=='editor')&&($countauthors!=0)) {
		//If this contributor is an editor and there are no authors
			if ($t==0) {
				//First time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					$html .= 'Ed. ';
						$html .= uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . ' ';
						}
					$html .= uppercasewords($contributors[$i]['lname']);
					//If there are more than two editors, add a comma after the name
					if ($counteditors>2) {
						$html .= ',';
					}
				}else{
					//There is only one editor
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The editor is not Anonymous or blank
						$html .= 'Ed. ';
						$html .= uppercasewords($contributors[$i]['fname']) . ' ';
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . ' ';
						}
						$html .= uppercasewords($contributors[$i]['lname']) . '. ';
					}
				}
			}elseif (($t+1)==$counteditors) {
				//Last time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					$html .= ' and ' . uppercasewords($contributors[$i]['fname']) . ' ';
					if ($contributors[$i]['mi']) {
						$html .= uppercasewords($contributors[$i]['mi']) . ' ';
					}
					$html .= uppercasewords($contributors[$i]['lname']) . '. ';
				}else{
					//There is only one editor
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The editor is not Anonymous or blank
						$html .= 'Ed. ';
						$html .= uppercasewords($contributors[$i]['fname']);
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . ' ';
						}
						$html .= uppercasewords($contributors[$i]['lname']) . '. ';
					}
				}
			}else{
				$html .= ' ' . uppercasewords($contributors[$i]['fname']) . ' ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . ' ';
				}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}
			$t++;
		}
	}
	return $html;
}

//Format a scholarly journal year published (MLA)
function mlasjyearpublished($yearpublishedinput) {
	$html = '(' . $yearpublishedinput . '): ';
	return $html;
}

//Format a book title (MLA)
function mlabooktitleformat($booktitleinput, $addpunctuation) {
	//Uppercase the words in book title
	$html = uppercasewords($booktitleinput);
	//Lowercase all articles, prepositions, & conjunctions
	$html = forcearticlelower($html);
	//If the article title contains a subtitle, capitalize the first word after the colon
	if (preg_match('/:[ ]+[a-z]/', $html, $regs)) {
		$html = subtitleucfirst($html, $regs);
	}
	if ($addpunctuation=="yes") {
		//Punctuate after the book title, if necessary
		$html = articleperiod($html);
	}
	$html = '<i>' . $html . '</i>';
	return $html;
}

//Format an eBook medium (MLA)
function mlaebookmediumformat($mediuminput) {
	if (preg_match('/[ ]+file/', $mediuminput, $regs)) {
		//has the word "file" at the end of the string 
		$html = $mediuminput;
	}elseif(!$mediuminput) {
		//the Medium field is blank
		$html = '<i>Digital file</i>';
	}else{
		//does not have the word "file" at the end of the string
		$html = $mediuminput . ' file';
	}
	return $html;
}

/********************************/
/*     Citation parsing         */
/********************************/

//Creates a book citation
function mla7bookcite($style, $medium, $contributors, $publicationyearinput, $booktitleinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput, $yearpublishedinput, $mediuminput, $urlebookinput, $doiebookinput) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the book title (if provided)
	if ($booktitleinput) {
		$html .= mlabooktitleformat($booktitleinput, "yes") . ' ';
	}
	//Add the translators (if no authors)
	$html .= mlatranslators($contributors);
	//Add the editors (if no authors)
	$html .= mlaeditors($contributors);
	//Add the publisher location (if provided)
	if ($publisherlocationinput) {
		$html .= uppercasewords($publisherlocationinput) . ': ';
	}
	//Add the publisher (if provided)
	if ($publisherinput) {
		$html .= uppercasewords($publisherinput) . ', ';
	}
	//Add the publication year (if provided)
	if ($publicationyearinput) {
		$html .= $publicationyearinput . '. ';
	}
	//in print
		if ($medium=="print") {
			//Add the medium
			$html .= 'Print.';
		}
	//on a website
		if ($medium=="website") {
			//Add the title of the website (if provided)
			if ($websitetitleinput) {
				$html .= '<i>' . uppercasewords($websitetitleinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
				$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlwebsiteinput);
				$html .= '&#62;';
				$html .= '. ';
			}
			
		}
	//in a database
		if ($medium=="db") {
			//Add the database title (if provided)
			if ($databaseinput) {
				$html .= '<i>' . uppercasewords($databaseinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($dbaccessdateday || $dbaccessdatemonth || $dbaccessdateyear) {
				$html .= mlaaccessdate($dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urldbinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	//as a digital file
		if ($medium=="ebook") {
			//Add the Medium
			$html .= mlaebookmediumformat($mediuminput) . '. ';
			//Add the URL (if provided)
			if ($urlebookinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlebookinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	echo $html;
}

//Creates a chapter or essay from a book citation
function mla7chapteressaycite($style, $medium, $contributors, $publicationyearinput, $chapteressayinput, $booktitleinput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the translators (if no authors)
	$html .= mlatranslators($contributors);
	//Add the chapter/essay title (if provided)
	if ($chapteressayinput) {
		//Uppercase all words in chapter/essay title, lowercase all articles, prepositions, & conjunctions, append a period, and encapsulate in double quotes
		$chapteressayinput = uppercasewords($chapteressayinput);
		$chapteressayinput = forcearticlelower($chapteressayinput);
		$chapteressayinput = articleperiod($chapteressayinput);
		$html .= '"' . $chapteressayinput . '" ';
	}
	//Add the book title (if provided)
	if ($booktitleinput) {
		$html .= mlabooktitleformat($booktitleinput, "yes") . ' ';
	}
	//Add the translators (if no authors)
	$html .= mlatranslators($contributors);
	//Add the editors (if no authors)
	$html .= mlaeditors($contributors);
	//Add the publisher location (if provided)
	if ($publisherlocationinput) {
		$html .= uppercasewords($publisherlocationinput) . ': ';
	}
	//Add the publisher (if provided)
	if ($publisherinput) {
		$html .= uppercasewords($publisherinput) . ', ';
	}
	//Add the publication year (if provided)
	if ($publicationyearinput) {
		$html .= $publicationyearinput . '. ';
	}
	//Add the page numbers
	$html .= mlapagenumbers($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput);
	//in print
		if ($medium=="print") {
			//Add the medium
			$html .= 'Print.';
		}
	//on a website
		if ($medium=="website") {
			//Add the title of the website (if provided)
			if ($websitetitleinput) {
				$html .= '<i>' . uppercasewords($websitetitleinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
				$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlwebsiteinput);
				$html .= '&#62;';
				$html .= '. ';
			}
			
		}
	//in a database
		if ($medium=="db") {
			//Add the database title (if provided)
			if ($databaseinput) {
				$html .= '<i>' . uppercasewords($databaseinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($dbaccessdateday || $dbaccessdatemonth || $dbaccessdateyear) {
				$html .= mlaaccessdate($dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urldbinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}		
	echo $html;
}

//Creates a magazine article citation
function mla7magazinecite($style, $medium, $contributors, $articletitleinput, $magazinetitleinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $printadvancedinfovolume, $printadvancedinfoissue, $websitetitleinput, $webpagesstartinput, $webpagesendinput, $webpagesnonconsecutiveinput, $webpagesnonconsecutivepagenumsinput, $websiteadvancedinfovolume, $websiteadvancedinfoissue, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $dbadvancedinfovolume, $dbadvancedinfoissue, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the article title (if provided)
	if ($articletitleinput) {
		//Uppercase all words in article title, lowercase all art., prep., & conj., append a period, and encapsulate in double quotes
		$articletitle = uppercasewords($articletitleinput);
		$articletitle = forcearticlelower($articletitle);
		$articletitle = articleperiod($articletitle);
		$html .= '"' . $articletitle . '" ';
	}
	//in print
		if ($medium=="print") {
			//Add the magazine title (if provided)
			if ($magazinetitleinput) {
				$magtitleholder = uppercasewords($magazinetitleinput);
				$html .= '<i>' . forcearticlelower($magtitleholder) . '</i>' . ' ';
			}
			//Add the date published (if provided)
			if ($datepublishedday || $datepublishedmonth || $datepublishedyear) {
				$html .= mlanewspublishdate($datepublishedday, $datepublishedmonth, $datepublishedyear);
				//Add a colon
				$html .= ': ';
			}
			//Add the page numbers
			$html .= mlapagenumbers($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput);
			//Add the medium
			$html .= 'Print.';
		}
	//on website
		if ($medium=="website") {
			//Add the website publisher/sponsor (if provided)
			if ($magazinetitleinput) {
				$html .= '<i>' . uppercasewords($magazinetitleinput) . '</i>' . '. ';
			}else{
				$html .= 'N.p., ';
			}
			//Add the website title (if provided)
			if ($websitetitleinput) {
				$html .= uppercasewords($websitetitleinput) . ', ';
			}
			//Add the date published (if provided)
			$html .= mlanewspublishdate($datepublishedday, $datepublishedmonth, $datepublishedyear);
			//Add a period
			$html .= '. ';
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
				$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlwebsiteinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the magazine title (if provided)
			if ($magazinetitleinput) {
				$magtitleholder = uppercasewords($magazinetitleinput);
				$html .= '<i>' . forcearticlelower($magtitleholder) . '</i>' . ' ';
			}
			//Add the date published (if provided)
			$html .= mlanewspublishdate($datepublishedday, $datepublishedmonth, $datepublishedyear);
			//Add a period
			$html .= '. ';
			//Add the page numbers
			$html .= mlapagenumbers($dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput);
			//Add the database title (if provided)
			if ($databaseinput) {
				$html .= '<i>' . uppercasewords($databaseinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($dbaccessdateday || $dbaccessdatemonth || $dbaccessdateyear) {
				$html .= mlaaccessdate($dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urldbinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	echo $html;
}

//Creates a newspaper article citation
function mla7newspapercite($style, $medium, $contributors, $articletitleinput, $newspapertitleinput, $newspapercityinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $editioninput, $sectioninput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $websitetitleinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $dbnewspapercityinput, $dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear, $dbeditioninput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the article title (if provided)
	if ($articletitleinput) {
		//Uppercase all words in article title, lowercase all art., prep., & conj., append a period, and encapsulate in double quotes
		$articletitle = uppercasewords($articletitleinput);
		$articletitle = forcearticlelower($articletitle);
		$articletitle = articleperiod($articletitle);
		$html .= '"' . $articletitle . '" ';
	}
	//in print
		if ($medium=="print") {
			//Add the newspaper title (if provided)
			if ($newspapertitleinput) {
				//Uppercase all words in a newspaper's title
				$newspapertitleinput = uppercasewords($newspapertitleinput);
				//Remove articles (A, An, The) before the newspaper title 
				$newspapertitleinput = removearticle($newspapertitleinput);
				$html .= '<i>' . $newspapertitleinput . '</i>' . ' ';
			}
			//Add the newspaper city (if provided)
			if ($newspapercityinput) {
				$html .= '[' . uppercasewords($newspapercityinput) . ']' . ' ';
			}
			//Add the date published (if provided)
			if ($datepublishedday || $datepublishedmonth || $datepublishedyear) {
				$html .= mlanewspublishdate($datepublishedday, $datepublishedmonth, $datepublishedyear);
			}
			//Add the edition (if provided)
			if ($editioninput) {
				$editioninput = lowercasewords($editioninput);
				$html .= ', ' . editionabbrev($editioninput);
			}
			//Add the section (if provided)
			if ($sectioninput) {
				$html .= ', ' . mlanewspapersection($sectioninput);
			}
			//Add a colon
			$html .= ': ';
			//Add the page numbers
			$html .= mlapagenumbers($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput);
			//Add the medium
			$html .= 'Print.';
		}
	//on a website
		if ($medium=="website") {
			//Add the web site title (if provided)
			if ($websitetitleinput) {
				$html .= '<i>' . uppercasewords($websitetitleinput) . '</i>' . '. ';
			}
			//Add the newspaper title (if provided)
			if ($newspapertitleinput) {
				//Uppercase all words in a newspaper's title
				$newspapertitleinput = uppercasewords($newspapertitleinput);
				//Remove articles (A, An, The) before the newspaper title 
				$newspapertitleinput = removearticle($newspapertitleinput);
				$html .= '<i>' . $newspapertitleinput . '</i>' . ', ';
			}
			//Add the electronically published date (if provided)
			if ($electronicpublishday || $electronicpublishmonth || $electronicpublishyear) {
				$html .= mlanewspublishdate($electronicpublishday, $electronicpublishmonth, $electronicpublishyear) . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided) 
			if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
				$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlwebsiteinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the newspaper title (if provided)
			if ($newspapertitleinput) {
				//Uppercase all words in a newspaper's title
				$newspapertitleinput = uppercasewords($newspapertitleinput);
				//Remove articles (A, An, The) before the newspaper title 
				$newspapertitleinput = removearticle($newspapertitleinput);
				$html .= '<i>' . $newspapertitleinput . '</i>' . ' ';
			}
			//Add the newspaper city (if provided)
			if ($dbnewspapercityinput) {
				$html .= '[' . uppercasewords($dbnewspapercityinput) . ']' . ' ';
			}
			//Add the date published (if provided)
			if ($dbdatepublisheddateday || $dbdatepublisheddatemonth || $dbdatepublisheddateyear) {
				$html .= mlanewspublishdate($dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear);
			}
			//Add the edition (if provided)
			if ($dbeditioninput) {
				$dbeditioninput = lowercasewords($dbeditioninput);
				$html .= ', ' . editionabbrev($dbeditioninput);
			}			
			//Add a colon
			$html .= ': ';
			//Add the page numbers
			$html .= mlapagenumbers($dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput);
			//Add the database title (if provided)
			if ($databaseinput) {
				$html .= '<i>' . uppercasewords($databaseinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date
			$html .= mlaaccessdate($dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear) . '. ';
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urldbinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	echo $html;
}

//Creates a scholarly journal article citation
function mla7scholarjournalcite($style, $medium, $contributors, $yearpublishedinput, $articletitleinput, $journaltitleinput, $volume, $issue, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $urlwebsiteinput, $doiwebsiteinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the article title (if provided)
	if ($articletitleinput) {
		//Uppercase all words in article title, lowercase all art., prep., & conj., append a period, and encapsulate in double quotes
		$articletitle = uppercasewords($articletitleinput);
		$articletitle = forcearticlelower($articletitle);
		$articletitle = articleperiod($articletitle);
		$html .= '"' . $articletitle . '" ';
	}
	//Add the journal title (if provided)
	if ($journaltitleinput) {
		$journaltitleholder = uppercasewords($journaltitleinput);
		$html .= '<i>' . forcearticlelower($journaltitleholder) . ' </i>';
	}
	//Add the volume number (if provided)
	if ($volume) {
		$html .= $volume;
	}
	//Add the issue number (if provided)
	if ($issue) {
		$html .= '.' . $issue . ' ';
	}
	//Add the date published (if provided)
	if ($yearpublishedinput) {
		$html .= mlasjyearpublished($yearpublishedinput);
	}
	//Add the page numbers
	$html .= mlapagenumbers($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput);
	//in print
		if ($medium=="print") {
			//Add the medium
			$html .= 'Print.';
		}
	//on a website
		if ($medium=="website") {
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
				$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urlwebsiteinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the database title (if provided)
			if ($databaseinput) {
				$html .= '<i>' . uppercasewords($databaseinput) . '</i>' . '. ';
			}
			//Add the medium
			$html .= 'Web. ';
			//Add the access date (if provided)
			if ($dbaccessdateday || $dbaccessdatemonth || $dbaccessdateyear) {
				$html .= mlaaccessdate($dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear) . '. ';
			}
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= '&#60;';
				$html .= checkurlprepend($urldbinput);
				$html .= '&#62;';
				$html .= '. ';
			}
		}
	echo $html;
}

//Creates a web site citation
function mla7websitecite($style, $medium, $contributors, $articletitleinput, $websitetitleinput, $publishersponsorinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear) {
	//Add the contributors
	$html = mlaauthorformat($contributors);
	//Add the article title (if provided)
	if ($articletitleinput) {
		//Uppercase all words in article title, lowercase all art., prep., & conj., append a period, and encapsulate in double quotes
		$articletitle = uppercasewords($articletitleinput);
		$articletitle = forcearticlelower($articletitle);
		$articletitle = articleperiod($articletitle);
		$html .= '"' . $articletitle . '" ';
	}
	//Add the web site title (if provided)
	if ($websitetitleinput) {
		$html .= '<i>' . uppercasewords($websitetitleinput) . '</i>' . '. ';
	}
	//Add the web site publisher/sponsor (if provided)
	if ($publishersponsorinput) {
		$html .= uppercasewords($publishersponsorinput) . ', ';
	}else{
		$html .= 'N.p., ';
	}
	//Add the electronically published date (if provided)
	$html .= mlanewspublishdate($electronicpublishday, $electronicpublishmonth, $electronicpublishyear);
	//Add a period
	$html .= '. ';
	//Add the medium
	$html .= 'Web. ';
	//Add the access date (if provided)
	if ($webaccessdateday || $webaccessdatemonth || $webaccessdateyear) {
		$html .= mlaaccessdate($webaccessdateday, $webaccessdatemonth, $webaccessdateyear) . '. ';
	}
	//Add the URL (if provided)
	if ($urlwebsiteinput) {
		$html .= '&#60;';
		$html .= checkurlprepend($urlwebsiteinput);
		$html .= '&#62;';
		$html .= '. ';
	}
	echo $html;
}
?>