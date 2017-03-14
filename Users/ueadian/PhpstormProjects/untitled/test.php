<?php
function getArticles($startIndex = 0, $count = 10){
    $req = curl_init("http://ign-apis.herokuapp.com/articles?startIndex=" . $startIndex . "&count=" . $count);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($req, CURLOPT_HTTPGET, true);

    curl_setopt($req, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    $resp = curl_exec($req);
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
            foreach($respJ["data"] as $article)
            {
                echo("<h1>" . $article["metadata"]["headline"] . "</h1>");
                echo("<br />");
                echo("<img src=\"" . $article["thumbnails"][0]["url"] . "\">");
            }

        ?>
    </body>

</html>

