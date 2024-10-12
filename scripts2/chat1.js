// Collapsible chat bar functionality
var coll = document.getElementsByClassName("collapsible");
for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

// Get current time in HH:MM format
function getTime() {
    let today = new Date();
    let hours = today.getHours();
    let minutes = today.getMinutes();
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    return hours + ":" + minutes;
}

// Afficher le message initial du bot
function firstBotMessage() {
    let firstMessage = "Bonjour, je suis YKY , bienvenue dans notre hôtel! <br> Avez-vous besoin de mon assistance ? oui/non?";
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '</span></p>';
    let time = getTime();
    $("#chat-timestamp").append(time);
    document.getElementById("userInput").scrollIntoView(false);
}


firstBotMessage();

// Generate and display bot response
function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>';
    $("#chatbox").append(botHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

// Handle user input and display response
function getResponse() {
    let userText = $("#textInput").val();
    if (userText == "") {
        userText = "I love Code Palace!";
    }
    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';
    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
    setTimeout(() => {
        getHardResponse(userText);
    }, 1000);
}

// Handle button clicks and display response
function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';
    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
    setTimeout(() => {
        getHardResponse(sampleText);
    }, 1000);
}

// Redirect to contact page
function goToContactPage() {
    window.location.href = "contact.php";
}

// Redirect to rooms page
function goToRoomsPage() {
    window.location.href = "rooms.php";
}

// Redirect to facilities page
function goToFacilitiesPage() {
    window.location.href = "facilities.php";
}

// Redirect to about page
function goToAboutPage() {
    window.location.href = "about.php";
}

// Press enter to send a message
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});