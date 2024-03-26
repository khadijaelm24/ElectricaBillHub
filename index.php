<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>ElectricaBill Hub</title>
  </head>
  <body>
    <div class="container">
      <nav>
        <div class="nav__logo">
          <img src="assets/images/electrica.png" alt="logo">
        </div>
        <ul class="nav__links">
          <li class="link"><a href="#home">ACCEUIL</a></li>
          <li class="link"><a href="#about">A PROPOS</a></li>
          <li class="link"><a href="login.php">SE CONNECTER</a></li>
        </ul>
        <div class="search">
          <input type="text" placeholder="Rechercher" />
          <span><i class="ri-search-line"></i></span>
        </div>
        <div class="login">
          <span><i class="ri-user-3-fill"></i></span>
          <a href="login.php" class="lien">SE CONNECTER</a>
        </div>
      </nav>
      <div class="destination__container">
        <img class="bg__img__1" src="assets/images/bg-dots.png" alt="bg" />
        <img class="bg__img__2" src="assets/images/bg-arrow.png" alt="bg" />
        <div class="socials">
          <span><i class="ri-twitter-fill"></i></span>
          <span><i class="ri-facebook-fill"></i></span>
          <span><i class="ri-instagram-line"></i></span>
          <span><i class="ri-youtube-fill"></i></span>
        </div>
        <div class="content" id="home">
          <h1>LA GESTION DES FACTURES D'ELECTRICITE <br /> EST PLUS SIMPLE AVEC <br /><span>ELECTRICABILL HUB</span></h1>
          <p>
            Binvenue dans l'espace de gestion des consommations et factures d'électricité,
            ElectricaBill Hub, qui permet aux clients et fournisseurs de gérer
            les consommations, les factures et les réclamations. 
          </p>
          <button class="btn"><a href="login.php" class="lien">SE CONNECTER</a></button>
        </div>
        <div class="destination__grid" id="about">
          <div class="destination__card">
            <div class="card__content">
              <br><br><br>
              <h4>Client</h4>
              <br><br>
              <br>
              <ul>
                <li><p>Dépot rapide des consommations mensuels</p></li>
                <li><p>Possibilité de l'envoi successif des réclamations</p></li>
                <li><p>Réception rapide des réponses de traitements</p></li>
                <li><p>Consultation des factures après validation des consommations</p></li>
              </ul>
              <br><br><br><br>    
            </div>
          </div>
          <div class="destination__card">
            <div class="card__content">
              <br><br><br>
              <h4>Fournisseur</h4>
              <br><br>  
              <br>
              <ul>
                <li><p>Traitement efficace des consommations des clients</p></li>
                <li><p>Gestion délicate des consommations annuelles des clients</p></li>
                <li><p>Réponse rapide aux réclamations des clients</p></li>
                <li><p>Validation facile des informations des clients</p></li>
              </ul>
              <br><br><br><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
