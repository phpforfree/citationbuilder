<?php
/**********************************************************/
/*     American Psychological Association (APA) format    */
/**********************************************************/

//Format a date published (APA)
function apamagnewsdate($datepublishedday, $datepublishedmonth, $datepublishedyear) {
	if (!$datepublishedday && !$datepublishedmonth && !$datepublishedyear) {
		$apamagnewsdate = '(n.d.)';
	}else{
			$apamagnewsdate = '(' . $datepublishedyear . ', ' . $datepublishedmonth;
			if ($datepublishedday) {
				$apamagnewsdate .= ' ' . $datepublishedday;
			}
			$apamagnewsdate .= ')';
		}
	return $apamagnewsdate;
}

//Format page numbers for a newspaper citing (APA)
function apanewspaperpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput) {
	if (($pagesstartinput==$pagesendinput || $pagesstartinput && !$pagesendinput) && ($pagesstartinput && !$pagesnonconsecutiveinput)) {
		//if start page equals end page or there is a start page, but no end page
		$html = 'p. ' . uppercasewords($pagesstartinput);
		return $html;
	}
	if ($pagesstartinput<$pagesendinput && !$pagesnonconsecutiveinput) {
		//if start page is less than end page and the pages are consecutive
		$html = 'pp. ' . uppercasewords($pagesstartinput) . "-" . uppercasewords($pagesendinput);
		return $html;
	}
	if ($pagesnonconsecutiveinput && $pagesnonconsecutivepagenumsinput) {
		//if the pages are not consecutive and there are page numbers to display
		$html = 'pp. ' . $pagesnonconsecutivepagenumsinput;
		return $html;
	}
}

//Format page numbers for a scholarly journal citing (APA)
function apascholarjournalpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput) {
	if (($pagesstartinput==$pagesendinput || $pagesstartinput && !$pagesendinput) && ($pagesstartinput && !$pagesnonconsecutiveinput)) {
		//if start page equals end page or there is a start page, but no end page
		$html = uppercasewords($pagesstartinput);
		return $html;
	}
	if ($pagesstartinput<$pagesendinput && !$pagesnonconsecutiveinput) {
		//if start page is less than end page and the pages are consecutive
		$html = uppercasewords($pagesstartinput) . "-" . uppercasewords($pagesendinput);
		return $html;
	}
	if ($pagesnonconsecutiveinput && $pagesnonconsecutivepagenumsinput) {
		//if the pages are not consecutive and there are page numbers to display
		$html = $pagesnonconsecutivepagenumsinput;
		return $html;
	}
}

//Format the author names (APA)
function apaauthorformat($contributors) {
	//Count the number of contributors in the array
	$countcontributors = count($contributors);
	//Count the number of authors in the array
	$countauthors = 0;
	foreach ($contributors as $contributor) {
		if ($contributor['cselect']=='author') {
			$countauthors++;
		}
	}
	$html = '';
	for ($i=0; $i<$countcontributors; $i++) {
		//If this contributor is an author
		if ($contributors[$i]['cselect']=='author') {
			if ($i==0) {
				//First time through the loop
				if ($countauthors>1) {
					//There is more than one author
					$html .= uppercasewords($contributors[$i]['lname']);
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
					//The author is a person and not a corporation
						//Check for a hyphen in the first name
						$hyphentest = stripos($contributors[$i]['fname'], '-');
						if ($hyphentest!=false) {
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
						}else{
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '., ';
						}else{
							$html .= ', ';
						}
					}else{
						//The author is a corporation and not a person
						$html .= ', ';
					}
				}else{
					//There is only one author
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The author is not Anonymous or blank
						$html .= uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The author is a person and not a corporation
							//Check for a hyphen in the first name
							$hyphentest = stripos($contributors[$i]['fname'], '-');
							if ($hyphentest!=false) {
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
							}else{
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '. ';
							}
							if ($contributors[$i]['mi']) {
								$html .= uppercasewords($contributors[$i]['mi']) . '. ';
							}
						}else{
							//The author is a corporation and not a person
							$html .= '. ';
						}
					}
				}
			}elseif ($i>=5) {
				//Sixth or more time through the loop
				if ($countauthors>7 && $i==5) {
					//There are more than 7 authors and this is the sixth time through the loop
					$html .= ' ' . uppercasewords($contributors[$i]['lname']) . ', ';
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The author is a person and not a corporation
						//Check for a hyphen in the first name
						$hyphentest = stripos($contributors[$i]['fname'], '-');
						if ($hyphentest!=false) {
							$html .= firstinitial($contributors[$i]['fname']) . '.-';
						}else{
							$html .= firstinitial($contributors[$i]['fname']) . '.';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '.';
						}
						$html .= ', . . . ';
					}else{
						//The author is a corporation and not a person
						$html .= ', . . . ';
					}
				}elseif ($countauthors==7 && $i==5) {
					//There are 7 authors and this is the sixth time through the loop
					$html .= ' ' . uppercasewords($contributors[$i]['lname']);
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The author is a person and not a corporation
						//Check for a hyphen in the first name
						$hyphentest = stripos($contributors[$i]['fname'], '-');
						if ($hyphentest!=false) {
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
						}else{
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . '., & ';	
						}else{
							$html .= uppercasewords($contributors[$i]['mi']) . ', & ';	
						}
					}else{
						//The author is a corporation and not a person
						$html .= ', & ';
					}
				}elseif (($i+1)==$countcontributors) {
					//This is the last time through the loop
					//If there are 6 authors add an ampersand before the name, otherwise do not
					if ($countauthors==6) {
						$html .= ' & ' . uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
							//The author is a person and not a corporation
							//Check for a hyphen in the first name
							$hyphentest = stripos($contributors[$i]['fname'], '-');
							if ($hyphentest!=false) {
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
							}else{
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '. ';
							}
							if ($contributors[$i]['mi']) {
								$html .= uppercasewords($contributors[$i]['mi']) . '. ';
							}
						}else{
							//The author is a corporation and not a person
							$html .= '. ';
						}
					}else{
						$html .= ' ' . uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
							//The author is a person and not a corporation
							//Check for a hyphen in the first name
							$hyphentest = stripos($contributors[$i]['fname'], '-');
							if ($hyphentest!=false) {
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
							}else{
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '. ';
							}
							if ($contributors[$i]['mi']) {
								$html .= uppercasewords($contributors[$i]['mi']) . '. ';
							}
						}else{
							//The author is a corporation and not a person
							$html .= '. ';
						}
					}
				}
			}else{
				if (($i+1)==$countcontributors) {
					//This is the last time through the loop
					if ($countauthors>1) {
						//There is more than one author
						$html .= ' & ' . uppercasewords($contributors[$i]['lname']);
						if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
							//The author is a person and not a corporation
							//Check for a hyphen in the first name
							$hyphentest = stripos($contributors[$i]['fname'], '-');
							if ($hyphentest!=false) {
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
							}else{
								$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.';
							}
							if ($contributors[$i]['mi']) {
									$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
							}
							$html .= ' ';
						}else{
							//The author is a corporation and not a person
							$html .= '. ';
						}
					}else{
						//There is only one author
						if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
							//The author is not Anonymous or blank
							$html .= uppercasewords($contributors[$i]['lname']);
							if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
								//The author is a person and not a corporation
								//Check for a hyphen in the first name
								$hyphentest = stripos($contributors[$i]['fname'], '-');
								if ($hyphentest!=false) {
									$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
								}else{
									$html .= ', ' . firstinitial($contributors[$i]['fname']) . '. ';
								}
								if ($contributors[$i]['mi']) {
									$html .= uppercasewords($contributors[$i]['mi']) . '. ';
								}
							}else{
								//The author is a corporation and not a person
								$html .= '. ';
							}
						}
					}
				}else{
					$html .= ' ' . uppercasewords($contributors[$i]['lname']);
					if (($contributors[$i]['fname'] || $contributors[$i]['mi'])) {
						//The author is a person and not a corporation
						//Check for a hyphen in the first name
						$hyphentest = stripos($contributors[$i]['fname'], '-');
						if ($hyphentest!=false) {
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.-';
						}else{
							$html .= ', ' . firstinitial($contributors[$i]['fname']) . '.';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '.,';
						}else{
							$html .= ', ';
						}
					}else{
						//The author is a corporation and not a person
						$html .= ', ';
					}
				}
			}
		}	
	}
	return $html;
}

//Format the translator names (APA)
function apatranslators($contributors) {
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
					$html .= '(';
						$html .= substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . '. ';
						}
					$html .= uppercasewords($contributors[$i]['lname']);
					if ($counttranslators>2) {
						//There are more than two translators
						$html .= ',';
					}
				}else{
					//There is only one translator
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The translator is not Anonymous or blank
						$html .= '(';
						$html .= substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . '. ';
						}
						$html .= uppercasewords($contributors[$i]['lname']);
					}
				}
			}elseif (($t+1)==$counttranslators) {
				//Last time through the loop
				if ($counttranslators>1) {
					//There is more than one translator
					$html .= ' & ' . substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
					if ($contributors[$i]['mi']) {
						$html .= uppercasewords($contributors[$i]['mi']) . '. ';
					}
					$html .= uppercasewords($contributors[$i]['lname']);
				}else{
					//There is only one translator
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The translator is not Anonymous or blank
						$html .= '(';
						$html .= substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
						if ($contributors[$i]['mi']) {
							$html .= uppercasewords($contributors[$i]['mi']) . '. ';
						}
						$html .= uppercasewords($contributors[$i]['lname']);
					}
				}
			}elseif (($t+2)==$counttranslators) {
				//Second to last time through the loop
				$html .= ' ' . substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . '. ';
				}
				$html .= uppercasewords($contributors[$i]['lname']);				
			}else{
				$html .= ' ' . substr(uppercasewords($contributors[$i]['fname']), 0, 1) . '. ';
				if ($contributors[$i]['mi']) {
					$html .= uppercasewords($contributors[$i]['mi']) . '. ';
				}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}
			$t++;
		}
	}
	if ($counttranslators>0) {
		$html .= ', Trans.).';
	}
	return $html;
}

//Format the editor names (APA)
function apaeditors($contributors) {
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
		if ($contributors[$i]['cselect']=='editor') {
		//If this contributor is an editor
			if ($t==0) {
				//First time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					$html .= 'In ';
						if ($contributors[$i]['fname']) {
							$html .= substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
						}
					$html .= uppercasewords($contributors[$i]['lname']);
					if ($counteditors>2) {
						//There are more than two editors
						$html .= ',';
					}
				}else{
					//There is only one editor
					$html .= 'In ';
						if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
							//The editor is not Anonymous or blank
							if ($contributors[$i]['fname']) {
								$html .= substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
							}
							if ($contributors[$i]['mi']) {
								$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
							}
							$html .= uppercasewords($contributors[$i]['lname']);
						}
				}
			}elseif (($t+1)==$counteditors) {
				//Last time through the loop
				if ($counteditors>1) {
					//There is more than one editor
					if ($contributors[$i]['fname']) {
							$html .= ' & ' . substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
						}
					$html .= uppercasewords($contributors[$i]['lname']);
				}else{
					//There is only one editor
					if (($contributors[$i]['lname']!='Anonymous') || (!$contributors[$i]['lname'] && !$contributors[$i]['fname'] && !$contributors[$i]['mi'])) {
						//The editor is not Anonymous or blank
						if ($contributors[$i]['fname']) {
							$html .= substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
						}
						$html .= uppercasewords($contributors[$i]['lname']);
					}
				}
			}elseif (($t+2)==$counteditors) {
				//Second to last time through the loop
				if ($contributors[$i]['fname']) {
							$html .= ' ' . substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
						}
				$html .= uppercasewords($contributors[$i]['lname']);				
			}else{
				if ($contributors[$i]['fname']) {
							$html .= ' ' . substr(uppercasewords($contributors[$i]['fname']), 0 ,1) . '. ';
						}
						if ($contributors[$i]['mi']) {
							$html .= ' ' . uppercasewords($contributors[$i]['mi']) . '. ';
						}
				$html .= uppercasewords($contributors[$i]['lname']) . ',';				
			}
			$t++;
		}
	}
	if ($counteditors==1) {
		$html .= ' (Ed.),';
	}
	if ($counteditors>1) {
		$html .= ' (Eds.),';
	}
	return $html;
}

//Format an article title (APA)
function articletitleapaformat($articletitleinput) {
	//Uppercase the first word in article title
	$articletitleinput = uppercasefirstword($articletitleinput);
	//If the article title contains a subtitle, capitalize the first word after the colon
	if (preg_match('/:[ ]+[a-z]/', $articletitleinput, $regs)) {
		$articletitleinput = subtitleucfirst($articletitleinput, $regs);
	}
	//Punctuate after the article title
	$articletitleinput = articleperiod($articletitleinput);
	return $articletitleinput;
}

//Format a book title (APA)
function booktitleapaformat($booktitleinput, $addpunctuation) {
	//Uppercase the first word in article title
	$html = uppercasefirstword($booktitleinput);
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

/********************************/
/*     Citation parsing         */
/********************************/

//Creates a book (in entirety) citation
function apa6bookcite($style, $medium, $contributors, $publicationyearinput, $booktitleinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput, $yearpublishedinput, $mediuminput, $urlebookinput, $doiebookinput) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date (if provided)
	if ($publicationyearinput) {
		$html .= ' (' . $publicationyearinput . '). ';
	}
	//Add the book title (if provided)
	if ($booktitleinput) {
		$html .= booktitleapaformat($booktitleinput, "yes") . ' ';
	}
	//Add the translators (if provided)
	$html .= apatranslators($contributors) . ' ';
	//Add the editors (if provided)
	$html .= apaeditors($contributors) . ' ';
	//in print
		if ($medium=="print") {
			//Add the publisher location (if provided)
			if ($publisherlocationinput) {
				$html .= uppercasewords($publisherlocationinput) . ': ';
			}
			//Add the publisher (if provided)
			if ($publisherinput) {
				$html .= uppercasewords($publisherinput) . '.';
			}
		}
	//on a website
		if ($medium=="website") {
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urlwebsiteinput);
			}elseif($doiwebsiteinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doiwebsiteinput;
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urldbinput);
			}elseif($doidbinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doidbinput;
			}
		}
	//as an ebook
		if ($medium=="ebook") {
			//Add the URL (if provided)
			if ($urlebookinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urlebookinput);
			}elseif($doiebookinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doiebookinput;
			}
		}
	echo $html;
}

//Creates a chapter or essay from a book citation
function apa6chapteressaycite($style, $medium, $contributors, $publicationyearinput, $chapteressayinput, $booktitleinput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $publisherlocationinput, $publisherinput, $websitetitleinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $doiwebsiteinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date (if provided)
	if ($publicationyearinput) {
		$html .= ' (' . $publicationyearinput . '). ';
	}
	//Add the chapter/essay title (if provided)
	if ($chapteressayinput) {
		$html .= articletitleapaformat($chapteressayinput) . ' ';
	}
	//Add the translators (if provided)
	$html .= apatranslators($contributors) . ' ';
	//Add the editors (if provided)
	if (apaeditors($contributors)) {
		$html .= apaeditors($contributors) . ' ';
	}else{
		$html .= 'In ';
	}
	//Add the book title and page numbers (if provided)
	$pageholder = apanewspaperpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput);
	if ($pageholder) {
		//There are page numbers to display
		if ($booktitleinput) {
			//There is a book title to display
			$html .= booktitleapaformat($booktitleinput, "no") . ' ';
		}
		$html .= '(' . $pageholder . '). ';
	}else{
		//There are no page numbers to display
		if ($booktitleinput) {
			//There is a book title to display
			$html .= booktitleapaformat($booktitleinput, "yes") . ' ';
		}
	}
	//Add the publisher location (if provided)
	if ($publisherlocationinput) {
		$html .= uppercasewords($publisherlocationinput) . ': ';
	}
	//Add the publisher (if provided)
	if ($publisherinput) {
		$html .= uppercasewords($publisherinput) . '. ';
	}
	//on a website
		if ($medium=="website") {
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urlwebsiteinput);
			}elseif($doiwebsiteinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doiwebsiteinput;
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urldbinput);
			}elseif($doidbinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doidbinput;
			}
		}
	echo $html;
}

//Creates a magazine article citation
function apa6magazinecite($style, $medium, $contributors, $articletitleinput, $magazinetitleinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $printadvancedinfovolume, $printadvancedinfoissue, $websitetitleinput, $webpagesstartinput, $webpagesendinput, $webpagesnonconsecutiveinput, $webpagesnonconsecutivepagenumsinput, $websiteadvancedinfovolume, $websiteadvancedinfoissue, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $urlwebsiteinput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $dbadvancedinfovolume, $dbadvancedinfoissue, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date
	$html .= apamagnewsdate($datepublishedday, $datepublishedmonth, $datepublishedyear) . '. ';
	//Add the article title (if provided)
	if ($articletitleinput) {
		$html .= articletitleapaformat($articletitleinput) . ' ';
	}
	//Add the magazine title (if provided)
	if ($magazinetitleinput) {
		$magtitleholder = uppercasewords($magazinetitleinput);
		$html .= '<i>' . forcearticlelower($magtitleholder) . '</i>';
	}
	if ($medium=="print") {
		//Add the volume and issue numbers (if provided)
		if ($printadvancedinfovolume || $printadvancedinfoissue) {
			//Add a comma after the magazine title (if provided)
			if ($magazinetitleinput) {
				$html .= ', ';
			}
			$html .= '<i>' . $printadvancedinfovolume . '</i>';
			if ($printadvancedinfoissue) {
				//Add the issue number (if provided)
				$html .= '(' . $printadvancedinfoissue . ')';
			}
		}
		//Add the page numbers (if provided)
		$pageholder = apascholarjournalpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput);
		if ($pageholder) {
			//There are page numbers
			if ($printadvancedinfovolume || $printadvancedinfoissue) {
				//There is a volume & issue number preceeding
				$html .= ', ' . $pageholder;
			}else{
				//There is no volume & issue number preceeding
				if ($magazinetitleinput) {
					//There is a magazine title preceeding
					$html .= ', ' . $pageholder;
				}else{
					//There is no magazine title preceeding
					$html .= $pageholder;
				}
			}
		}
		//Add a period
		$html .= '. ';
	}
	if ($medium=="website") {
		//Add the volume and issue numbers (if provided)
		if ($websiteadvancedinfovolume || $websiteadvancedinfoissue) {
			//Add a comma after the magazine title (if provided)
			if ($magazinetitleinput) {
				$html .= ', ';
			}
			$html .= '<i>' . $websiteadvancedinfovolume . '</i>';
			if ($websiteadvancedinfoissue) {
				//Add the issue number (if provided)
				$html .= '(' . $websiteadvancedinfoissue . ')';
			}
		}
		//Add the page numbers (if provided)
		$pageholder = apascholarjournalpages($webpagesstartinput, $webpagesendinput, $webpagesnonconsecutiveinput, $webpagesnonconsecutivepagenumsinput);
		if ($pageholder) {
			//There are page numbers
			if ($printadvancedinfovolume || $printadvancedinfoissue) {
				//There is a volume & issue number preceeding
				$html .= ', ' . $pageholder;
			}else{
				//There is no volume & issue number preceeding
				if ($magazinetitleinput) {
					//There is a magazine title preceeding
					$html .= ', ' . $pageholder;
				}else{
					//There is no magazine title preceeding
					$html .= $pageholder;
				}
			}
		}
		//Add a period
		$html .= '. ';
		//Add the URL (if provided)
		if ($urlwebsiteinput) {
			$html .= 'Retrieved from ' . checkurlprepend($urlwebsiteinput);
		}
	}
	if ($medium=="db") {
		//Add the volume and issue numbers (if provided)
		if ($dbadvancedinfovolume || $dbadvancedinfoissue) {
			//Add a comma after the magazine title (if provided)
			if ($magazinetitleinput) {
				$html .= ', ';
			}
			$html .= '<i>' . $dbadvancedinfovolume . '</i>';
			if ($dbadvancedinfoissue) {
				//Add the issue number (if provided)
				$html .= '(' . $dbadvancedinfoissue . ')';
			}
		}
		//Add the page numbers (if provided)
		$pageholder = apascholarjournalpages($dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $dbpagesnonconsecutivepagenumsinput);
		if ($pageholder) {
			//There are page numbers
			if ($dbadvancedinfovolume || $dbadvancedinfoissue) {
				//There is a volume & issue number preceeding
				$html .= ', ' . $pageholder;
			}else{
				//There is no volume & issue number preceeding
				if ($magazinetitleinput) {
					//There is a magazine title preceeding
					$html .= ', ' . $pageholder;
				}else{
					//There is no magazine title preceeding
					$html .= $pageholder;
				}
			}
		}
		//Add a period
		$html .= '. ';
		//Add the URL (if provided)
		if ($urldbinput) {
			$html .= 'Retrieved from ' . checkurlprepend($urldbinput);
		}
	}
	echo $html;
}

//Creates a newspaper article citation
function apa6newspapercite($style, $medium, $contributors, $articletitleinput, $newspapertitleinput, $newspapercityinput, $datepublishedday, $datepublishedmonth, $datepublishedyear, $editioninput, $sectioninput, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $websitetitleinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $dbnewspapercityinput, $dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear, $dbeditioninput, $dbpagesstartinput, $dbpagesendinput, $dbpagesnonconsecutiveinput, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date
	if ($medium=="print") {
		$html .= apamagnewsdate($datepublishedday, $datepublishedmonth, $datepublishedyear) . '. ';
	}
	if ($medium=="website") {
		$html .= apamagnewsdate($electronicpublishday, $electronicpublishmonth, $electronicpublishyear) . '. ';
	}
	if ($medium=="db") {
		$html .= apamagnewsdate($dbdatepublisheddateday, $dbdatepublisheddatemonth, $dbdatepublisheddateyear) . '. ';
	}
	//Add the article title (if provided)
	if ($articletitleinput) {
		$html .= articletitleapaformat($articletitleinput) . ' ';
	}
	//in print
		if ($medium=="print") {
			//Add the newspaper title
			$html .= '<i>' . uppercasewords($newspapertitleinput) . '</i>';
			//Add a comma after the newspaper title
			$html .= ', ';
			//Add the page numbers
			$html .= apanewspaperpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput) . '.';
		}
	//on a website
		if ($medium=="website") {
			//Add the newspaper title
			$html .= '<i>' . uppercasewords($newspapertitleinput) . '</i>';
			//Add a period after the newspaper title
			$html .= '. ';
			//Add the Home page URL (if provided)
			if ($urlwebsiteinput) {
				//Add the URL
				$html .= 'Retrieved from ' . $urlwebsiteinput;
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the newspaper title
			$html .= '<i>' . uppercasewords($newspapertitleinput) . '</i>';
			//Add a period after the newspaper title
			$html .= '. ';
			//Add the Home page URL (if provided)
			if ($urldbinput) {
				//Add the URL
				$html .= 'Retrieved from ' . $urldbinput;
			}
		}
	echo $html;
}

//Creates a scholarly journal article citation
function apa6scholarjournalcite($style, $medium, $contributors, $yearpublishedinput, $articletitleinput, $journaltitleinput, $volume, $issue, $pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput, $urlwebsiteinput, $doiwebsiteinput, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear, $databaseinput, $dbaccessdateday, $dbaccessdatemonth, $dbaccessdateyear, $urldbinput, $doidbinput) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date (if provided)
	if ($yearpublishedinput) {
		$html .= ' (' . $yearpublishedinput . '). ';
	}
	//Add the article title (if provided)
	if ($articletitleinput) {
		$html .= articletitleapaformat($articletitleinput) . ' ';
	}
	//Add the journal title (if provided)
	if ($journaltitleinput) {
		$journaltitleholder = uppercasewords($journaltitleinput);
		$html .= '<i>' . forcearticlelower($journaltitleholder) . '</i>';
	}
	//Add the volume and issue numbers (if provided)
	if ($volume || $issue) {
		//Add a comma after the journal title (if provided)
		if ($journaltitleinput) {
			$html .= ', ';
		}
		$html .= '<i>' . $volume . '</i>';
		if ($issue) {
			//Add the issue number (if provided)
			$html .= '(' . $issue . ')';
		}
	}
	//Add the page numbers (if provided)
	$pageholder = apascholarjournalpages($pagesstartinput, $pagesendinput, $pagesnonconsecutiveinput, $pagesnonconsecutivepagenumsinput);
	if ($pageholder) {
		//There are page numbers
		if ($volume || $issue) {
			//There is a volume & issue number preceeding
			$html .= ', ' . $pageholder;
		}else{
			//There is no volume & issue number preceeding
			if ($journaltitleinput) {
				//There is a magazine title preceeding
				$html .= ', ' . $pageholder;
			}else{
				//There is no journal title preceeding
				$html .= $pageholder;
			}
		}
	}
	//Add a period
	$html .= '. ';
	//on a website
		if ($medium=="website") {
			//Add the URL (if provided)
			if ($urlwebsiteinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urlwebsiteinput);
			}elseif($doiwebsiteinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doiwebsiteinput;
			}
		}
	//in a database
		if ($medium=="db") {
			//Add the URL (if provided)
			if ($urldbinput) {
				$html .= 'Retrieved from ' . checkurlprepend($urldbinput);
			}elseif($doidbinput) {
				//Add the DOI (if provided)
				$html .= 'doi:' . $doidbinput;
			}
		}
	echo $html;
}

//Creates a web site citation
function apa6websitecite($style, $medium, $contributors, $articletitleinput, $websitetitleinput, $publishersponsorinput, $urlwebsiteinput, $electronicpublishday, $electronicpublishmonth, $electronicpublishyear, $webaccessdateday, $webaccessdatemonth, $webaccessdateyear) {
	//Add the contributors
	$html = apaauthorformat($contributors);
	//Add the publishing date
	$html .= apamagnewsdate($electronicpublishday, $electronicpublishmonth, $electronicpublishyear) . '. ';
	//Add the article title (if provided)
	if ($articletitleinput) {
		$html .= articletitleapaformat($articletitleinput) . ' ';
	}
	//Add the website title (if provided)
	if ($websitetitleinput) {
		$html .= 'Retrieved from ' . $websitetitleinput . ' ';
	}
	//Add the URL (if provided)
	if ($urlwebsiteinput) {
		$html .= 'website: ' . checkurlprepend($urlwebsiteinput);
	}
	echo $html;
}
?>