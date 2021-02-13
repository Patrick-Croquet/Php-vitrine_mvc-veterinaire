<!DOCTYPE html>
<html lang="en">
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?=ROOT_URL?>static/css/style.css"/>
      <link type="text/css" rel="stylesheet" href="<?=ROOT_URL?>static/css/materialize.css"  media="screen,projection"/>
      <link rel="stylesheet" href="static/css/animate.css">
      <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
      Let browser know website is optimized for mobile-->
      <!-- bootstrap css -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="utf-8" />
      <title><?=\BlogPhp\Engine\Config::SITE_NAME?></title>
      <meta name="author" content="Romain Ollier" />

    </head>
    <body>
      <!--Import jQuery-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <!--Import popper.js et bootstrap.js-->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <!--Import materialize.js-->
      <script type="text/javascript" src="<?=ROOT_URL?>static/js/materialize.js"></script>
      <script type="text/javascript" src="<?=ROOT_URL?>static/js/script.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script src="<?=ROOT_URL?>static/js/tinymce/tinymce.min.js"></script>
      <script>
        tinymce.init({
          selector:'#editable',
          branding: false,
          height: 500,
          menubar: false,
          plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
          ],
          toolbar1: "formatselect | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
          toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | caption | styleselect",

          image_caption: true,
          image_advtab: true ,

          external_filemanager_path:"<?=ROOT_URL?>static/filemanager/",
          filemanager_title:"Responsive Filemanager" ,
          external_plugins: { "filemanager" : "<?=ROOT_URL?>static/filemanager/plugin.min.js"},
          visualblocks_default_state: true ,

          style_formats_autohide: true,
          style_formats_merge: true,
        });

      </script>
