<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Fight</title>
    <link rel="icon" href="favicon.png" type="image/x-icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: flex-start;
            background-color: #505050;
            /* Fond de page */
            background-image: url('/font.jpg');
            background-position: center;
        }
        #history-container {
            margin: 0;
            width: 300px;
            padding-left: 10px;
            padding-right: 10px;

            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-right: 20px;
           
        }
        #history-container h2 {
            font-size: 20px;
            margin-bottom: 1px;
            color: #333;
            text-align: center;
        }
        #history-list {
            list-style: none;
            padding: 0;
        }
        #history-list li {
            margin-bottom: 15px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f976;
        }
        .vs {
            margin: 0 8px;
            font-weight: bold;
            white-space: nowrap;
        }
                .battle-state {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .battle-state.before {
            color: #2196F3;
        }
        .battle-state.after {
            color: #4CAF50;
        }
        .card-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .ability-info {
            font-style: italic;
            color: #FF5722;
        }
        #game-container {
            width: 800px;
            height: 97%;
            background-size: cover;
            background-position: center;

            

            padding-right: 20px;
            padding-left: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #battlefield {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 200px;
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 10px;
            position: relative;
        }
        #player-hand {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .card {
            width: 100px;
            height: 200px;
            margin: 5px;
            padding: 5px;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            transition: transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card.selected {
            border: 2px solid #ff0000;
        }
        .card-ability {
            content: attr(data-ability);
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
        #status {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            position: relative;
        }
        .hp-bar-container {
            position: absolute;
            top: 0;
            height: 20px;
            background-color: #ddd;
            border-radius: 5px;
        }
        .player-hp-bar {
            left: 17%;
            width: 100px;
        }
        .ai-hp-bar {
            right: 17%;
            width: 100px;
        }
        .hp-fill {
            height: 100%;
            border-radius: 5px;
            background-color: rgb(255, 0, 251);
            width: 100%;
        }
        #status-text {
            position: relative;
            font-size: 18px;
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
        @keyframes clash {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
            100% { transform: translateX(0); }
        }
        .clash {
            animation: clash 0.5s ease-in-out;
        }
        .shield-container {
    position: absolute;
    bottom: 5px;
    right: 5px;
}
#ai-hand-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.9);
            padding: 20px;
            border-radius: 10px;
            z-index: 1000;
            max-width: 80%;
            max-height: 80vh;
            overflow-y: auto;
        }

        #ai-hand-display {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        #show-ai-hand-btn {
            position: fixed;
            top: 7px;
            right: 20px;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #show-ai-hand-btn:hover {
            background-color: #1976D2;
        }

        #close-ai-hand {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 16px;
        }

        .ai-card {
            background-color: white;
            border-radius: 5px;
            padding: 10px;
            width: 100px;
            margin: 5px;
            text-align: center;
        }

#go-to-menu {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px 20px;
    font-size: 16px;
    background-color: #2196F3;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#go-to-menu:hover {
    background-color: #1976D2;
}

/* Style de l'élément de liste (le conteneur principal) */
.history-item {
    position: relative; /* Indispensable pour positionner les images en fond */
    overflow: hidden;   /* Pour couper ce qui dépasse */
    border: 2px solid #444;
    border-radius: 8px;
    margin-bottom: 10px;
    padding: 0; /* Le padding sera géré par .history-content */
    box-shadow: 0 4px 6px rgba(0,0,0,0.3);
}

/* Conteneur des images de fond */
.history-bg-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex; /* Pour mettre les deux images côte à côte */
    z-index: 0;    /* Tout au fond */
}

/* Style commun aux deux images */
.history-bg-img {
    width: 50%;
    height: 100%;
    background-size: cover; 
    background-position: center 25%; 
}

/* Bordure de séparation au milieu */
.history-bg-img.left {
    border-right: 2px solid rgba(255, 255, 255, 0.3);
}

/* Le voile noir semi-transparent */
.history-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.5), rgba(0,0,0,0.3), rgba(0,0,0,0.5));
    z-index: 1;
}

/* Le contenu texte (passe au premier plan) */
.history-content {
    position: relative;
    z-index: 2; /* Au-dessus des images */
    padding: 10px;
    color: white;
    text-shadow: 1px 1px 3px black, 0 0 5px black; /* Ombre forte pour lisibilité */
    font-family: sans-serif;
}

/* Petits ajustements pour le texte */
.battle-state {
    font-weight: bold;
    color: #ffd700;
    font-size: 0.9em;
    margin-bottom: 2px;
    border-bottom: 1px solid rgba(255,255,255,0.3);
}

.card-info {
    display: flex;
    justify-content: space-between;
    font-size: 0.85em;
    margin-bottom: 5px;
}

.player-stat { color: #aaddff; }
.ai-stat { color: #ffaaaa; text-align: right; }
.vs { color: #aaa; font-weight: bold; margin: 0 5px; white-space: nowrap;}

.ability-info {
    font-size: 0.8em;
    font-style: italic;
    margin-top: 2px;
    padding: 2px 5px;
    border-radius: 4px;
    background: rgba(0,0,0,0.4);
}
.player-ability { border-left: 3px solid #aaddff; }
.ai-ability { border-right: 3px solid #ffaaaa; text-align: right; }
@keyframes poisonField {
    0% { 
        background:  url('/imm/theme/ppoison.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    50% { 
        background: url('/imm/theme/ppoison2.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    100% { 
        background:  url('/imm/theme/ppoison3.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
}

@keyframes poisonFieldFlipped {
    0% { 
        background: url('/imm/theme/rppoison.jpg'); 
        background-size: cover;
    }
    50% { 
        background: url('/imm/theme/rppoison2.jpg');
        background-size: cover;
    }
    100% { 
        background: url('/imm/theme/rppoison3.jpg');
        background-size: cover;
    }
}

@keyframes fireField {
    0% { 
        background: linear-gradient(rgba(255, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/bburn.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    50% { 
        background: linear-gradient(rgba(255, 0, 0, 0.3), rgba(0, 0, 0, 0.1)), url('/imm/theme/bburn.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    100% { 
        background: linear-gradient(rgba(255, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/bburn.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
}

@keyframes aceField {
    0% { 
        background: linear-gradient(rgba(0, 85, 255, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/aace.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    50% { 
        background: linear-gradient(rgba(0, 85, 255, 0.3), rgba(0, 0, 0, 0.1)), url('/imm/theme/aace.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    100% { 
        background: linear-gradient(rgba(0, 85, 255, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/aace.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
}

@keyframes marbreField {
    0% { 
        background: linear-gradient(rgba(255, 247, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/mmarbre.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    50% { 
        background: linear-gradient(rgba(255, 247, 0, 0.3), rgba(0, 0, 0, 0.1)), url('/imm/theme/mmarbre.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    100% { 
        background: linear-gradient(rgba(255, 247, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/imm/theme/mmarbre.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
}

@keyframes slashField {
    0% { 
        background:  url('/imm/theme/sslash69.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
    50% { 
        background:  url('/imm/theme/sslash70.jpg'); 
        background-size: cover; 
        background-position: center; 
    }
}
@keyframes slashFieldFlipped {
    0% { 
        background: url('/imm/theme/rsslash69.jpg');
        background-size: cover;
        background-position: center; 
    }
    50% { 
        background: url('/imm/theme/rsslash70.jpg');
        background-size: cover;
        background-position: center; 
    }
}

@keyframes dragonField {
    0% { background: linear-gradient(rgba(255, 165, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/font.jpg'); }
    50% { background: linear-gradient(rgba(255, 165, 0, 0.3), rgba(0, 0, 0, 0.1)), url('/font.jpg'); }
    100% { background: linear-gradient(rgba(255, 165, 0, 0.1), rgba(0, 0, 0, 0.1)), url('/font.jpg'); }
}

@keyframes healField {
    0%{ background:  url('/imm/theme/hheal.jpg');  background-size: cover;}
    50%{ background:  url('/imm/theme/hheal.jpg');   background-size: cover;}
}

@keyframes danceField {
    0%{ background:  url('/imm/theme/ddance.jpg');  background-size: cover;}
    50%{ background:  url('/imm/theme/ddance.jpg');   background-size: cover;}
}

#battlefield.poison-field {
    animation: poisonField 2s infinite;
}

#battlefield.fire-field {
    animation: fireField 2s infinite;
}

#battlefield.ghost-field {
    animation: ghostField 3s infinite;
}

#battlefield.dragon-field {
    animation: dragonField 2s infinite;
}

#battlefield.heal-field {
    animation: healField 2s infinite;
}
#battlefield.dance-field {
    animation: danceField 2s infinite;
}
#battlefield.ace-field {
    animation: aceField 2s infinite;
}
#battlefield.marbre-field {
    animation:marbreField 2s infinite;
}

#battlefield.slash-field {
    animation: slashField 0.1s infinite;
}

.background-flip {
    transform: scaleX(-1);
}
.background-flip .card {
    transform: scaleX(1);
}
#battlefield.poison-field.flipped { animation: poisonFieldFlipped 2s infinite; }
#battlefield.slash-field.flipped { animation: slashFieldFlipped 0.1s infinite; }
@keyframes stunnedCard {
    0% { filter: grayscale(0.4); }
    50% { filter: grayscale(1) brightness(1.1); }
    100% { filter: grayscale(0.4); }
}

.card.stunned {
    animation: stunnedCard 1s infinite;
}

/* Assurez-vous que l'animation s'applique même aux cartes sur le champ de bataille */
#battlefield .card.stunned {
    animation: stunnedCard 1s infinite;
}
    </style>
</head>
<body>
    <div id="history-container">
        <h2>Historique</h2>
        <ul id="history-list"></ul>
    </div>

    <div id="game-container">
        <div id="status">
            <div class="hp-bar-container player-hp-bar">
                <div class="hp-fill" id="player-hp-fill"></div>
            </div>
            <div id="status-text"></div>
            <div class="hp-bar-container ai-hp-bar">
                <div class="hp-fill" id="ai-hp-fill"></div>
            </div>
        </div>
        
        <div id="battlefield">
            <div id="ai-card"></div>
            <div id="player-card"></div>
        </div>
        <button id="show-ai-hand-btn">Voir la main de l'IA</button>
    
    <div id="ai-hand-container">
        <button id="close-ai-hand">X</button>
        <div id="ai-hand-display"></div>
    </div>
        <div id="player-hand"></div>
        <button id="play-turn">Jouer le tour</button>
    </div>
    <button id="go-to-menu">Menu</button>

    <script>
class Card {
    constructor(name, attack, hp, imageSrc, ability = null, abilityDescription = "") {
        this.name = name;
        this.originalAttack = attack;
        this.attack = attack;
        this.maxHp = hp;
        this.currentHp = hp; 
        this.imageSrc = imageSrc;
        this.ability = ability|| Player.getAbilityFunction(name);;
        this.abilityDescription = abilityDescription;
        this.originalAbilityDescription = abilityDescription;
        this.shield = 0;
        this.hasUsedAbility = false;
        this.curseCounter = 0;
        this.burnCount=0
        this.stunCounter = 0;
        this.isSilenced = false;
        this.nitasTurns = 0;
    }

    
    useAbility(target, owner, opponent) {
        if (this.ability && !this.isSilenced) {
            return this.ability(this, target, owner, opponent);
        }
    }


    createCardElement() {
        const cardElement = document.createElement('div');
        cardElement.className = 'card';
        cardElement.style.backgroundImage = `url(${this.imageSrc})`;
        cardElement.innerHTML = `
            <h5>${this.name}</h5>
            <p class="atk">ATK: ${this.attack}</p>
            <p class="hp">HP: ${Math.floor(this.currentHp)}${this.shield > 0 ? ` (DF${this.shield})` : ''}${this.curseCounter > 0 ? ` (Poison: ${this.curseCounter})` : ''}${this.burnCount > 0 ? ` (brule: ${this.burnCount})` : ''}</p>
            ${this.abilityDescription ? `<div class="card-ability">${this.abilityDescription}</div>` : ''}${this.stunCounter > 0 ? ' (Immobilisé)' : ''}
        `;
        this.applyColors(cardElement);
        this.applyTextShadow(cardElement);
        return cardElement;
    }

    applyColors(cardElement) {
        const atkElement = cardElement.querySelector('.atk');
        const hpElement = cardElement.querySelector('.hp');
        if (atkElement) {
            atkElement.style.color = this.attack > this.originalAttack ? 'green' : (this.attack < this.originalAttack ? 'darkred' : 'black');
        }
        if (hpElement) {
            hpElement.style.color = this.currentHp > this.maxHp ? 'green' : (this.currentHp < this.maxHp ? 'darkred' : 'black');
        }
    }

    applyTextShadow(cardElement) {
        const nameElement = cardElement.querySelector('h5');
        const atkElement = cardElement.querySelector('.atk');
        const hpElement = cardElement.querySelector('.hp');

        if (nameElement) { 
            
            nameElement.style.textShadow = '0px 0px 2px white, 0 0 0.5em white';

        }

        if (atkElement) {

            atkElement.style.textShadow = '0.9px 0.9px 0 black, 0.9px -0.9px 0 black, -0.9px 0.9px 0 black, -0.9px -0.9px 0 black, 0.9px 0px 0 black, 0px 0.9px 0 black, -0.9px 0px 0 black, 0px -0.9px 0 black';

            if (atkElement) {
            atkElement.style.color = this.attack > this.originalAttack ? 'green' : (this.attack < this.originalAttack ? 'red' : 'white');
        }
        }
        if (hpElement) {
           
            hpElement.style.textShadow = ' 0.9px 0.9px 0 black, 0.9px -0.9px 0 black, -0.9px 0.9px 0 black, -0.9px -0.9px 0 black, 0.9px 0px 0 black, 0px 0.9px 0 black, -0.9px 0px 0 black, 0px -0.9px 0 black';
            if (hpElement) {
            hpElement.style.color = this.currentHp > this.maxHp ? 'green' : (this.currentHp < this.maxHp ? 'red' : 'white');
        }
        }
    }

    updateCardElement(cardElement) {
        const atkElement = cardElement.querySelector('.atk');
        const hpElement = cardElement.querySelector('.hp');

        if (this.stunCounter > 0) {
            cardElement.classList.add('stunned');
        } else {
            cardElement.classList.remove('stunned');
        }
        this.currentHp = Math.round(this.currentHp);

        if (atkElement) {
            atkElement.textContent = `ATK: ${this.attack}`;
        }
        if (hpElement) {
            hpElement.textContent = `HP: ${Math.floor(card.currentHp)}${card.shield > 0 ? ` (DF${card.shield})` : ''}${card.curseCounter > 0 ? ` (Poison: ${card.curseCounter})` : ''}${card.burnCount > 0 ? ` (brule: ${card.burnCount})` : ''}`;
        }
        this.applyColors(cardElement);
        this.applyTextShadow(cardElement);
    }

    applyCurse() {
        if (this.curseCounter > 0) {
            this.currentHp = Math.max(1, this.currentHp - 1);
            this.curseCounter--;
        }
    }

    applyBurn() {
        if (this.burnCount > 0) {
            this.currentHp = Math.max(1, this.currentHp - 2);
            this.burnCount--;
        }
    }
}


class Player {
    constructor(name, isAI = false, selectedCards = []) {
        this.name = name;
        this.isAI = isAI;
        this.hp = 100;
        this.hand = [];
        this.field = null;
        

        // Utilisez les cartes sélectionnées si elles sont fournies, sinon utilisez le deck par défaut
        this.deck = this.createDeckFromSelectedCards(selectedCards);
        this.shuffleDeck();
    }
    

    createDeckFromSelectedCards(selectedCards) {
        return selectedCards.map(card => new Card(
            card.name, 
            card.attack, 
            card.hp, 
            card.imageSrc, 
            Player.getAbilityFunction(card.name), 
            card.abilityDescription
        ));
    }

    static getAbilityFunction(cardName) {
        const abilityFunctions = {
            "Lyriena": (self, target) => { target.currentHp -= 3; },
            "Daraven": (self, target) => { if (self.attack >= self.currentHp) self.attack *= 2; },
            "Tank": (self, target, owner) => { const shieldValue = Math.floor(Math.random() * 3) + 1; owner.hand.forEach(card => card.shield += shieldValue); },
            "Lunn": (self, target, owner) => { owner.hp += 5; },
            "Dracula": (self, target) => { self.currentHp += Math.trunc(target.currentHp / 4); target.currentHp -= Math.trunc(target.currentHp / 4); },
            "Rash": (self) => { self.attack += 2; },
            "Fée": (self, target, owner) => { owner.hand.forEach(card => card.attack += 2); },
            "Sorcière": (self, target) => { if (!self.hasUsedAbility) { [self.attack, target.attack] = [target.attack, self.attack]; self.hasUsedAbility = true;} self.abilityDescription = "capacité utilisée" },
            "Eldrin Sylvaris": (self, target, owner) => {owner.hand.forEach(card => { card.curseCounter = 0;card.burnCount = 0;card.stunCounter = 0});},
            "Dragon": (self) => { self.currentHp -= 2; self.attack += 3; },
            "Elfe": (self, target) => { self.currentHp += 3; target.currentHp += 3; },
            "Troll": (self) => { if (!self.hasUsedAbility) self.currentHp += 5; self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"},
            "Xing": (self, target, owner) => { if (owner.hand.length > 0) owner.hand[Math.floor(Math.random() * owner.hand.length)].attack += 6; },
            "Seren": (self, target) => { target.attack = Math.max(0, target.attack - 2); },
            "Necaros": (self, target, owner, opponent) => { const squeletteCard = new Card("Squelette", 1, 1, "imm/squelette.png"); opponent.drawSpecificCard(squeletteCard); },
            "Jo-un": (self, target, owner, opponent) => {if (target.currentHp + target.shield <= self.attack) {const copiedCard = new Card(target.name,target.attack,14,target.imageSrc,Player.getAbilityFunction(target.name),target.abilityDescription);if (owner.hand.length < 5) {owner.hand.push(copiedCard);} else {owner.deck.push(copiedCard);}}},
            "Nezoom": (self, target, owner, opponent) => {if(self.currentHp < target.attack - self.shield) { const copiedCard = new Card(target.name,target.attack,target.maxHp,target.imageSrc,Player.getAbilityFunction(target.name),target.abilityDescription);owner.hand.push(copiedCard);}},
            "Mazhaf": (self, target, owner, opponent) => { opponent.hand.forEach(card => { card.curseCounter += 3;});},
            "Clara": (self, target) => { self.attack += Math.trunc(target.currentHp * 0.20); self.currentHp += Math.trunc(target.currentHp * 0.20); target.currentHp -= Math.trunc(target.currentHp * 0.20); },
            "Lola": (self, target, owner) => { const boostAmount = Math.ceil(self.attack / 2); owner.hand.forEach(card => card.attack += boostAmount); self.attack=Math.trunc(self.attack /= 2);},
            "Norlong": (self, target, owner, opponent) => { self.currentHp -= Math.trunc(self.currentHp * 0.25); opponent.hand.forEach(card => { card.attack = Math.max(0, card.attack - Math.trunc(self.currentHp * 0.50));});},
            "Civt": (self, target,owner) => { target.currentHp -= 3; owner.hp += 3; },
            "Gilsiat": (self, target,owner, opponent) => { opponent.hp -= Math.trunc(self.attack * 0.30); },
            "Kazin": (self, target) => { if (target.currentHp+target.shield <= 4+self.attack && target.currentHp+target.shield>=self.attack) target.currentHp = self.attack;  },
            "Vilent": (self, target) => {if (!self.hasUsedAbility) {target.ability = null;target.isSilenced = true;target.abilityDescription = "Capacité annulée";target.hasUsedAbility = true;self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}},
            "Unili": (self, target) => { const damagesTaken = target.attack+self.shield ; const bonusAttack = Math.trunc(damagesTaken / 3);self.attack = self.attack + bonusAttack;},
            "Moshein": (self, target) => { target.stunCounter += 2; },
            "Foaris": (self, target, owner, opponent) => {if (!self.hasUsedAbility) { opponent.hand.forEach(card => { if (card !== opponent.field) { card.stunCounter += 2;}});self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}},
            "Quejis": (self, target, owner, opponent) => {let burnedCount = 0;for (let card of opponent.hand) {if (card.burnCount > 0) {burnedCount++;}}if (target.burnCount > 0) {burnedCount++;}self.attack += burnedCount;opponent.hand.forEach(card => {if (card.burnCount > 0) {card.burnCount += 1;}});if (target.burnCount > 0) {target.burnCount += 1;}},
            "Maz": (self, target, owner, opponent) => { opponent.hand.forEach(card => { card.burnCount += 2;}); target.burnCount += 2;},
            "Rahhh": (self, target, owner, opponent) => {if (!self.hasUsedAbility) {let burnedCardCount = 0;let foarisCard = null;owner.hand.forEach(card => {if (card.name === "Foaris") {foarisCard = card;}if (card.burnCount > 0) {burnedCardCount++;}});if (self.burnCount > 0) {burnedCardCount++;}if (foarisCard && burnedCardCount > 0) {foarisCard.shield += burnedCardCount * 2;} else {self.shield += 10;}owner.hand.forEach(card => { card.burnCount = 0; });self.burnCount = 0;self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée";}},
            "Zigan": (self, target, owner, opponent) => {if (!self.hasUsedAbility)  {const chance = Math.floor(Math.random()*2);if (chance ==1){owner.hand.forEach(card => { card.curseCounter += 4;});} else {owner.hand.forEach(card =>  card.attack =Math.floor( card.attack*1.7));self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}},
            "Muly": (self, target, owner, opponent) => {let targetableCards = [...opponent.hand];for (let i = 0; i < 2 && targetableCards.length > 0; i++) {const randomIndex = Math.floor(Math.random() * targetableCards.length);const selectedCard = targetableCards[randomIndex];if (selectedCard.currentHp <= 2) {selectedCard.currentHp = 1;} else {selectedCard.currentHp -= 2;}if (selectedCard.curseCounter > 0 || selectedCard.stunCounter > 0 || selectedCard.burnCount > 0) {selectedCard.burnCount += 1;}targetableCards.splice(randomIndex, 1);}},
            "Eger": (self, target, owner, opponent) => {if (!self.hasUsedAbility) {const whiteIndex = owner.deck.findIndex(card => card.name === "White");if (whiteIndex !== -1) {const whiteCard = owner.deck.splice(whiteIndex, 1)[0];owner.deck.push(whiteCard);self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}},
            "White": (self, target, owner, opponent) => {if (!self.hasUsedAbility)  {const hasEger = owner.hand.some(card => card.name === "Eger");if (hasEger) {const nitasCard = new Card("Nitas",14, 1,  "imm/nitas.png",  Player.getAbilityFunction("Nitas"),`N'est pas affecté par l'attaque normale de l'adversaire pour ${7-self.nitasTurns} toures`);owner.deck.push(nitasCard);self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}},
            "Ereka": (self, target, owner, opponent) => {if (!self.hasUsedAbility) {owner.hand.forEach(card => {if (card.currentHp < card.maxHp) {card.currentHp = card.maxHp;}});self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}},
            "Nitas": (self, target, owner, opponent) => {if (self.nitasTurns >= 7) {self.abilityDescription = "Capacité utilisé";} else if (self.nitasTurns > 0) {self.abilityDescription = `N'est pas affecté par l'attaque normale de l'adversaire pour ${7-self.nitasTurns} toures`;} else {self.abilityDescription = self.originalAbilityDescription;}},
            "White": (self, target, owner, opponent) => {if (!self.hasUsedAbility)  {const hasEger = owner.hand.some(card => card.name === "Eger");if (hasEger) {const nitasCard = new Card("Nitas",14, 1,  "/imm/nitas.png",  Player.getAbilityFunction("Nitas"),`N'est pas affecté par l'attaque normale de l'adversaire pour ${7-self.nitasTurns} toures`);owner.deck.push(nitasCard);self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}},
            "Layley": (self, target, owner) => {owner.hand.forEach(card => {if (card.name === "Endy") {card.shield += 4; card.attack +=2}});},
            "Endy": (self, target, owner) => {owner.hand.forEach(card => {if (card.name === "Layley") {card.attack += 4; card.shield += 2;}});},
            "Jikem lumiere": (self, target, owner, opponent) => {while(opponent.hand.length > 0) {opponent.deck.push(opponent.hand.pop());}opponent.deck.sort(() => Math.random() - 0.5);for(let i = 0; i < 4; i++) {opponent.drawCard();}},
            "Jikem sombre": (self, target, owner, opponent) => {const aiHandContainer = document.getElementById('ai-hand-container');const aiHandDisplay = document.getElementById('ai-hand-display');if (!owner.isAI) {aiHandDisplay.innerHTML = '';const targetHeader = document.createElement('div');aiHandDisplay.appendChild(targetHeader);const handHeader = document.createElement('div');aiHandDisplay.appendChild(handHeader);opponent.hand.forEach(card => {const cardElement = card.createCardElement();aiHandDisplay.appendChild(cardElement);});const targetCardElement = target.createCardElement();aiHandDisplay.appendChild(targetCardElement);aiHandContainer.style.display = 'block';setTimeout(() => {aiHandContainer.style.display = 'none';}, 7000);} else {}},
            "Jikem": (self, target, owner, opponent) => {if (!self.hasUsedAbility && !owner.isAI) {const modalContainer = document.createElement('div');modalContainer.style.cssText = `position: fixed;top: 0;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.7);display: flex;justify-content: center;align-items: center;z-index: 1000;`;const modalContent = document.createElement('div');modalContent.style.cssText = `background-color: white;padding: 20px;border-radius: 10px;max-width: 80%;max-height: 80vh;overflow-y: auto;`;const title = document.createElement('h3');title.textContent = 'Choisissez une carte à placer au sommet du deck';title.style.marginBottom = '20px';const cardDisplay = document.createElement('div');cardDisplay.style.cssText = `display: flex;flex-wrap: wrap;justify-content: center;gap: 10px;`;const jikemLumiereCard = new Card("Jikem lumiere", 4, 7, "/imm/jikeml.png", Player.getAbilityFunction("Jikem lumiere"), "Place les cartes adverses dans son deck et en fait tirer 4");const JikemSombreCard = new Card("Jikem sombre", 5, 8, "/imm/jikems.png", Player.getAbilityFunction("Jikem sombre"), "Révèle les cartes adverses");const cardOptions = [jikemLumiereCard, JikemSombreCard];cardOptions.forEach(card => {const cardElement = card.createCardElement();cardElement.style.cursor = 'pointer';cardElement.addEventListener('click', () => {owner.deck.push(card);modalContainer.remove();self.hasUsedAbility = true;self.abilityDescription = `A choisi ${card.name}`;});cardDisplay.appendChild(cardElement);});modalContent.appendChild(title);modalContent.appendChild(cardDisplay);modalContainer.appendChild(modalContent);document.body.appendChild(modalContainer);} if (!self.hasUsedAbility && owner.isAI) {const jikemLumiereCard = new Card("Jikem lumiere", 4, 7, "imm/jikeml.png", Player.getAbilityFunction("Jikem lumiere"), "Place les cartes adverses dans son deck et en fait tirer 4");const jikemSombreCard = new Card("Jikem sombre", 5, 8, "imm/jikems.png", Player.getAbilityFunction("Jikem sombre"), "Révèle les cartes adverses");const randomChoice = Math.random() > 0.5 ? jikemLumiereCard : jikemSombreCard;owner.deck.push(randomChoice);self.hasUsedAbility = true;}},
            "Dawon": (self, target, owner, opponent) => {if (!owner.isAI) {if (!self.hasUsedAbility) {const modalContainer = document.createElement('div');modalContainer.style.cssText = `position: fixed;top: 0;left: 0;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.7);display: flex;justify-content: center;align-items: center;z-index: 1000;`;const modalContent = document.createElement('div');modalContent.style.cssText = `background-color: white;padding: 20px;border-radius: 10px;max-width: 80%;max-height: 80vh;overflow-y: auto;`;const cardDisplay = document.createElement('div');cardDisplay.style.cssText = `display: flex;flex-wrap: wrap;justify-content: center;gap: 10px;`;const usedAbilityCards = owner.hand.filter(card => card.hasUsedAbility && card.abilityDescription !== "Capacité annulée");usedAbilityCards.forEach(card => {const cardElement = card.createCardElement();cardElement.style.cursor = 'pointer';cardElement.addEventListener('click', () => {card.hasUsedAbility = false;card.isSilenced = false;card.abilityDescription = card.originalAbilityDescription;modalContainer.remove();self.hasUsedAbility = true;self.abilityDescription = "Capacité utilisée";});cardDisplay.appendChild(cardElement);});if (usedAbilityCards.length === 0) {} else {modalContent.appendChild(cardDisplay);modalContainer.appendChild(modalContent);document.body.appendChild(modalContainer);self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}} else {if (!self.hasUsedAbility) {const usedAbilityCards = owner.hand.filter(card => card.hasUsedAbility && card.abilityDescription !== "Capacité annulée");if (usedAbilityCards.length > 0) {const cardToReset = usedAbilityCards[Math.floor(Math.random() * usedAbilityCards.length)];cardToReset.hasUsedAbility = false;cardToReset.isSilenced = false;cardToReset.abilityDescription = cardToReset.originalAbilityDescription;self.hasUsedAbility = true;}self.hasUsedAbility = true;self.abilityDescription = "capacité utilisée"}}},
            "Eva": (self, target, owner, opponent) => {if (!target) return;let isStrongestOrTied = true;if (opponent.hand.length > 0) {for (const cardInHand of opponent.hand) {if (cardInHand.attack > target.attack) {isStrongestOrTied = false;break;}}}if (isStrongestOrTied) {target.originalAttackBeforeEvaDebuff = target.attack;target.attack = 0;target.isSilenced = true;target.abilityDescription = "Capacité annulée";target.hasUsedAbility = true;target.wasDebuffedByEva = true;}},
            "Reneva": (self, target, owner, opponent) => { /*dans  la verification des morts*/ },
"fear": (self, target, owner, opponent) => {
    if (!target) return;
    // initialise la chance si nécessaire (50%)
    if (typeof self.fearChance === 'undefined') self.fearChance = 0.47;
    self.fearChance = Math.min(1, self.fearChance + 0.03);

    if (target.attack > self.attack) {
        if (Math.random() < self.fearChance) {
            // sauvegarde l'ATK pour ce combat et la met à 0
            target._fearOriginalAttack = target.attack;
            target.attack = 0;
            target._wasMissedByFear = true;
        }
    }
            self.abilityDescription = `Si l'adversaire a plus d'ATK, ${Math.round(self.fearChance * 100)}% de chance de rater son attaque. augmente de 3% par tour.`;

},
"Aqua": (self, target, owner) => {
    if (!self.hasUsedAbility) {
        owner.hasAquaBuff = true; 
        self.hasUsedAbility = true;
        self.abilityDescription = "Bénédiction Aqua active";
    }
},




            
};

  function copyCard(card, getAbilityFunction) {
    const copiedCard = new Card(
        card.name,
        card.attack,
        card.maxHp,
        card.imageSrc,
        getAbilityFunction(card.name),
        card.abilityDescription
    );
    

    return copiedCard;
}


        return abilityFunctions[cardName] || null;
    }
    

    shuffleDeck() {
        this.deck.sort(() => Math.random() - 0.5);
    }
    

    drawCard() {
         if (this.disableDraw) return
        if (this.hand.length < 5 && this.deck.length > 0) {
            
            let drawnCard = this.deck.pop();
            
            // Vérifiez si la carte tirée est un squelette
            if (drawnCard.name === "Squelette") {
                // Ajoutez le squelette directement à la main
                this.hand.push(drawnCard);
            } else {
                // Sinon, ajoutez la carte normale
                this.hand.push(drawnCard);
                
            }
            if (!this.isAI) {
    playDrawSound(drawnCard.name);
        }
    }
    }

    drawSpecificCard(card) {
        if (this.hand.length < 5) {
            this.hand.push(card);
            
            
        } else {
            this.deck.push(card);
        }
    }


playCard(index) {
        if (index >= 0 && index < this.hand.length) {
            const selectedCard = this.hand[index];
            if (selectedCard.stunCounter <=0)
            this.field = this.hand.splice(index, 1)[0];
        }
    }

    returnCardToHand() {
        
        if (this.field) {
            this.field.isSilenced=false;
            if (this.field.wasDebuffedByEva) {
                console.log(`Nettoyage flag Eva sur ${this.field.name}`);
                delete this.field.wasDebuffedByEva;
            }
            if (this.hand.length < 5) {
                this.hand.push(this.field);
            } else {
                this.deck.push(this.field);
            }
            this.field = null;
        }
    }
    

    applyCurseToHand() {
        this.hand.forEach(card => card.applyCurse());
    }

    applyBurnToHand() {
        this.hand.forEach(card => card.applyBurn());
    }
    
}


function chooseCard(hand) {
    if (hand.length === 0) return null;
    return hand[Math.floor(Math.random() * hand.length)];
}


let game;
let musicStarted = false; 

function initializeGame() {
    const selectedCards = JSON.parse(localStorage.getItem('selectedCards')) || [];
    if (selectedCards.length === 17) {
        game = new Game(selectedCards);
         // Vérifier que game existe bien et que game.player existe aussi avant d'appeler la musique
       
    } else {
        // Rediriger vers le menu si aucune carte n'est sélectionnée
        window.location.href = '/menu';
        return;
    }
    if (game) {
        game.updateUI();
    }
   
}


window.addEventListener('DOMContentLoaded', () => {
    // Charger les scripts externes
    const scriptTheme = document.createElement('script');
    scriptTheme.src = "/themesong.js";
    document.head.appendChild(scriptTheme);

    const scriptSong = document.createElement('script');
    scriptSong.src = "/song.js";
    document.head.appendChild(scriptSong);

    // Attendre que les DEUX scripts soient chargés avant d'initialiser
    let scriptsLoaded = 0;
    const totalScripts = 2;

    const checkScripts = () => {
        scriptsLoaded++;
        if (scriptsLoaded === totalScripts) {
            if (typeof jouerMusique !== 'function') {
                console.error("La fonction jouerMusique n'est pas définie ! Vérifiez themesong.js ou song.js.");
            }
            initializeGame();
             // NE PAS appeler jouerMusique() ici non plus
        }
    };

    scriptSong.onload = checkScripts;
    scriptTheme.onload = checkScripts;
    scriptSong.onerror = () => console.error("Erreur de chargement de song.js");
    scriptTheme.onerror = () => console.error("Erreur de chargement de themesong.js");

});


class Game {
    checkAndFixHandHealth(player) {
        player.hand.forEach(card => {
            if (card.currentHp <= 0) {
                card.currentHp = 1;
            }
        });
    }
    
    constructor(selectedCards) {
        this.player = new Player("Joueur", false, selectedCards);
        this.ai = new Player("IA", true, selectedCards); // L'IA utilise aussi les cartes sélectionnées
        this.battleHistory = [];
        this.initializeHands();
        this.updateUI();
        this.turnCounter = 0;


        document.getElementById('show-ai-hand-btn').addEventListener('click', () => {
            const aiHandContainer = document.getElementById('ai-hand-container');
            const aiHandDisplay = document.getElementById('ai-hand-display');
            aiHandDisplay.innerHTML = '';
            
            game.ai.hand.forEach(card => {
                const cardElement = card.createCardElement();
                aiHandDisplay.appendChild(cardElement);
            });
            
            aiHandContainer.style.display = 'block';
        });

        document.getElementById('close-ai-hand').addEventListener('click', () => {
            document.getElementById('ai-hand-container').style.display = 'none';
        });

        // Fermer la fenêtre si on clique en dehors
        window.addEventListener('click', (e) => {
            const aiHandContainer = document.getElementById('ai-hand-container');
            if (e.target === aiHandContainer) {
                aiHandContainer.style.display = 'none';
            }
        });
    }

    initializeHands() {
        for (let i = 0; i < 5; i++) {
            this.player.drawCard();
            this.ai.drawCard();
        }
    }
    

    async playTurn() {
        this.checkAndFixHandHealth(this.player);
        this.checkAndFixHandHealth(this.ai);

        // Mémoriser l'ID de la carte sélectionnée (pour la resélectionner même si la main change)
        let selectedCardId = null;
        const selectedCard = document.querySelector('#player-hand .card.selected');
        if (selectedCard) {
            selectedCardId = selectedCard.getAttribute('data-unique-id');
            const index = Array.from(selectedCard.parentNode.children).indexOf(selectedCard);
            const playerSelectedCard = this.player.hand[index];
            if (playerSelectedCard.stunCounter > 0) {
                const playButton = document.getElementById('play-turn');
                playButton.textContent = "Carte immobilisée !";
                playButton.style.backgroundColor = "#ff0000";
                setTimeout(() => {
                    playButton.textContent = "Jouer le tour";
                    playButton.style.backgroundColor = "";
                }, 2000);
                return;
            }
        }

        this.turnCounter++;

        // Apply curse effect at the start of each turn
        this.player.applyCurseToHand();
        this.ai.applyCurseToHand();
        this.player.applyBurnToHand();
        this.ai.applyBurnToHand();

        this.checkAndFixHandHealth(this.player);
        this.checkAndFixHandHealth(this.ai);
        // Capture des stats avant le combat
        let playerCardStats = null;
        let aiCardStats = null;

        if (selectedCard) {
            const index = Array.from(selectedCard.parentNode.children).indexOf(selectedCard);
            const card = this.player.hand[index];
            playerCardStats = {
                name: card.name,
                attack: card.attack,
                currentHp: card.currentHp,
                shield: card.shield,
                abilityDescription: card.abilityDescription,
                imageSrc: card.imageSrc
            };
            this.player.playCard(index);
        }

        if (this.ai.hand.length > 0) {
            const playableCards = this.ai.hand.filter(card => card.stunCounter <= 0);
            if (playableCards.length > 0) {
                const randomIndex = Math.floor(Math.random() * playableCards.length);
                const selectedCardForAI = playableCards[randomIndex];
                const originalIndex = this.ai.hand.indexOf(selectedCardForAI);
                aiCardStats = {
                    name: selectedCardForAI.name,
                    attack: selectedCardForAI.attack,
                    currentHp: selectedCardForAI.currentHp,
                    shield: selectedCardForAI.shield,
                    abilityDescription: selectedCardForAI.abilityDescription,
                    imageSrc: selectedCardForAI.imageSrc
                };
                this.ai.playCard(originalIndex);
            }
        }

        if (this.player.field && this.ai.field) {
            await this.resolveCardCombat();
            this.updateBattleHistory(this.player.field, this.ai.field, playerCardStats, aiCardStats);
            this.handleCardDestruction();
            this.updateUI();
            await new Promise(resolve => setTimeout(resolve, 1000));
            this.player.returnCardToHand();
            this.ai.returnCardToHand();
        }

        if (this.player.hand.length < 5) this.player.drawCard();
        if (this.ai.hand.length < 5) this.ai.drawCard();

        this.player.hand.forEach(card => {
            if (card.stunCounter > 0) card.stunCounter--;
        });
        this.ai.hand.forEach(card => {
            if (card.stunCounter > 0) card.stunCounter--;
        });

        // Après la phase de combat, mémoriser la dernière sélection persistante
        if (selectedCardId) {
            localStorage.setItem('lastSelectedCardId', selectedCardId);
        }
        this.updateUI(undefined, selectedCardId);
    }
    handleDeadCards() {
        // Gérer les cartes mortes du joueur
        this.player.hand = this.player.hand.filter(card => card.currentHp > 0);
        while (this.player.hand.length < 5 && this.player.deck.length > 0) {
            this.player.drawCard();
        }

        // Gérer les cartes mortes de l'IA
        this.ai.hand = this.ai.hand.filter(card => card.currentHp > 0);
        while (this.ai.hand.length < 5 && this.ai.deck.length > 0) {
            this.ai.drawCard();
        }
    }
    


async resolveCardCombat() {
        const playerCard = this.player.field;
        const aiCard = this.ai.field;

        // Gestion des capacités spéciales
        if (aiCard && !aiCard.isSilenced) {
            aiCard.useAbility(playerCard, this.ai, this.player);
        }
        if (playerCard && !playerCard.isSilenced) {
            playerCard.useAbility(aiCard, this.player, this.ai);
        }

        const playerShieldBeforeDamage = playerCard.shield;
        const aiShieldBeforeDamage = aiCard.shield;
        const incomingDamageToPlayer = aiCard.attack;
        const incomingDamageToAI = playerCard.attack;

        const playerShieldDamageTaken = Math.min(playerShieldBeforeDamage, incomingDamageToPlayer);
        const aiShieldDamageTaken = Math.min(aiShieldBeforeDamage, incomingDamageToAI);

        playerCard.shield -= playerShieldDamageTaken;
        aiCard.shield -= aiShieldDamageTaken;

        // Dégâts subis par LA CARTE
        let playerHpDamage = Math.max(0, incomingDamageToPlayer - playerShieldBeforeDamage);
        let aiHpDamage = Math.max(0, incomingDamageToAI - aiShieldBeforeDamage);

        // Gestion Nitas
        if (playerCard.name === "Nitas" && playerCard.nitasTurns < 7 && !playerCard.isSilenced) {
            if (incomingDamageToPlayer > playerShieldBeforeDamage) {
                playerHpDamage = 0;
                playerCard.nitasTurns++;
                playerCard.abilityDescription = `N'est pas affecté par l'attaque normale de l'adversaire pour ${7 - playerCard.nitasTurns} toures`;
            }
        }
        if (playerCard.name === "Nitas" && playerCard.nitasTurns >= 7) {
            playerCard.abilityDescription = "Capacité utilisée";
        }

        if (aiCard.name === "Nitas" && aiCard.nitasTurns < 7 && !aiCard.isSilenced) {
            if (incomingDamageToAI > aiShieldBeforeDamage) {
                aiHpDamage = 0;
                aiCard.nitasTurns++;
                aiCard.abilityDescription = `N'est pas affecté par l'attaque normale de l'adversaire pour ${7 - aiCard.nitasTurns} toures`;
            }
        }
        if (aiCard.name === "Nitas" && aiCard.nitasTurns >= 7) {
            aiCard.abilityDescription = "Capacité utilisée";
        }

        // Application des dégâts
        playerCard.currentHp -= playerHpDamage;
        aiCard.currentHp -= aiHpDamage;


        if (this.player.hasAquaBuff) {

            if (playerCard.currentHp >= 0) {
                if (this.player.hand[3]) {
                    this.player.hand[3].attack += 1;
                }
            }
        }


        const playerCardElement = document.getElementById('player-card').querySelector('.card');
        const aiCardElement = document.getElementById('ai-card').querySelector('.card');
        if (playerCardElement) playerCardElement.classList.add('clash');
        if (aiCardElement) aiCardElement.classList.add('clash');

        const battlefield = document.getElementById('battlefield');
        battlefield.classList.remove('opponent-animation');
        if (aiCard) {
            battlefield.classList.add('opponent-animation');
        }

        this.updateUI();

        await new Promise(resolve => setTimeout(resolve, 500));
    }

    updateBattleHistory(playerCard, aiCard, playerCardBefore, aiCardBefore) {
        const historyList = document.getElementById('history-list');

        // Nouvelle structure avec arrière-plan dynamique
        const battleResult = `
            <div class="history-bg-container">
                <!-- Image du joueur (Gauche) -->
                <div class="history-bg-img left" style="background-image: url('${playerCardBefore.imageSrc}');"></div>
                <!-- Image de l'IA (Droite) -->
                <div class="history-bg-img right" style="background-image: url('${aiCardBefore.imageSrc}');"></div>
                <!-- Voile noir pour la lisibilité du texte -->
                <div class="history-overlay"></div>
            </div>

            <div class="history-content">
                <div class="battle-state before">Avant:</div>
                <div class="card-info">
                    <span class="player-stat">${playerCardBefore.name} (ATK: ${playerCardBefore.attack}, HP: ${playerCardBefore.currentHp}${playerCardBefore.shield > 0 ? `, DF: ${playerCardBefore.shield}` : ''})</span>
                    <span class="vs">VS</span>
                    <span class="ai-stat">${aiCardBefore.name} (ATK: ${aiCardBefore.attack}, HP: ${aiCardBefore.currentHp}${aiCardBefore.shield > 0 ? `, DF: ${aiCardBefore.shield}` : ''})</span>
                </div>
                
                <div class="battle-state after">Après:</div>
                <div class="card-info">
                    <span class="player-stat">${playerCard.name} (ATK: ${playerCard.attack}, HP: ${Math.floor(playerCard.currentHp)}${playerCard.shield > 0 ? `, DF: ${playerCard.shield}` : ''})</span>
                    <span class="vs">|</span>
                    <span class="ai-stat">${aiCard.name} (ATK: ${aiCard.attack}, HP: ${Math.floor(aiCard.currentHp)}${aiCard.shield > 0 ? `, DF: ${aiCard.shield}` : ''})</span>
                </div>
                ${playerCard.abilityDescription ? `<div class="ability-info player-ability">${playerCard.name}: ${playerCard.abilityDescription}</div>` : ''}
                ${aiCard.abilityDescription ? `<div class="ability-info ai-ability">${aiCard.name}: ${aiCard.abilityDescription}</div>` : ''}
            </div>
        `;

        this.battleHistory.unshift(battleResult);

        if (this.battleHistory.length > 3) {
            this.battleHistory.pop();
        }

        historyList.innerHTML = this.battleHistory.map(result => `<li class="history-item">${result}</li>`).join('');
    }

    

handleCardDestruction() {
    // Désactive la pioche pendant le traitement Reneva
    this.disableDraw = true;

    // Sauvegarde les références avant suppression
    const playerDeadCard = this.player.field && this.player.field.currentHp <= 0 ? this.player.field : null;
    const aiDeadCard = this.ai.field && this.ai.field.currentHp <= 0 ? this.ai.field : null;

    if (this.player.field && this.ai.field && this.player.field.currentHp <= 0 && this.ai.field.currentHp <= 0) {
        this.player.hp += this.player.field.currentHp;
        this.ai.hp += this.ai.field.currentHp;
        this.player.field = null;
        this.ai.field = null;
        this.player.drawCard();
        this.ai.drawCard();
    } else if (this.player.field && this.player.field.currentHp <= 0) {
        this.player.hp += this.player.field.currentHp;
        this.player.field = null;
        this.player.drawCard();
    } else if (this.ai.field && this.ai.field.currentHp <= 0) {
        this.ai.hp += this.ai.field.currentHp;
        this.ai.field = null;
        this.ai.drawCard();
    }

    // === Ajout Reneva ===
    if (playerDeadCard && playerDeadCard.name === "Reneva" && !playerDeadCard.hasUsedAbility) {
        const newCard = new Card(
            playerDeadCard.name,
            Math.floor(playerDeadCard.attack / 2),
            Math.floor(playerDeadCard.maxHp / 2),
            playerDeadCard.imageSrc,
            Player.getAbilityFunction(playerDeadCard.name),
            playerDeadCard.abilityDescription
        );
        newCard.hasUsedAbility = true; // Empêche la réactivation
        this.player.deck.push(newCard);
        playerDeadCard.hasUsedAbility = true;
    }
    if (aiDeadCard && aiDeadCard.name === "Reneva" && !aiDeadCard.hasUsedAbility) {
        const newCard = new Card(
            aiDeadCard.name,
            Math.floor(aiDeadCard.attack / 2),
            Math.floor(aiDeadCard.maxHp / 2),
            aiDeadCard.imageSrc,
            Player.getAbilityFunction(aiDeadCard.name),
            aiDeadCard.abilityDescription
        );
        newCard.hasUsedAbility = true; // Empêche la réactivation
        this.ai.deck.push(newCard);
        aiDeadCard.hasUsedAbility = true;
    }

    // Réactive la pioche après le traitement Reneva
    this.disableDraw = false;

    // Libère le champ de bataille si plus de carte à jouer
    if (this.player.hand.length === 0 && this.player.deck.length === 0) {
        this.player.field = null;
    }
    if (this.ai.hand.length === 0 && this.ai.deck.length === 0) {
        this.ai.field = null;
    }
}

    updateUI(selectedCardIndex = -1, selectedCardId = null) {
        // Si aucun paramètre n'est passé, on tente de récupérer la dernière sélection persistée
        if (!selectedCardId && localStorage.getItem('lastSelectedCardId')) {
            selectedCardId = localStorage.getItem('lastSelectedCardId');
        }
        const cardEffects = {
            poison: ['Mazhaf', 'Zigan'],
            fire: ['Maz', 'Quejis', 'Dragon'],
            ghost: ['Fantôme'],
            dragon: ['Dragon'],
            heal: ['Lunn', 'Elfe'],
            ace: ['Foaris', 'Rahhh'],
            marbre: ['Civt'],
            slash: ['Kazin'],
            dance: ['Layley', 'Endy'],
        };
        const playerHand = document.getElementById('player-hand');
        playerHand.innerHTML = '';
        this.player.hand.forEach((card, index) => {
            // Ajout d'un identifiant unique (existant)
            if (!card._uniqueId) {
                card._uniqueId = `${card.name}_${card.attack}_${card.currentHp}_${Math.random().toString(36).substr(2, 9)}`;
            }
            const cardElement = card.createCardElement();
            cardElement.setAttribute('data-unique-id', card._uniqueId);

            // --- AJOUT POUR LA CARTE AQUA ---
            // Si le buff est actif et que c'est la 4ème carte (index 3)
            if (this.player.hasAquaBuff && index === 3) {
                cardElement.style.border = "4px solid aqua";
                cardElement.style.boxShadow = "0 0 15px aqua";
                cardElement.style.transform = "scale(1.02)"; // Petit effet de zoom pour la mettre en valeur
            }
            // --------------------------------

            cardElement.addEventListener('click', () => {
                document.querySelectorAll('#player-hand .card').forEach(card => card.classList.remove('selected'));
                cardElement.classList.add('selected');
                localStorage.setItem('lastSelectedCardId', card._uniqueId);
            });

            if (selectedCardId && card._uniqueId === selectedCardId) {
                cardElement.classList.add('selected');
            }
            playerHand.appendChild(cardElement);
        });

        const playerCardContainer = document.getElementById('player-card');
        const aiCardContainer = document.getElementById('ai-card');

        playerCardContainer.innerHTML = '';
        aiCardContainer.innerHTML = '';

        if (this.player.field) {
            const playerCardElement = this.player.field.createCardElement();
            playerCardElement.classList.add('clash');
            playerCardContainer.appendChild(playerCardElement);
        }

        if (this.ai.field) {
            const aiCardElement = this.ai.field.createCardElement();
            aiCardElement.classList.add('clash');
            aiCardContainer.appendChild(aiCardElement);
        }

        const playerHpFill = document.getElementById('player-hp-fill');
        const aiHpFill = document.getElementById('ai-hp-fill');
        document.getElementById('status-text').textContent = `${this.player.name}: ${this.player.hp} HM vs ${this.ai.name}: ${this.ai.hp} HM`;

        if (playerHpFill) {
            playerHpFill.style.width = `${Math.max(0, (this.player.hp / 100) * 100)}%`;
            playerHpFill.style.backgroundColor = this.player.hp > 50 ? 'aqua' : 'red';
        }

        if (aiHpFill) {
            aiHpFill.style.width = `${Math.max(0, (this.ai.hp / 100) * 100)}%`;
            aiHpFill.style.backgroundColor = this.ai.hp > 50 ? 'aqua' : 'red';
        }

        const updateCardDisplay = (cardElement, card) => {
            const hpElement = cardElement.querySelector('.hp');
            if (hpElement) {
                hpElement.textContent = `HP: ${Math.floor(card.currentHp)}${card.shield > 0 ? ` (DF${card.shield})` : ''}${card.curseCounter > 0 ? ` (Poison: ${card.curseCounter})` : ''}${card.burnCount > 0 ? ` (brule: ${card.burnCount})` : ''}`;
            }
            const atkElement = cardElement.querySelector('.atk');
            if (atkElement) {
                atkElement.textContent = `ATK: ${card.attack}`;
            }
        };

        document.querySelectorAll('#player-hand .card').forEach((cardElement, index) => {
            updateCardDisplay(cardElement, this.player.hand[index]);
        });

        if (this.player.field) {
            updateCardDisplay(document.querySelector('#player-card .card'), this.player.field);
        }
        if (this.ai.field) {
            updateCardDisplay(document.querySelector('#ai-card .card'), this.ai.field);
        }

        const battlefield = document.getElementById('battlefield');
        const playerCard = this.player.field;
        const aiCard = this.ai.field;

        battlefield.className = 'battlefield';

        // Handle other field effects
        if (playerCard || aiCard) {
            for (const [effect, cards] of Object.entries(cardEffects)) {
                if (playerCard && cards.includes(playerCard.name)) {
                    battlefield.classList.add(`${effect}-field`);
                    break;
                } else if (aiCard && cards.includes(aiCard.name)) {
                    battlefield.className = 'battlefield';
                    battlefield.classList.add(`${effect}-field`);
                    battlefield.classList.add('flipped');
                    break;
                }
            }
        }
        const updateStunnedState = (cardElement, card) => {
            if (card.stunCounter > 0) {
                cardElement.classList.add('stunned');
            } else {
                cardElement.classList.remove('stunned');
            }
        };

        // Mettre à jour l'état stunned pour toutes les cartes de la main du joueur
        document.querySelectorAll('#player-hand .card').forEach((cardElement, index) => {
            updateStunnedState(cardElement, this.player.hand[index]);
        });

        // Mettre à jour l'état stunned pour les cartes sur le terrain
        if (this.player.field) {
            const playerFieldCard = document.querySelector('#player-card .card');
            if (playerFieldCard) {
                updateStunnedState(playerFieldCard, this.player.field);
            }
        }

        if (this.ai.field) {
            const aiFieldCard = document.querySelector('#ai-card .card');
            if (aiFieldCard) {
                updateStunnedState(aiFieldCard, this.ai.field);
            }
        }
    }


  
    

}
window.addEventListener('DOMContentLoaded', () => {
    initializeGame();
     // Appel de la fonction pour démarrer la musique
    if (!game.player.isAI) {
        jouerMusique();
        }
});
// Assurez-vous que cette partie est incluse dans votre code
//const game = new Game();

document.getElementById('play-turn').addEventListener('click', async () => {

    // --- Début de la logique pour démarrer la musique ---
    if (!musicStarted && typeof jouerMusique === 'function') {
        try {
            // Essayer de lancer la musique
            await jouerMusique(); // Si jouerMusique retourne une Promise (ex: audio.play())
            musicStarted = true; // Marquer comme démarrée pour ne pas la relancer
        } catch (error) {        }
    }
    // --- Fin de la logique pour démarrer la musique ---

    const selectedCard = document.querySelector('#player-hand .card.selected');
    const playButton = document.getElementById('play-turn');
    
    if (!selectedCard) {
        playButton.textContent = "Sélectionnez une carte";
        playButton.style.backgroundColor = "#ff0000";
        playButton.disabled = true;

        document.querySelectorAll('#player-hand .card').forEach(card => {
            card.addEventListener('click', () => {
                const index = Array.from(card.parentNode.children).indexOf(card);
                const selectedCardObj = game.player.hand[index];
                
                if (selectedCardObj.stunCounter > 0) {
                    playButton.textContent = "Carte immobilisée !";
                    playButton.style.backgroundColor = "#ff0000";

                    setTimeout(() => {
                        playButton.textContent = "Jouer le tour";
                        playButton.style.backgroundColor = ""; // Réinitialise à la couleur par défaut
                    }, 2000); // 2000 millisecondes = 2 secondes

                    playButton.disabled = true;
                } else {
                    playButton.textContent = "Jouer le tour";
                    playButton.style.backgroundColor = "#4CAF50";
                    playButton.disabled = false;
                }
            }, { once: true });
        });

        return;
    }

    // Vérifier si la carte sélectionnée est stun
    const index = Array.from(selectedCard.parentNode.children).indexOf(selectedCard);
    const selectedCardObj = game.player.hand[index];
    
    if (selectedCardObj.stunCounter > 0) {
        playButton.textContent = "Carte immobilisée !";
        playButton.style.backgroundColor = "#ff0000";

        setTimeout(() => {
            playButton.textContent = "Jouer le tour";
            playButton.style.backgroundColor = ""; // Réinitialise à la couleur par défaut
        }, 2000); // 2000 millisecondes = 2 secondes

        return;
    }

    if (game) {
        await game.playTurn();
    } else {
        console.error("L'objet 'game' n'est pas initialisé !");
    }
    playButton.disabled = false;
});

document.getElementById('go-to-menu').addEventListener('click', () => {
    window.location.href = '/menu';
});




    </script>

</body>
</html>