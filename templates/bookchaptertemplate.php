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
	heading("Cite a chapter or essay from a book", $source, $style);
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
				
				//Chapter/essay Title
				beginsection(chapteressaytitle, "Chapter/essay title:", yes);
					echo textbox(chapteressayinput, textbox, 45, none, novalue);
				endsection();
				
				//Book Title
				beginsection(booktitle, "Book title:", yes);
					echo textbox(booktitleinput, textbox, 45, none, novalue);
				endsection();
				
				//Publication Info
				beginsection(publicationinfo, "Publication info:", no);
					publicationinfo(pubinfotable);
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
					if ($style=="mla7") {
						//Web site Title
						beginsection(websitetitle, "Website title:", yes);
							echo textbox(websitetitleinput, textbox, 45, none, novalue);
						endsection();
					}
					
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
					
					if ($style=="mla7") {
						//Date accessed
						beginsection(webaccessdate, "Date accessed:", yes);
							dateinput(webaccessdate);
						endsection();
					}
				?>
			</div>
			<div id="db">
				<?php
					//Database
					beginsection(databasetitle, "Database title:", yes);
						echo textbox(databaseinput, textbox, 45, none, novalue);
					endsection();
					
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
					beginsection(dbaccessdate, "Date accessed:", yes);
						dateinput(dbaccessdate);
					endsection();
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