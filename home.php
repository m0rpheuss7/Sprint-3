<!DOCTYPE html>
<html>
<head>
<title>Hidratec</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    margin-top: 13.5rem;
    color: #999;
    font: 400 16px/1.5 exo, ubuntu, "segoe ui", helvetica, arial, sans-serif;
    text-align: center;
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAABnSURBVHja7M5RDYAwDEXRDgmvEocnlrQS2SwUFST9uEfBGWs9c97nbGtDcquqiKhOImLs/UpuzVzWEi1atGjRokWLFi1atGjRokWLFi1atGjRokWLFi1af7Ukz8xWp8z8AAAA//8DAJ4LoEAAlL1nAAAAAElFTkSuQmCC") repeat 0 0;
    animation: bg-scrolling-reverse 100s infinite linear; 
}

@keyframes bg-scrolling-reverse {
    from {
        background-position: 0 0;
    }
    to {
        background-position: 0 -100%;
    }
}
.navigation {
    flex: 2;
    margin-left: 20px;
    font-size: large;
    margin-top: 5px;
    
}

.navigation ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 20px;
}

.navigation li {
    display: inline;
}

.navigation a {
    color: rgb(242, 242, 242);
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.navigation a:hover {
    background-color: #848484; 
    color: rgba(14, 13, 13, 0.818);
}

header {
    display: flex;
    color: white;
    padding: 50px 20px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    justify-content: space-around;
    align-items: center;
    background: #23232e;
    height: 8vh;
    font-family: system-ui, -apple-system, Helvetica, Arial, sans-serif;
}



h1 {
    font-family: system-ui, -apple-system, Helvetica, Arial, sans-serif;
    letter-spacing: 15px;
    font-size: 40px;
    font-weight: bold;
}

h3 {
    font-size: 44px;
    padding-bottom: 70px;
}

.imagem {
  transition: transform 0.3s ease, box-shadow 0.3s ease; 
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}

.imagem:hover {
  transform: scale(1.05); 
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); 
}
</style>
</head>
<body>

<audio id="background-music" loop autoplay>
    <source src="audiobg1.mp3" type="audio/mpeg">
</audio>  

<header class="header">
    <div class="logo">
        <h1>HIDRATEC</h1>
    </div>
    <nav class="navigation">
    <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="produtos.php">Servicos</a></li>
            <li><a href="contrato.php">Agendados</a></li>
            <li><a href="carrinho.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg></li></a>
            <li><a href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>

<div style="padding: 50px; background-color: #f4f4f4;">
    <h2 style="margin: 0; color: #333;">Bem-vindo à Hidratec!</h2>
    <p style="margin: 0; color: #333;">Oferecemos os melhores serviços hidráulicos da cidade.</p>
</div>

<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">SOBRE A EMPRESA</h3>
  <div class="w3-row-padding w3-center" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-cogs w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">Instalações</p>
      <p>Realizamos serviços hidráulicos como ninguém, sem esquecer de nada (ao contrário de quem fez a última instalação da sua casa) não vamos te decepcionar!</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-wrench w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Manutenção</p>
      <p>A nossa manutenção hidráulica é quase mágica: problemas desaparecem, mas se o cano insistir em falhar, a culpa é dele, não nossa.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-tint w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Consultoria</p>
      <p>Com a nossa consultoria, vamos te ajudar a economizar com soluções inteligentes que nem a sua conta de água vai acreditar.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-exclamation-circle w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Emergências</p>
      <p>Emergência? Não tem problema! Chegamos antes que você perceba o estrago. Aqui, sua emergência é nossa diversão... Digo, prioridade!</p>
    </div>
  </div>
</div>

<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <div class="w3-row-padding">
    <div class="w3-col m6">
      <h3 style="padding-top: 60px;">Vamos consertar seu cano!</h3>
      <p style="font-size: 20px; font-weight: bold;">Que cano? você se pergunta, mas antes mesmo dessa sua pergunta ser concebida em sua mente nós já estaremos consertando seu problema hidráulico!</p>
    </div>
    <div class="w3-col m6">
      <img class="imagem" src="imagem1.png" alt="coiso" width="440" height="394">
    </div>
  </div>
</div>

<footer class="w3-center w3-black w3-padding-64">
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>

</body>
</html>