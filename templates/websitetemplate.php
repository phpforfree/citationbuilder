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
    //especifics constants
    define("articletitle", null);
    define("contributorlname0", null);
    define("articletitleinput", null);
    define("websitetitle", null);
    define("websitetitleinput", null);
    define("publishersponsor", null);
    define("publishersponsorinput", null);
    define("urlsection", null);
    define("urlwebsiteinput", null);
    define("electronicpublish", null);
    define("monthdropdown", null);
    define("webaccessdate", null);

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
                    } elseif ($style=="apa6") {
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
                    } elseif ($style=="apa6") {
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
