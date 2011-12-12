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
	heading("Cite a newspaper article", $source, $style);
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
				
				//Newspaper Title
				beginsection(newspapertitle, "Newspaper title:", yes);
					echo textbox(newspapertitleinput, textbox, 45, none, novalue);
				endsection();
					
				//Article Title
				beginsection(articletitle, "Article title:", yes);
					echo textbox(articletitleinput, textbox, 45, none, novalue);
				endsection();
			?>
		</div>
		<div id="revolvecontent">
			<div id="print">
				<?php			
					if ($style=="mla7") {
						//Newspaper city
						beginsection(newspapercity, "Newspaper city:", no);
							newspapercityinput(newspapercityinput);
						endsection();
					}
								
					//Date published
					beginsection(datepublisheddate, "Date published:", yes);
						dateinput(datepublished);
					endsection();
					
					if ($style=="mla7") {
						//Edition
						beginsection(edition, "Edition:", yes);
							echo textbox(editioninput, textbox, 18, none, novalue);
						endsection();
						
						//Section
						beginsection(section, "Section:", yes);
							echo textbox(sectioninput, textbox, 18, none, novalue);
						endsection();
					}
					
					//Pages
					beginsection(pages, "Pages:", no);
						pages(pages);
					endsection();
				?>
			</div>
			<div id="website">
				<?php				
					//Web site Title
					if ($style=="mla7") {
						beginsection(websitetitle, "Web site title:", yes);
							echo textbox(websitetitleinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "Home page URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, no);
						endsection();
					}
					
					//Electronically published
					beginsection(electronicpublish, "Electronically published:", yes);
						dateinput(electronicpublish);
					endsection();
					
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
					if ($style=="mla7") {
						//Newspaper city
						beginsection(dbnewspapercity, "Newspaper city:", no);
							newspapercityinput(dbnewspapercityinput);
						endsection();
					}
					
					//Date published
					beginsection(dbdatepublisheddate, "Date published:", yes);
						dateinput(dbdatepublisheddate, textbox, 12, none, novalue);
					endsection();
					
					//Edition
					if ($style=="mla7") {
						beginsection(dbedition, "Edition:", yes);
							echo textbox(dbeditioninput, textbox, 18, none, novalue);
						endsection();
					}
					
					//Pages
					if ($style=="mla7") {
						beginsection(dbpages, "Pages:", no);
							pages(dbpages);
						endsection();
					}
					
					//Database
					if ($style=="mla7") {
						beginsection(databasetitle, "Database title:", yes);
							echo textbox(databaseinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//Date accessed
					if ($style=="mla7") {
						beginsection(dbaccessdate, "Date accessed:", yes);
							dateinput(dbaccessdate, textbox, 12, none, novalue);
						endsection();
					}
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urldbinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "Database URL:", yes);
							urlinput(urldbinput, $style, $source, no);
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