<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Ejemplo usando Offline.js</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/offline-js/themes/offline-theme-chrome.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/offline-js/themes/offline-language-spanish.css">
  <script src="https://cdn.jsdelivr.net/npm/offline-js"></script>
  <script src="check-internet.js"></script>
</head>
<body>


  <script type="text/javascript">Offline.options = {
  checkOnLoad: false
};
Offline.on('up', function() {
  window.location.reload();
});</script>
</html>