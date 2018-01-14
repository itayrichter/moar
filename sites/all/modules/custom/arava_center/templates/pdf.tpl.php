<div id="myContent">
  
<? if ($file_mime == 'application/x-shockwave-flash'): ?>

  <script type="text/javascript">
    var height = window.innerHeight;
    swfobject.embedSWF("<?php print $file; ?>", "myContent", "100%", height, "9.0.0");
  </script>

<? elseif ($file_mime == 'application/pdf'): ?>

  <iframe id="myviewer" src = "http://moar.org.il/sites/all/modules/custom/arava_center/ViewerJS/#<?php print $file; ?>" width='100%' allowfullscreen webkitallowfullscreen></iframe> 
  <script type="text/javascript">
    var height = window.innerHeight;
    document.getElementById('myviewer').height= height;
  </script>
  
<? endif; ?>

</div>
