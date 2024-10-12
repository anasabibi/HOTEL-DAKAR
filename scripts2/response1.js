function getBotResponse(input) {
    if (input === "bonjour") {
        return "Bonjour!";
    } else if (input === "au revoir") {
        return "À bientôt!";
    } else if (input === "où est le reçu") {
        return "Ne vous inquiétez pas, vous recevrez le reçu une fois que vous vous serez présenté à l'hôtel après le paiement!";
    } else if (input === "oui") {
        return "Répondez avec les options:<br>1. Réservations de chambres<br>2. Contactez-nous<br>3. Installations de l'hôtel<br>4. À propos de l'hôtel";
    } else if (input === "1") {
        return "Pour visiter nos chambres, cliquez sur le bouton <i class='bi bi-building' style='color: #333;'></i> ci-dessous";
    } else if (input === "2") {
        return "Bien sûr! Appuyez sur le bouton <i class='bi bi-envelope' style='color: crimson;'></i> ci-dessous pour nous contacter";
    } else if (input === "3") {
        return "Pour visiter nos installations, appuyez sur le bouton <i class='bi bi-amd' style='color: #333;'></i> ci-dessous!";
    } else if (input === "4") {
        return "Pour en savoir plus sur l'hôtel, appuyez sur le bouton <i class='bi bi-info-circle' style='color: #333;'></i> ci-dessous!";
    } else if (input === "5") {
        return "Pourquoi le directeur de l'hôtel a-t-il apporté une échelle au travail?<br> Parce qu'il voulait atteindre de nouveaux sommets!";
    } else if (input === "non") {
        return "Répondez 5 pour une blague";
    } else {
        return "Essayez de demander autre chose! Peut-être tapez 5 pour une blague";
    }
}
