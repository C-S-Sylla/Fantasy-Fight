const musiques = [
  "sounds/histoire2.mp3",
  "sounds/histoire1.mp3",
  "sounds/histoire3.mp3",
];

let indexMusique = 0;
let audio = null; // Stocke l'instance audio
let isPlaying = false;

// Fonction pour lancer une musique
async function jouerMusique() {
  if (isPlaying) {
    return;
  }
  isPlaying = true;
   if (indexMusique >= musiques.length) {
    indexMusique = 0;
  }

  try {
      if (audio) {
        audio.pause();
        audio.currentTime = 0;
    }
    audio = new Audio(musiques[indexMusique]);
      await new Promise((resolve, reject) => {
           audio.addEventListener("canplaythrough", resolve, { once: true });
           audio.addEventListener("error", (e) => reject(e), { once: true });
           audio.load()

      })
       await audio.play()

      audio.addEventListener("ended", handleEnded);
    }
    catch (error) {
    console.error("Erreur lors de la lecture de la musique:", error);
  }
  isPlaying = false;
}
 function handleEnded() {
    indexMusique++;
    jouerMusique()

 }