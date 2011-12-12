<?php
/*****Form functionality******/
	
	//Creates a page heading and links for style choice
	function heading($heading, $source, $style) {
		$html = '<div>';
		$html .= '<table width="100%"><tr><td width="8%" nowrap="nowrap">';
		$html .= '<div id="mainheading" style="mainheading"><h2>' . $heading;
		$html .= '</h2></div></td><td><div id="change" class="change"><a href="">change</a>';
		$html .= '<input type="hidden" id="sourceholder" name="sourceholder" value="' . $source . '" /></div></td>';
		$html .= '<td align="right"><div id="stylechoice" class="stylechoice"><input type="hidden" id="styleholder" name="styleholder" value="' . $style . '" />';
		$html .= 'Citation style: ';
		if ($style=="apa6") {
			$html .= ' <span class="styleselected">APA 6</span> ';
		}else{
			$html .= ' <a href="cite.php?source=' . $source . '&amp;style=apa6" id="apa6">APA 6</a> ';
		}
		if ($style=="mla7") {
			$html .= '| <span class="styleselected">MLA 7</span> ';
		}else{
			$html .= '| <a href="cite.php?source=' . $source . '&amp;style=mla7" id="mla7">MLA 7</a> ';
		}
		$html .= '</div></td></tr></table></div>' . "\n";
		echo $html;
	}

	/********************************/
	/*    Form Inputs               */
	/********************************/
	
	//Creates a checkbox and label div
	function checkbox($id, $css) {
		$html = '<input type="checkbox" id="' . $id . '" name="' . $id . '"';
		$html .= ' class="' . $css . '" value="1" />';
		return $html;
	}
	
	//Creates a month drop down list
	function monthdropdown($id, $css) {
		$html = '<div class="' . $css . '">';
		$html .= '<select id="' . $id . '" name="' . $id . '">';
		$html .= '<option></option>';
		$html .= '<option value="January">January</option>'; 
		$html .= '<option value="February">February</option>'; 
		$html .= '<option value="March">March</option>'; 
		$html .= '<option value="April">April</option>'; 
		$html .= '<option value="May">May</option>'; 
		$html .= '<option value="June">June</option>'; 
		$html .= '<option value="July">July</option>'; 
		$html .= '<option value="August">August</option>'; 
		$html .= '<option value="September">September</option>'; 
		$html .= '<option value="October">October</option>'; 
		$html .= '<option value="November">November</option>'; 
		$html .= '<option value="December">December</option>'; 
		$html .= '<option value="Jan. &amp; Feb.">Jan. &amp; Feb.</option>'; 
		$html .= '<option value="Feb. &amp; March">Feb. &amp; March</option>'; 
		$html .= '<option value="March &amp; April">March &amp; April</option>'; 
		$html .= '<option value="April &amp; May">April &amp; May</option>'; 
		$html .= '<option value="May &amp; June">May &amp; June</option>'; 
		$html .= '<option value="June &amp; July">June &amp; July</option>'; 
		$html .= '<option value="July &amp; Aug.">July &amp; Aug.</option>'; 
		$html .= '<option value="Aug. &amp; Sept.">Aug. &amp; Sept.</option>'; 
		$html .= '<option value="Sept. &amp; Oct.">Sept. &amp; Oct.</option>'; 
		$html .= '<option value="Oct. &amp; Nov.">Oct. &amp; Nov.</option>'; 
		$html .= '<option value="Nov. &amp; Dec.">Nov. &amp; Dec.</option>'; 
		$html .= '<option value="Dec. &amp; Jan.">Dec. &amp; Jan.</option>'; 
		$html .= '<option value="Spring">Spring</option>'; 
		$html .= '<option value="Summer">Summer</option>';
		$html .= '<option value="Fall">Fall</option>'; 
		$html .= '<option value="Winter">Winter</option>';
		$html .= '</select>';
		$html .= '</div>';
		return $html;	
	}
	
	//Creates the submit button
	function submitbutton($css) {
		$html = '<input type="submit" class="' . $css . '" value="Submit" />';
		echo $html;
	}
	
	//Creates a textbox and label div
	function textbox($id, $css, $size, $maxlength, $value) {
		$html = '<input type="text" id="' . $id . '"';
		$html .= ' name="' . $id . '"';
		$html .= ' class="' . $css . '"';
		$html .= ' size="' . $size . '"';
		if ($value!="novalue") {
			$html .= ' value="' . $value . '"';
		}
		$html .= ' maxlength="' . $maxlength . '" />';
		return $html;
	}

	/********************************/
	/*    Form Sections             */
	/********************************/
	
	//Creates the Advanced Info section
	function advancedinfo($id) {
		$html = '<table id="' . $id . '">';
		$html .= '<tr>';
		$html .= '<td>';
		$html .= textbox($id . 'volume', textbox, 4, none, novalue);
		$html .= '<br /><span class="small">Volume</span></td><td>';
		$html .= textbox($id . 'issue', textbox, 4, none, novalue);
		$html .= '<br /><span class="small">Issue</span></td><td>';
		$html .= '</tr></table>';
		echo $html;
	}
	
	//Creates a section and label div
	function beginsection($sectionid, $label, $top) {
		$html = '<div id="' . $sectionid . '" ';
		$html .= 'class="sectionchild">' . "\n";
		$html .= '<table>' . "\n" . '<tr>' . "\n\t" . '<td class="sectionlabel">';
		$html .= $label;
		$html .= '</td>' . "\n\t" . '<td>';
		echo $html;
	}
	
	//Creates the Contributor section
	function contributor($id) {
		$html = '<table id="' . $id . 'table0">';
		$html .= '<tr>';
		$html .= '<td>';
		$html .= '<select id="' . $id . 'select0" name="' . $id . 'select0">' . "\n";
		$html .= '<option value="author">Author</option>' . "\n";
		$html .= '<option value="editor">Editor</option>' . "\n";
		$html .= '<option value="translator">Translator</option>' . "\n";
		$html .= '</select>' . "\n";
		$html .= '</td><td>';
		$html .= textbox(contributorfname0, textbox, 10, none, novalue);
		$html .= '<br /><span class="small">First</span></td><td>';
		$html .= textbox(contributormi0, textbox, 1, 1, novalue);
		$html .= '<br /><span class="small">MI</span></td><td>';
		$html .= textbox(contributorlname0, textbox, 12, none, Anonymous);
		$html .= '<br /><span class="small">Last / Corporation</span></td>';
		$html .= '<td width="48px"></td>';
		$html .= '</tr>';
		$html .= '<tr><td colspan="5"><div id="adddiv"><input type="hidden" id="addidvalue" name="addidvalue" value="1" /></div></td></tr>';
		$html .= '<tr><td colspan="5" class="addcontributor"><a href="" class="contribaddlink" id="contribaddlink">+ Add another contributor</a></td>';
		$html .= '</tr></table>';
		echo $html;
	}
		
	//Creates a date input
	function dateinput($id) {
		$html = '<table id="' . $id . '">';
		$html .= '<tr>';
		$html .= '<td>';
		$html .= textbox($id . 'day', textbox, 2, 2, novalue);
		$html .= '<br /><span class="small">Day</span></td><td>';
		$html .= monthdropdown($id . 'month', monthdropdown);
		$html .= '<span class="small">Month</span></td><td>';
		$html .= textbox($id . 'year', textbox, 4, 4, novalue);
		$html .= '<br /><span class="small">Year</span></td>';
		$html .= '</tr></table>';
		echo $html;
	}
	
	//Closes a section and label div
	function endsection () {
		$html = "</td>\n</tr>\n</table>\n</div>\n";
		echo $html;
	}
	
	//Creates a footer for the form
	function footercreate() {
		$html = '<div id="footer" class="footer"></div>';
		echo $html;
	}
		
	//Creates a header for the form
	function headercreate() {
		$html = '<div id="header" class="header">Fill in everything you know about your source:</div>';
		echo $html;
	}
	
	//Creates the Medium input
	function mediuminput() {
		$html = textbox(mediuminput, textbox, 45, none, novalue);
		$html .= '<br/>';
		$html .= 'Ex: PDF, Microsoft Word, MP3, etc.';
		echo $html;
	}
		
	//Creates the Newspaper city input
	function newspapercityinput($id) {
		$html = textbox($id, textbox, 45, none, novalue);
		$html .= '<br/>';
		$html .= 'Only include if city is not in newspaper name';
		echo $html;
	}
	
	//Creates the Pages section
	function pages($id) {
		$html = '<table id="' . $id . '"><tr><td><div id="pagesstart">';
		$html .= textbox($id . startinput, textbox, 4, none, novalue);
		$html .= '<br /><span class="small">Start</span></div></td><td><div id="pagesend">';
		$html .= textbox($id . endinput, textbox, 4, none, novalue);
		$html .= '<br /><span class="small">End</span></div></td>';
		$html .= '<td><div id="nonconsecutivepagenums" style="display: none;">';
		$html .= textbox($id . nonconsecutivepagenumsinput, textbox, 27, none, novalue);
		$html .= '<br /><span class="small">Separate the numbers with commas</span></div></td>';
		$html .= '<td><div id="pagenccheck">';
		$html .= checkbox($id . nonconsecutiveinput, checkbox);
		$html .= '<span class="small">Pages are non-consecutive</span></div></td></tr></table>';
		echo $html;
	}
		
	//Creates the Publication Info section
	function publicationinfo($id) {
		$html = '<table id="' . $id . '"><tr><td>';
		$html .= textbox(publisherinput, textbox, 15, none, novalue);
		$html .= '<br /><span class="small">Publisher</span></td><td>';
		$html .= textbox(publisherlocationinput, textbox, 15, none, novalue);
		$html .= '<br /><span class="small">Location</span></td><td>';
		$html .= textbox(publicationyearinput, textbox, 4, 4, novalue);
		$html .= '<br /><span class="small">Year</span></td></tr></table>';
		echo $html;
	}
		
	//Creates a URL input
	function urlinput($id, $style, $source, $showor){
		$html = textbox($id, textbox, 45, none, novalue);
		if ($style=="apa6") {
			if ($showor=="yes") {
				$html .= '<br /> OR';
			}
		}
		if ($style=="mla7") {
			$html .= '<br />MLA 7 says to omit the URL unless the source cannot be located without it, or if your instructor requires it.';
		}
		echo $html;
	}
		
/*****Citation functionality******/

	/********************************/
	/*    String manipulation       */
	/********************************/

	//Converts a passed style variable into the appropriate text
	function styleconvert($style) {
		switch($style) {
			case "apa6":
				$html = "APA 6";
				break;
			case "mla7":
				$html = "MLA 7";
				break;
		} 
		return $html;
	}
	
	//Clean variables of slashes and leading/trailing spaces
	function cleanvars($variable) {
		$cleanvariable = stripslashes($variable);
		$cleanvariable = trim($cleanvariable);
		return $cleanvariable;
	}
	
	//Uppercase all words in string
	function uppercasewords($string) {
		$uppercasestring = ucwords($string);
		return $uppercasestring;
	}
	
	//Uppercase first word in a string
	function uppercasefirstword($string) {
		$lowercasestring = strtolower($string);
		$uppercasestring = ucfirst($lowercasestring);
		return $uppercasestring;
	}
	
	//Lowercase all words in a string
	function lowercasewords($string) {
		$lowercasestring = strtolower($string);
		return $lowercasestring;
	}
	
	//Uppercase the first word of a subtitle
	function subtitleucfirst($string, $regs) {  
		$ucaftercolon = strtoupper($regs[0]);
		$subtitleucfirst = preg_replace('/:[ ]+[a-z]/', "$ucaftercolon", $string);
		return $subtitleucfirst;
	}

	//Remove articles (A, An, The) before a string
	function removearticle($string) {
		$patterns = array ('/A /', '/An /', '/The /');
		$replacements = array ('');
		$removearticle = preg_replace($patterns, $replacements, $string);
		return $removearticle;
	}
	
	//Force articles, prepositions, and conjuctions to lowercase
	function forcearticlelower($forcearticlelower) {
		$forcearticlelower = str_replace(" A ", " a ", $forcearticlelower);
		$forcearticlelower = str_replace(" An ", " an ", $forcearticlelower);
		$forcearticlelower = str_replace(" And ", " and ", $forcearticlelower);
		$forcearticlelower = str_replace(" About ", " about ", $forcearticlelower);
		$forcearticlelower = str_replace(" As ", " as ", $forcearticlelower);
		$forcearticlelower = str_replace(" At ", " at ", $forcearticlelower);
		$forcearticlelower = str_replace(" Away ", " away ", $forcearticlelower);
		$forcearticlelower = str_replace(" But ", " but ", $forcearticlelower);
		$forcearticlelower = str_replace(" By ", " by ", $forcearticlelower);
		$forcearticlelower = str_replace(" Due ", " due ", $forcearticlelower);
		$forcearticlelower = str_replace(" For ", " for ", $forcearticlelower);
		$forcearticlelower = str_replace(" From ", " from ", $forcearticlelower);
		$forcearticlelower = str_replace(" In ", " in ", $forcearticlelower);
		$forcearticlelower = str_replace(" Into ", " into ", $forcearticlelower);
		$forcearticlelower = str_replace(" Like ", " like ", $forcearticlelower);
		$forcearticlelower = str_replace(" Of ", " of ", $forcearticlelower);
		$forcearticlelower = str_replace(" Off ", " off ", $forcearticlelower);
		$forcearticlelower = str_replace(" On ", " on ", $forcearticlelower);
		$forcearticlelower = str_replace(" Onto ", " onto ", $forcearticlelower);
		$forcearticlelower = str_replace(" Or ", " or ", $forcearticlelower);
		$forcearticlelower = str_replace(" Over ", " over ", $forcearticlelower);
		$forcearticlelower = str_replace(" Per ", " per ", $forcearticlelower);
		$forcearticlelower = str_replace(" Than ", " than ", $forcearticlelower);
		$forcearticlelower = str_replace(" The ", " the ", $forcearticlelower);
		$forcearticlelower = str_replace(" Till ", " till ", $forcearticlelower);
		$forcearticlelower = str_replace(" To ", " to ", $forcearticlelower);
		$forcearticlelower = str_replace(" Until ", " until ", $forcearticlelower);
		$forcearticlelower = str_replace(" Up ", " up ", $forcearticlelower);
		$forcearticlelower = str_replace(" Upon ", " upon ", $forcearticlelower);
		$forcearticlelower = str_replace(" Via ", " via ", $forcearticlelower);
		$forcearticlelower = str_replace(" With ", " with ", $forcearticlelower);
		$forcearticlelower = str_replace(" Within ", " within ", $forcearticlelower);
		$forcearticlelower = str_replace(" Without ", " without ", $forcearticlelower);
		$forcearticlelower = str_replace(" Within ", " within ", $forcearticlelower);
		$forcearticlelower = str_replace(" Within ", " within ", $forcearticlelower);
		return $forcearticlelower;
	}
	
	//Add a period to the end of an article title unless it is a ".", "?", or "!"
	function articleperiod($articletitle) {
		$articletitlelength = strlen($articletitle);
		$lastarticletitlechar = substr($articletitle, $articletitlelength-1, 1);
		if (($lastarticletitlechar != ".") && ($lastarticletitlechar != "?") && ($lastarticletitlechar != "!")) {
			$articletitle = $articletitle . ".";
		}else{
			$articletitle = $articletitle;
		}
		return $articletitle;
	}
		
	//Check if a day should be displayed based on a month selection
	function dayshow($month) {
		$noshow = 1;
		switch($month) {
			case "January":
				$noshow = 0;
				break;
			case "February":
				$noshow = 0;
				break;
			case "March":
				$noshow = 0;
				break;
			case "April":
				$noshow = 0;
				break;
			case "May":
				$noshow = 0;
				break;
			case "June":
				$noshow = 0;
				break;
				case "July":
				$noshow = 0;
				break;
			case "August":
				$noshow = 0;
				break;
			case "September":
				$noshow = 0;
				break;
				case "October":
				$noshow = 0;
				break;
			case "November":
				$noshow = 0;
				break;
			case "December":
				$noshow = 0;
				break;
		}
		return $noshow;
	}
	
	//Check that a URL begins with "http://", "ftp://", "telnet://", or "gopher://" (case-insensitive).  If not, assume http and prepend "http://".
	function checkurlprepend($urlwebsiteinput) {
		$httpprefix = strpos('http://', $urlwebsiteinput);
		$httpsprefix = strpos('https://', $urlwebsiteinput);
		$ftpprefix = strpos('ftp://', $urlwebsiteinput);
		$telnetprefix = strpos('telnet://', $urlwebsiteinput);
		$gopherprefix = strpos('gopher://', $urlwebsiteinput);
		if (($httpprefix !== false) && ($ftpprefix !== false) && ($telnetprefix !== false) && ($gopherprefix !== false) && ($httpsprefix !== false)) {
		   $urlwebsiteinput = "http://" . $urlwebsiteinput;
		}
		return $urlwebsiteinput;
	}
	
	//Format a name and pull the first initial
	function firstinitial($name) {
		$initial = substr($name , 0, 1);
		$initial = strtoupper($initial);
		return $initial;
	}
	
	/********************************/
	/*     Citation layout          */
	/********************************/
	
	//Creates an overall container for citations
	function citationhold() {
		$html = '<div id="placeholder" class="placeholder"></div>';
		echo $html;
	}
	
	//Creates a single citation container
	function citationcontainstart($style) {
		$html = '<div id="overallcitationholder"><table width="100%"><tr><td align="center">Copy and paste the citation below into your work.</td></tr></table>';
		$html .= '<div id="citationholder" class="citationholder"><span class="styleheading">' . styleconvert($style) . '</span><br />';
		echo $html;
	}
	
	//Closes a single citation container
	function citationcontainend() {
		$html = '</div>';
		echo $html;
	}

/*******************************************************/
/*     Include citation format function files below    */
/*******************************************************/
include 'formats/apa6_format.php';
include 'formats/mla7_format.php';

?>