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
	heading("Cite a web site", $source, $style);
?>
	<div id="tabs">
		<ul>
			<li><a href="#website" class="website">on the internet</a></li>
		</ul>
		<div>
			<?php
				//header
				headercreate();
				
				//Contributor
				beginsection(contributor, "Contributor(s):", no);
					contributor(contributor);
				endsection();
			?>
		</div>
		<div id="revolvecontent">
			<div id="website">
				<?php
					//Article Title
					beginsection(articletitle, "Article title:", yes);
						echo textbox(articletitleinput, textbox, 45, none, novalue);
					endsection();
					
					//Website Title
					if ($style=="mla7") {
						beginsection(websitetitle, "Web site title:", yes);
							echo textbox(websitetitleinput, textbox, 45, none, novalue);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(websitetitle, "Website title:", yes);
							echo textbox(websitetitleinput, textbox, 45, none, novalue);
						endsection();
					}
					
					//Publisher / sponsor
					beginsection(publishersponsor, "Site publisher / sponsor:", yes);
						echo textbox(publishersponsorinput, textbox, 45, none, novalue);
					endsection();
					
					//URL
					if ($style=="mla7") {
						beginsection(urlsection, "URL:", yes);
							urlinput(urlwebsiteinput, $style, $source, no);
						endsection();
					}elseif ($style=="apa6") {
						beginsection(urlsection, "URL:", yes);
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