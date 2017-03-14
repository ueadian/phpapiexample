<?php
/*
 * Function to get articles, startindex is the article to start at, count is how many to return, default is 0 10
 */
function getArticles($startIndex = 0, $count = 10){
    // open up the api url with startindex and count put in
    $req = curl_init("http://ign-apis.herokuapp.com/articles?startIndex=" . $startIndex . "&count=" . $count);
    // set curl to return a response and to use GET
    curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($req, CURLOPT_HTTPGET, true);
    // tell the app we are application / json (not necesary)
    curl_setopt($req, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    //exec the curl
    $resp = curl_exec($req);
    //decode the json into an array
    return json_decode($resp, true);
}
?>
<html>
    <head>
        <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
        <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
            integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
            crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            $respJ = getArticles();
            //data is where all the articles are, so foreach through each one
            foreach($respJ["data"] as $article)
            {
                //grab the headline from metadata and put it in a header tag
                echo("<h1>" . $article["metadata"]["headline"] . "</h1>");
                //add a line break
                echo("<br />");
                // get the first img (compact) url and use it in an img tag
                echo("<img src=\"" . $article["thumbnails"][0]["url"] . "\">");
            }

        ?>
    </body>

</html>

