<?php
    //Include the functions file
    include 'includes/functions.php';

    //Save the variables passed in through the URL
    $source = null;
    $style  = null;

    if (isset($_GET['source'])) {
        $source = $_GET['source'];
    }

    if (isset($_GET['style'])) {
        $style  = $_GET['style'];
    }

    if (!$style) {
        $style = "mla7";
    }

    //define the constants for correct the warnings
    //general constants
    define("contributor", null);
    define("no", null);
    define("contributorfname0", null);
    define("textbox", null);
    define("none", null);
    define("novalue", null);
    define("contributormi0", null);
    define("Anonymous", null);
    define("yes", null);
    define("submitbutton", null);
    define("submitclass", null);
    define("doisection", null);
    define("doiwebsiteinput", null);
    define("doidbinput", null);
    //specific constants
    define("contributorlname0", null);
    define("chapteressaytitle", null);
    define("chapteressayinput", null);
    define("booktitle", null);
    define("booktitleinput", null);
    define("publicationinfo", null);
    define("pubinfotable", null);
    define("publisherinput", null);
    define("publisherlocationinput", null);
    define("publicationyearinput", null);
    define("pages", null);
    define("startinput", null);
    define("endinput", null);
    define("nonconsecutivepagenumsinput", null);
    define("nonconsecutiveinput", null);
    define("checkbox", null);
    define("websitetitle", null);
    define("websitetitleinput", null);
    define("urlsection", null);
    define("urlwebsiteinput", null);
    define("webaccessdate", null);
    define("monthdropdown", null);
    define("databasetitle", null);
    define("databaseinput", null);
    define("urldbinput", null);
    define("dbaccessdate", null);

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
                    } elseif ($style=="apa6") {
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
                    } elseif ($style=="apa6") {
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
