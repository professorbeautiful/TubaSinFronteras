<!DOCTYPE html>
<html>
  <head>
    <title>Videos of Professor Beautiful</title>
    <link rel="stylesheet" type="text/css" href="2b-gallery.css">
    <script src="1c-gallery.js"></script>
 </head>
  <body>
    <!-- (A) CLOSE FULLSCREEN VIDEO -->
    <div id="vClose" onclick="vplay.toggle(false)">X</div>

    <!-- (B) VIDEO GALLERY -->
    <div class="gallery"><?php
      // (B1) GET VIDEO FILES FROM GALLERY FOLDER
      $dir = __DIR__ . DIRECTORY_SEPARATOR . "gallery" . DIRECTORY_SEPARATOR;
      $vid = glob("$dir*.{webm,mov,mp4,ogg}", GLOB_BRACE);

      // (B2) OUTPUT VIDEOS
      if (count($vid) > 0) { foreach ($vid as $v) {
        $file = basename($v);
        $caption = substr($file, 0, strrpos($file, "."));        
        printf("<div class='vWrap'>
          <video src='gallery/%s'></video>
          <div class='vCaption'>%s</div>
        </div>", rawurlencode($file), $caption);
      }}
    ?></div>
  </body>
</html>