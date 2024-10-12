<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>

    <link rel="stylesheet" href="css/chat2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    
</style>

<body>
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">Discutez avec nous!
            <i id="chat-icon" style="color: #fff;" class="fa fa-fw fa-comments-o"></i>
        </button>

        <div class="content">
            <div class="full-chat-block">
                <div class="outer-container">
                    <div class="chat-container">
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                        </div>
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Appuyez sur 'Entrée' pour envoyer un message">
                                <p></p>
                            </div>
                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: crimson; margin-right: 10px;" class="bi bi-envelope" onclick="goToContactPage()"></i>
                                <i id="chat-icon" style="color: #333; margin-right: 10px;" class="bi bi-building" onclick="goToRoomsPage()"></i>
                                <i id="chat-icon" style="color: #333; margin-right: 10px;" class="bi bi-amd" onclick="goToFacilitiesPage()"></i>
                                <i id="chat-icon" style="color: #333;" class="bi bi-info-circle" onclick="goToAboutPage()"></i>
                            </div>


                        </div>
                        <div id="chat-bar-bottom">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="scripts2/response1.js"></script>
<script src="scripts2/chat1.js"></script>

</html> 