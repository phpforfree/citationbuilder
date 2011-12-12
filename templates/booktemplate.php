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
	heading("Cite a book (in entirety)", $source, $style);
?>
	<div id="tabs">
		<ul>
			<li><a href="#print" class="print">in print</a></li>
			<li><a href="#website" class="website">on a website</a></li>
			<li><a href="#db" class="db">in a database</a></li>
			<li><a href="#ebook" class="ebook">as a digital file</a></li>
		</ul>
		<div>
			<?php
				//header
				headercreate();
				
				//Contributor
				beginsection(contributor, "Contributor(s):", no);
					contributor(contributor);
				endsection();
				
				//Book title
				beginsection(booktitle, "Book title:", yes);
					echo textbox(booktitleinput, textbox, 45, none, novalue);
				endsection();
				
				//Publication info
				beginsection(publicationinfo, "Publication info:", no);
					publicationinfo(pubinfotable);
				endsection();
			?>
		</div>
		<div id="revolvecontent">
			<div id="print">
			</div>
			<div id="website">
				<?php				
					//Website title
					if ($style=="mla7") {
						beginsection(websitetitle, "Website title:", yes);
							echo textbox(websitetitleinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6"){
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
					//Database title
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
						beginsection(webaccessdate, "Date accessed:", yes);
							dateinput(dbaccessdate);
						endsection();
					}
				?>
			</div>
			<div id="ebook">
				<?php
					//Medium
					if ($style=="mla7") { 
						beginsection(ebookmedium, "Medium:", yes);
							mediuminput();
						endsection();
					}
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlebookinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlebookinput, $style, $source, yes);
						endsection();
					}
					
					//DOI
					if ($style=="apa6") {
						beginsection(doisection, "DOI:", yes);
							echo textbox(doiebookinput, textbox, 45, none, novalue);
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