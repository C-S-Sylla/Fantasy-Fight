function playDrawSound(cardName) {
    let audioPath;
    
    if (cardName === "Lyriena") {
        audioPath = 'sounds/lyriena.mp3';
    } else if (cardName === "Daraven") {
        audioPath = 'sounds/daraven.mp3';
    } else if (cardName === "Tank") {
        audioPath = 'sounds/tank.mp3';
    } else if (cardName === "Lunn") {
        audioPath = 'sounds/lunn.mp3';
    } else if (cardName === "Dracula") {
        audioPath = 'sounds/dracula.mp3';
    } else if (cardName === "Loup-Garou") {
        audioPath = 'sounds/loup-garou.mp3';
    } else if (cardName === "Fée") {
        audioPath = 'sounds/fee.mp3';
    } else if (cardName === "Sorcière") {
        audioPath = 'sounds/sorciere.mp3';
    } else if (cardName === "Fantôme") {
        audioPath = 'sounds/fantome.mp3';
    } else if (cardName === "Dragon") {
        audioPath = 'sounds/dragon.mp3';
    } else if (cardName === "Elfe") {
        audioPath = 'sounds/elfe.mp3';
    } else if (cardName === "Troll") {
        audioPath = 'sounds/troll.mp3';
    } else if (cardName === "Xing") {
        audioPath = 'sounds/xing.mp3';
    } else if (cardName === "Seren") {
        audioPath = 'sounds/sirene.mp3';
    } else if (cardName === "Nécromancien") {
        audioPath = 'sounds/necromancien.mp3';
    } else if (cardName === "Jo-un") {
        audioPath = 'sounds/jo-un.mp3';
    } else if (cardName === "Nezoom") {
        audioPath = 'sounds/nezoom.mp3';
    } else if (cardName === "Mazhaf") {
        audioPath = 'sounds/mazhaf.mp3';
    } else if (cardName === "Lora") {
        audioPath = 'sounds/lora.mp3';
    } else if (cardName === "Lola") {
        audioPath = 'sounds/lola.mp3';
    } else if (cardName === "Rituel du Sang Noir") {
        audioPath = 'sounds/rituel-du-sang-noir.mp3';
    } else if (cardName === "Civt") {
        audioPath = 'sounds/civt.mp3';
    } else {
        // Son par défaut si la carte n'a pas de son spécifique
        audioPath = 'sounds/draw.mp3';
    }

    const audio = new Audio(audioPath);
    audio.play();
}