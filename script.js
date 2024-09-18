function sendMessage() {
    const userInput = document.getElementById('user-input').value;
    if (userInput.trim() === '') return;

    // Display user message
    const chatBox = document.getElementById('chat-box');
    chatBox.innerHTML += `<div>User: ${userInput}</div>`;

    // Send user input to the server
    fetch('process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `message=${encodeURIComponent(userInput)}`,
    })
    .then(response => response.text())
    .then(data => {
        chatBox.innerHTML += `<div>Bot: ${data}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    });

    // Clear input field
    document.getElementById('user-input').value = '';
}
