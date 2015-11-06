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
    define("articletitle", null);
    define("articletitleinput", null);
    define("magazinetitle'", null);
    define("magazinetitleinput", null);
    define("datepublisheddate", null);
    define("datepublished", null);
    define("monthdropdown", null);
    define("websitetitle", null);
    define("websitetitleinput", null);
    define("webaccessdate", null);
    define("magazinetitle", null);
    define("urlsection", null);
    define("urlwebsiteinput", null);
    define("pages", null);
    define("startinput", null);
    define("endinput", null);
    define("nonconsecutivepagenumsinput", null);
    define("nonconsecutiveinput", null);
    define("checkbox", null);
    define("advancedinfo", null);
    define("printadvancedinfo", null);
    define("dbpages", null);
    define("databasetitle", null);
    define("databaseinput", null);
    define("dbaccessdate", null);
    define("urldbinput", null);
    define("dbadvancedinfo", null);
    define("webpages", null);
    define("websiteadvancedinfo", null);

    //Heading
    heading("Cite a magazine article", $source, $style);
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

                //Magazine Title
                beginsection(magazinetitle, "Magazine title:", yes);
                    echo textbox(magazinetitleinput, textbox, 45, none, novalue);
                endsection();

                //Date published
                beginsection(datepublisheddate, "Date published:", yes);
                    dateinput(datepublished);
                endsection();
            ?>
        </div>
        <div id="revolvecontent">
            <div id="print">
                <?php
                    //Pages
                    beginsection(pages, "Pages:", no);
                        pages(pages);
                    endsection();

                    //Advanced Info
                    if ($style=="apa6") {
                        beginsection(advancedinfo, "Advanced info:", no);
                            advancedinfo(printadvancedinfo);
                        endsection();
                    }
                ?>
            </div>
            <div id="website">
                <?php
                    //Pages
                    if ($style=="apa6") {
                        beginsection(pages, "Pages:", no);
                            pages(webpages);
                        endsection();
                    }

                    //Web site Title
                    if ($style=="mla7") {
                        beginsection(websitetitle, "Site publisher / sponsor:", yes);
                            echo textbox(websitetitleinput, textbox, 45, none, novalue);
                        endsection();
                    }

                    //Advanced Info
                    if ($style=="apa6") {
                        beginsection(advancedinfo, "Advanced info:", no);
                            advancedinfo(websiteadvancedinfo);
                        endsection();
                    }

                    //Date accessed
                    if ($style=="mla7") {
                        beginsection(webaccessdate, "Date accessed:", yes);
                            dateinput(webaccessdate);
                        endsection();
                    }

                    //URL
                    if ($style=="apa6") {
                        beginsection(urlsection, "Home page URL:", yes);
                            urlinput(urlwebsiteinput, $style, $source, no);
                        endsection();
                    } else {
                        beginsection(urlsection, "URL:", yes);
                            urlinput(urlwebsiteinput, $style, $source, no);
                        endsection();
                    }
                ?>
            </div>
            <div id="db">
                <?php
                    //Pages
                    beginsection(pages, "Pages:", no);
                        pages(dbpages);
                    endsection();

                    //Database title
                    if ($style=="mla7") {
                        beginsection(databasetitle, "Database title:", yes);
                            echo textbox(databaseinput, textbox, 45, none, novalue);
                        endsection();
                    }

                    //Advanced Info
                    if ($style=="apa6") {
                        beginsection(advancedinfo, "Advanced info:", no);
                            advancedinfo(dbadvancedinfo);
                        endsection();
                    }

                    //Date accessed
                    if ($style=="mla7") {
                        beginsection(dbaccessdate, "Date accessed:", yes);
                            dateinput(dbaccessdate);
                        endsection();
                    }

                    //URL
                    beginsection(urlsection, "Database URL:", yes);
                        urlinput(urldbinput, $style, $source, no);
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
