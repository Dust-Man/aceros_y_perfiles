<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/principal.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=construction" />
</head>

<body>
    <?php
    include "./header.php";
    ?>
    <div class="grid4x4">
    <form class="form">
      
          <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
              <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>

      <input class="input" placeholder="Buscar algo..."  type="text" id="search-input">
      <button class="reset" type="reset">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
      </button>
  </form>
  </div>
  <div id="results">
    <!-- Aqui se generaran los resultados xd -->
</div>

<div  class="pagination" id="pagination">
    <!--Y aqui la paginacion  -->
</div>


 
          
</body>
<script src="./scripts/header.js" defer></script>
<script src="./scripts/buscar.js" defer></script>


</html>