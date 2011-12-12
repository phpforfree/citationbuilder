<?php
	//Save the variable passed in through the URL
	$source = $_GET['source'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- Stylesheets -->
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="includes/css.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="includes/colorbox.css" type="text/css" media="screen" />
		
		<!-- jQuery -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
		<script type="text/javascript" src="includes/jquery_plugins/jquery.form.js"></script>
		<script type="text/javascript" src="includes/jquery_plugins/jquery.colorboxmin.js"></script>
		<script type="text/javascript" src="includes/js/document_ready.js"></script>
	</head>
	<body>
		<noscript><div class="noscript">Javascript is disabled in your browser. Citation Builder will not function correctly without it.</div></noscript>
		<h1><a href="index.php">Citation Builder</a></h1>		
		<div style="position: relative;">
			<form id="citeform" action="citationbuild.php" method="post">
				<div><input type="hidden" id="mediumholder" name="mediumholder" value="website" /></div>
				<?php
				//Load the appropriate form template based on the source passed in through the URL
					switch ($source) {
						case "book":
							include ('templates/booktemplate.php');
							break;
						case "scholar":
							include ('templates/scholarjournaltemplate.php');
							break;
						case "bookchapter":
							include ('templates/bookchaptertemplate.php');
							break;
						case "website":
							include ('templates/websitetemplate.php');
							break;
						case "magazine":
							include ('templates/magazinetemplate.php');
							break;
						case "newspaper":
							include ('templates/newspapertemplate.php');
							break;
					}
				?>
			</form>
			<div id="sourcechangeholder" class="sourcechangeholder">
				Cite a...
				<table width="200px">
					<tr>
						<td>
							<ul>
								<li><a href="cite.php?source=book">book (in entirety)</a></li>
								<li><a href="cite.php?source=bookchapter">chapter or essay from a book</a></li>
								<li><a href="cite.php?source=magazine">magazine article</a></li>
								<li><a href="cite.php?source=newspaper">newspaper article</a></li>
								<li><a href="cite.php?source=scholar">scholarly journal article</a></li>
								<li><a href="cite.php?source=website">web site</a></li>
							</ul>
						</td>
					</tr>
					<tr>
						<td align="right">
							<a href="" id="close" name="close">x Close</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>