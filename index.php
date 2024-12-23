<?php
    $token = 'YOUR_TOKEN_GOES_HERE'; // Replace this with your bot token
    $userId = isset($_GET['user']) ? $_GET['user'] : '';

    // Check if user ID is not empty
    if (!empty($userId)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/v10/users/{$userId}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bot {$token}"
        ]);

        // Execute the request
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if the request was successful
        if ($httpcode === 200) {
            $user = json_decode($response, true);
            // Check if the user has an avatar
            if (isset($user['avatar'])) {
                $isAnimated = strpos($user['avatar'], 'a_') === 0;
                $extension = $isAnimated ? 'gif' : 'png';
                $avatarUrl = "https://cdn.discordapp.com/avatars/{$userId}/{$user['avatar']}.{$extension}";
                $content = file_get_contents($avatarUrl);
                
                // Check if the avatar content was fetched successfully
                if ($content !== false) {
                    header('Content-Type: image/' . $extension);
                    echo $content;
                    exit;
                } else {
                    echo "Failed to get avatar content from URL: {$avatarUrl}";
                    exit;
                }
            // If the user does not have an avatar, use the default avatar
            } else {
                echo "User does not have an avatar. Using default avatar.";
                $defaultAvatar = "https://cdn.discordapp.com/embed/avatars/" . ($userId % 5) . ".png";
                $content = file_get_contents($defaultAvatar);
                header('Content-Type: image/png');
                echo $content;
                exit;
            }
        // If the user data is not valid, show an error message
        } else {
            $defaultAvatar = "https://cdn.discordapp.com/embed/avatars/" . (rand(0, 4)) . ".png";
            $content = file_get_contents($defaultAvatar);
            header('Content-Type: image/png');
            echo $content;
            exit;
        }
    // If user ID is empty, show an error message
    } else {
        echo "User ID is empty.";
        exit;
    }
    
    // If the script reaches this point, return one of the default avatars with random number
?>