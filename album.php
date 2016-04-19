<html>
    <head>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/lightbox-2.6.min.js"></script>
        <link href="css/lightbox.css" rel="stylesheet" /> 
         <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js" type="text/JavaScript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        $page = $_SERVER['PHP_SELF'];
        $column = 5;
        $folder1 = "data";
        $folder2 = "thumbs";
        if (isset($_GET['album'])) {
            $getAlbum = $_GET['album'];
        }
        if (!isset($getAlbum)) {
            echo '<b>Select an album</b><br>';
          
            $handle = opendir($folder1);
            while (false !== ($file = readdir($handle))) {
                if (is_dir($folder1 . "/" . $file) && $file != "." && $file != ".." && $file != $folder2) {
                    echo "<a href='$page?album=$file'>" . $file . "</a><br>";
                }
            }
            closedir($handle);
        } else { 
            if (!is_dir($folder1 . "/" . $getAlbum) || (strstr($getAlbum, ".") != NULL) || (strstr($getAlbum, "/") != NULL ) || (strstr($getAlbum, "\\") != NULL)) {
                echo 'Album does not exists';
            } else {
                echo "<b>" . $getAlbum . "</b><p />";
                $x = 0;
                           
                $handle = opendir($folder1 . "/" . $getAlbum);
                while (($file = readdir($handle)) != false) {
                    if ($file != "." && $file != "..") {
                        echo "<div style='display:inline;'><a href='$folder1/$getAlbum/$file' data-lightbox='nondatabasealbum'><img src='$folder1/$folder2/$file' height='100' width='80'></a></div>";
                        $x++;
                        if ($x == $column) {
                            $x = 0;
                            echo '<br>';
                        }
                    }
                }

                closedir($handle);
            }
        }
        echo "<p><a href='$page'>Back to Albums";
        ?>
    </body>

</html>