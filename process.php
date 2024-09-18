<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userMessage = $_POST['message'];

    // OpenAI API credentials
    $apiKey = 'YOUR_OPENAI_API_KEY'; // Replace with your OpenAI API key
    $apiUrl = 'https://api.openai.com/v1/engines/davinci/completions';

    // Prepare request data
    $data = [
        'prompt' => $userMessage,
        'max_tokens' => 150,
        'temperature' => 0.7
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);

    // Get the response
    $response = curl_exec($ch);
    curl_close($ch);

    // Parse and return the response
    $responseData = json_decode($response, true);
    $botResponse = $responseData['choices'][0]['text'];

    echo htmlspecialchars($botResponse);
}
?>
