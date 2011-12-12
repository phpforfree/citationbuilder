<?php
	//Include the functions file
	include ('includes/functions.php');
	
	//Save the variables passed in through the URL
	$source = $_GET['source'];
	$style = $_GET['style'];
	if ($style=="") {
		$style="mla7";
	}
	
	//Heading
	heading("Cite a scholarly journal article", $source, $style);
?>
	<div id="tabs">
		<ul> 
			<li><a href="#print" class="print">in print</a></li>
			<li><a href="#website" class="website">on a website</a></li>
			<li><a href="#db" class="db">in a database</a></li>
		</ul>
		<div>
			<?php
				//header
				headercreate();
				
				//Contributor
				beginsection(contributor, "Contributor(s):", no);
					contributor(contributor);
				endsection();
				
				//Article Title
				beginsection(articletitle, "Article title:", yes);
					echo textbox(articletitleinput, textbox, 45, none, novalue);
				endsection();
				
				//Journal Title
				beginsection(journaltitle, "Journal title:", yes);
					echo textbox(journaltitleinput, textbox, 45, none, novalue);
				endsection();
				
				//Advanced Info
				beginsection(advancedinfo, "Advanced info:", no);
					advancedinfo(advancedinfo);
				endsection();
				
				//Year Published
				beginsection(yearpublished, "Year published:", yes);
					echo textbox(yearpublishedinput, textbox, 4, 4, novalue);
				endsection();
				
				//Pages
				beginsection(pages, "Pages:", no);
					pages(pages);
				endsection();
			?>
		</div>
		<div id="revolvecontent">
			<div id="print">
			</div>
			<div id="website">
				<?php				
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, yes);
						endsection();
					}
					
					//DOI
					if ($style=="apa6") {
						beginsection(doisection, "DOI:", yes);
							echo textbox(doiwebsiteinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//Date accessed
					if ($style=="mla7") {
						beginsection(webaccessdate, "Date accessed:", yes);
							dateinput(webaccessdate);
						endsection();
					}
				?>
			</div>
			<div id="db">
				<?php
					//Database
					if ($style=="mla7") {
						beginsection(databasetitle, "Database title:", yes);
							echo textbox(databaseinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urldbinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urldbinput, $style, $source, yes);
						endsection();
					}
					
					//DOI
					if ($style=="apa6") {
						beginsection(doisection, "DOI:", yes);
							echo textbox(doidbinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//Date accessed
					if ($style=="mla7") {
						beginsection(dbaccessdate, "Date accessed:", yes);
							dateinput(dbaccessdate);
						endsection();
					}
				?>
			</div>
		</div>
		<?php
			//Submit button
				beginsection(submitbutton, "", yes);
					echo submitbutton(submitclass);
				endsection();
				
			//footer
				footercreate();
				
			//citation holder
				citationhold();
		?>
	</div>