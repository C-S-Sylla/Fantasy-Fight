<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Fantasy Fight</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #505050;
            margin: 0;
            padding: 20px;
        }
        #menu-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: rgb(55, 55, 55);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            text-align: center;
            color: #c9c9c9;
        }
        #coin-counter {
            text-align: right;
            color: gold;
            font-size: 20px;
            margin-bottom: 20px;
        }
        #card-selection, #purchasable-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .card {
            width: 100px;
            height: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
            transition: transform 0.2s;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card.selected {
            border: 2px solid #4CAF50;
        }
.card.locked {
        filter: grayscale(100%);
    }
    .card p{
        color: rgb(255, 255, 255);
        text-shadow: 0.9px 0.9px 0 black, 0.9px -0.9px 0 black, -0.9px 0.9px 0 black, -0.9px -0.9px 0 black, 0.9px 0px 0 black, 0px 0.9px 0 black, -0.9px 0px 0 black, 0px -0.9px 0 black;;
    }
    .card h5{
        text-shadow: 0px 0px 2px white, 0 0 0.5em white;;

    }
    .card-ability {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0,0,0,0.65);
        color: white;
        font-size: 10px;
        padding: 2px;
        text-align: center;
    }
    .card-price {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: gold;
        color: black;
        padding: 2px 5px;
        border-radius: 10px;
        font-size: 12px;
    }
    #selected-cards {
        margin-top: 20px;
        text-align: center;
        color: #c9c9c9;
    }
    button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
</style>

</head>
<body>
    <div id="menu-container">
        <div id="coin-counter">
            <img src="/logo piece.png" alt="Logo Pièces" style="width: 20px; height: 20px; vertical-align: middle;"> <span id="coins"></span>
          </div>
        <h1>Menu - Fantasy Fight</h1>
        <h2>Cartes de base</h2>
        <div id="card-selection"></div>
        <h2>Cartes à acheter</h2>
        <div id="purchasable-cards"></div>
        <div id="selected-cards">Cartes sélectionnées: <span id="selected-count">0</span>/17</div>
        <button id="start-game">Commencer la partie</button>
        <button id="reset-selection">Réinitialiser la sélection</button>
    </div>
    <script>
        const SAVE_KEY = 'fantasyFightSave';
function loadSaveData() {
return false;

}
function saveGameData() {
const data = {
coins: playerCoins,
unlocked: Array.from(unlockedCards),
};
}
class Card {
constructor(name, attack, maxHp, imageSrc, ability = null, abilityDescription = "") {
this.name = name;
this.attack = attack;
this.maxHp = maxHp;
this.currentHp = maxHp;
this.imageSrc = imageSrc;
this.ability = ability;
this.abilityDescription = abilityDescription;
this.hasUsedAbility = false;
this.shield = 0;
}
}
const cardData = [
new Card("Guerrier", 7, 20, "/imm/guerrier.png"),
        new Card("Lyriena", 6, 15, "/imm/mage.png", null, "Inflige 3 dégâts"),
        new Card("Daraven", 8, 19, "/imm/assassin.png", null, "Multiplie ses ATK par 2 si elles sont supperieur á ses HP"),
        new Card("Tank", 4, 30, "/imm/tank.png", null, "Gain aléatoire : +(1-3) DF"),
        new Card("Archer", 6, 18, "/imm/archer.png"),
        new Card("Lunn", 3, 22, "/imm/lumm.png", null, "Donne 5 Humeurs"),
        new Card("Dracula", 9, 25, "/imm/dracula.png", null, "Drain de vie"),
        new Card("Rash", 8, 22, "/imm/garou.png", null, "Furie lunaire: +2 ATK"),
        new Card("Fée", 5, 8, "/imm/fee.png", null, "Poudre magique: +2 ATK au cartes en main"),
        new Card("Golem", 6, 35, "/imm/golem.png"),
        new Card("Sorcière", 7, 20, "/imm/sorciere.png", null, "Échange d'ATK"),
        new Card("Eldrin Sylvaris", 4, 8, "/imm/eldrinsylvaris.png", null, "Purifi: retire tous les effets de debuff."),
        new Card("Dragon", 20, 20, "/imm/dragon.png", null, "Souffle ardent: -2 HP, +3 ATK"),
        new Card("Elfe", 6, 20, "/imm/elfe.png", null, "Bénédiction pour tous"),
        new Card("Troll", 8, 25, "/imm/troll.png", null, "Régénération: +5 HP"),
        new Card("Xing", 5, 20, "/imm/xing.png",null, "Poudre magique: +6 ATK"),
        new Card("Seren", 5, 18, "/imm/sirene.png", null, "Chant envoûtant: -2 ATK"),
        new Card("Necaros", 9, 15, "/imm/necaros.png", null, "Ajoute un Squelette à la main de l'adversaire"),
        new Card("Jo-un", 8, 25, "/imm/joun.png",null, "Rachète la carte qu'il élimine lui-même avec 14 HP"),
        new Card("Nezoom", 8, 1, "/imm/nezoom.png",null, "Revit sous la forme de la carte qui l'a éliminée"),
        new Card("Mazhaf", 3, 18, "/imm/mazhaf.png", null, "Poison: -1 HP aux cartes adverses pendant 3 tours"),
        new Card("Clara", 4, 13, "/imm/clara.png", null, "Recupere 20% des HP de la carte adverse en HP et ATK"),
        new Card("Lola", 10, 7, "/imm/lola.png", null, "Redistribue la moitié de ses ATK à toute les cartes de la main"),
        new Card("Norlong", 11, 11, "/imm/norlong.png", null, "Sacrifi 25% de ses HP pour reduire l'ATK de la main adverse de 50%"),
        new Card("Civt", 11, 17, "/imm/civt.png", null, "Convertit 3 HP de sa cible en humeurs pour l'utilisateur"),
        new Card("Gilsiat", 9, 12, "/imm/gilsiat.png", null, "Attaque directement l'ennemi adverse avec 30% de ses ATK"),
        new Card("Kazin", 11, 16, "/imm/kazin.png", null, "Detruit la carte adverce qui lui survive avec moins de 4 HP"),
        new Card("Vilent", 6, 16, "/imm/Vilent.png", null, "Annule la capacité de la carte adverse"),
        new Card("Unili",3, 28, "/imm/unili.png", null, "Convertit chaque 3 points de dégâts subis en +1 ATK"),
        new Card("Moshein", 5, 14, "/imm/moshein.png", null, "Immobilise la carte adverse pour 1 tour"),
        new Card("Foaris", 3, 12, "/imm/foaris.png", null, "Gèle les cartes de la main adverse"),
        new Card("Rahhh", 6, 22, "/imm/rahhh.png", null, "+2 DEF à Foaris par carte briulées, sinon +10 DEF. Retire les Brulure"),
        new Card("Maz", 3, 21, "/imm/maz.png", null, "Brulure: -2 HP à toute les cartes adverse pandant 2 tours"),
        new Card("Quejis", 5, 17, "/imm/quejis.png", null, "Pour chaque carte adverse brulé +1 ATk et maintien la Brulure"),

        new Card("Zigan", 7, 19, "/imm/zigan.png", null, "A 50% de chance de donner aux cartes en main soit +4 Poisons, soit +70% ATK"),
        new Card("Muly", 3, 11, "/imm/muly.png", null, "Inflige 2 dégâts à 2 cartes de la main ennemie et inflige Brûlure si elles ont un debuff"),
        new Card("Eger", 17, 10, "/imm/eger.png", null, "Si White est dans le deck, le place au sommet"),
        new Card("White", 5, 16, "/imm/white.png", null, "Si Eger est dans la main, crée une carte Nitas et la place au sommet du deck"),
        new Card("Ereka", 7, 19, "/imm/ereka.png", null, "Restaure les HP des cartes en ayant perdu"),
        new Card("Layley", 7, 19, "/imm/layley.png", null, "Octroie 4 DF et 2 ATK à Endy s'il est dans la main"),
        new Card("Endy", 8, 18, "/imm/endy.png", null, "Octroie 4 ATK et 2 DF à Layley si elle est dans la main"),
        new Card("Jikem", 3, 3, "/imm/jikem.png", null, "Choisissez entre sa version sombre ou lumière et placez-la au sommet du deck"),
        new Card("Dawon", 6, 18, "/imm/dawon.png",null, "Reinitalise une capacité utilisé dans la main"),
        new Card("Eva", 10, 17, "/imm/eva.png", null, "Si l'adversaire joue sa carte la plus forte, ses ATK tombe à 0 et perd sa capacité pour ce combat"),
        new Card("Reneva", 10, 17, "/imm/reneva.png", null, "Si elle est detruite, elle revient avec la moitié de ses PV et ATK"),
        new Card("fear", 7, 197, "/imm/fear.png", null, "Si l'adversaire a plus d'ATK, il a 47% de chance de rater son attaque. Augmente de 3% par tour."),
        new Card("Aqua", 4, 13, "/imm/aqua.png", null, "Le 4ème emplacement gagne +1 ATK si aucun dégât reçu."),

       

    ];

    let playerCoins = 69;

const CARD_PRICE = 5;
// Puis la séparation des cartes
const basicCards = cardData.slice(0, cardData.findIndex(card => card.name === "Zigan"));
const purchasableCards = cardData.slice(cardData.findIndex(card => card.name === "Zigan"));
const cardSelection = document.getElementById('card-selection');
const purchasableCardsDiv = document.getElementById('purchasable-cards');
const selectedCount = document.getElementById('selected-count');
const startGameButton = document.getElementById('start-game');
const resetSelectionButton = document.getElementById('reset-selection');
const coinCounter = document.getElementById('coins');
let selectedCards = [];
    let unlockedCards = new Set();

    function updateCoinDisplay() {
        coinCounter.textContent = playerCoins;
    }

    function createCardElement(card, isPurchasable = false) {
const cardElement = document.createElement('div');
cardElement.className = 'card';

// Vérifier si c'est une des cartes qui doivent être achetées
const purchasableNames = ["Zigan", "Muly", "Eger", "White", "Ereka", "Layley", "Endy", "Jikem","Dawon","Eva","Reneva","fear", "Aqua"];
const requiresPurchase = purchasableNames.includes(card.name);

if (requiresPurchase) {
    cardElement.classList.add('purchasable');
    if (!unlockedCards.has(card.name)) {
        cardElement.classList.add('locked');
    }
}

cardElement.style.backgroundImage = `url(${card.imageSrc})`;

let cardContent = `
    <h5>${card.name}</h5>
    <p class="atk">ATK: ${card.attack}</p>
    <p class="hp">HP: ${card.maxHp}</p>
    ${card.abilityDescription ? `<div class="card-ability">${card.abilityDescription}</div>` : ''}
`;

if (requiresPurchase && !unlockedCards.has(card.name)) {
    cardContent += `<div class="card-price"><img src="/logo piece.png" alt="Logo Pièces" style="width: 20px; height: 20px; vertical-align: middle;"> ${CARD_PRICE}</div>`;
}

cardElement.innerHTML = cardContent;

cardElement.addEventListener('click', () => {
if (requiresPurchase && !unlockedCards.has(card.name)) {
    if (playerCoins >= CARD_PRICE) {
        playerCoins -= CARD_PRICE;
        unlockedCards.add(card.name);
        updateCoinDisplay();
        cardElement.classList.remove('locked');
        cardElement.querySelector('.card-price')?.remove();
        // Après l'achat, on peut sélectionner la carte
        toggleCardSelection(cardElement, card);
    }
} else {
    toggleCardSelection(cardElement, card);
}

});
return cardElement;

}
function initializeCardSelection() {
        loadSaveData();
        cardSelection.innerHTML = '';
        purchasableCardsDiv.innerHTML = '';
        
        basicCards.forEach(card => {
            const cardElement = createCardElement(card);
            cardSelection.appendChild(cardElement);
        });
        
        purchasableCards.forEach(card => {
            const cardElement = createCardElement(card, true);
            purchasableCardsDiv.appendChild(cardElement);
        });
        
        updateSelectedCount();
        updateCoinDisplay();
    }




    

    function toggleCardSelection(cardElement, card) {
        if (cardElement.classList.contains('selected')) {
            cardElement.classList.remove('selected');
            selectedCards = selectedCards.filter(c => c !== card);
        } else if (selectedCards.length < 17) {
            cardElement.classList.add('selected');
            selectedCards.push(card);
        }
        updateSelectedCount();
        saveGameData(); 
    }

    function updateSelectedCount() {
        selectedCount.textContent = selectedCards.length;
        startGameButton.disabled = selectedCards.length !== 17;
    }



    startGameButton.addEventListener('click', () => {
        if (selectedCards.length === 17) {
            const cardsToSave = selectedCards.map(card => ({
                name: card.name,
                attack: card.attack,
                hp: card.maxHp,
                imageSrc: card.imageSrc,
                abilityDescription: card.abilityDescription
            }));
            localStorage.setItem('selectedCards', JSON.stringify(cardsToSave));
            saveGameData();
            window.location.href = '/game';
        }
    });

    resetSelectionButton.addEventListener('click', () => {
        selectedCards = [];
        document.querySelectorAll('.card').forEach(cardElement => cardElement.classList.remove('selected'));
        updateSelectedCount();
        saveGameData();
    });

    initializeCardSelection();
</script>

</body>
</html>