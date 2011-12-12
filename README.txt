Citation Builder, version 1.0
Developed by Jason Walsh
December 12, 2011


CONTENTS OF THIS FILE
------------------------------------

* About Citation Builder
* Installing Citation Builder
* Customizing Citation Builder
* Extending Citation Builder


ABOUT CITATION BUILDER
--------------------------------------- 

Citation Builder is a web-based tool designed to quickly and easily generate citations for sources consulted during the research process. While powerful tools such as RefWorks, Zotero, and Endnote exist to generate citations, understanding how to use these tools can require an investment of time. Citation Builder is an attempt to provide a low-barrier method for users to generate citations for commonly consulted source media in either APA (American Psychological Association) or MLA (Modern Language Association) formats.

For more information, visit our Github space at: http://github.com/phpforfree/Citation-Builder or the North Carolina State University project page at: http://www.lib.ncsu.edu/dli/projects/citationbuilder/

For a demo of Citation Builder, visit the North Carolina State University Libraries installation at: http://www.lib.ncsu.edu/citationbuilder/ 

INSTALLING CITATION BUILDER
----------------------------------------------

Please note: Citation Builder installation requires the inclusion of jQuery libraries and plugins that are neither developed nor maintained by the Citation Builder developer.

Citation Builder installation requires the following:
	1. A web server running PHP 5.2.6 or later: http://php.net
	2. Inclusion of jQuery 1.4 or later: http://jquery.com
	3. Inclusion of jQuery UI 1.8.6 or later: http://jqueryui.com
	4. Inclusion of jQuery Form Plugin: http://jquery.malsup.com/form/
	5. Inclusion of jQuery Colorbox Plugin: http://colorpowered.com/colorbox/
	6. Knowledge of PHP scripting and Javascripting

To install Citation Builder:
	1. Copy the Citation Builder source code to a directory on your web server.
	2. Visit the directory you created in a web browser.     

EXTENDING CITATION BUILDER
----------------------------------------------

Citation Builder only supports APA and MLA citation formats. In addition, Citation Builder only supports books (in entirety), chapters or essays from books, magazines, newspapers, scholarly journal articles, and web sites as citation mediums. Additional citation formats or citation mediums could be added to Citation Builder, if desired. Development and support of any and all additions to the Citation Builder framework are the responsibility of the developing entity. Feel free to fork the project.

	RECOMMENDATIONS FOR ADDING ADDITIONAL FORMATS
	--------------------------------------------
	
		1. Store your format specific functions in an identifiable file in the directory: includes/formats/
		2. Include the format specific functions file you created in #1 at the end of the file: includes/functions.php. The includes/functions.php file is a set of functions that any format/medium in Citation Builder can use.
		3. Add the appropriate PHP logic to the end of the PHP switch cases in the file citationbuild.php to call the medium specific citation parsing functions you created in #1
		4. Add your new format to the Citation Builder interface. This can be found as the first function in the file: includes/functions.php. The function is named: heading.