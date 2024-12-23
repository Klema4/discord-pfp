<?php
    $token = 'YOUR_TOKEN_GOES_HERE'; // Replace this with your bot token
    $userId = isset($_GET['user']) ? $_GET['user'] : '';
    $cacheDir = __DIR__ . '/cache/';
    $cacheTime = 432000; // 5 days in seconds

    // Create cache directory if it doesn't exist
    if (!is_dir($cacheDir)) {
        if (!mkdir($cacheDir, 0755, true)) {
            die('Failed to create cache directory');
        }
    }

    // Check if user ID is not empty
    if (!empty($userId)) {
        $cacheFilePng = $cacheDir . $userId . '.png';
        $cacheFileGif = $cacheDir . $userId . '.gif';

        // Check if the cache file exists and is not older than cache time
        if ((file_exists($cacheFilePng) && (time() - filemtime($cacheFilePng)) < $cacheTime) ||
            (file_exists($cacheFileGif) && (time() - filemtime($cacheFileGif)) < $cacheTime)) {
            if (file_exists($cacheFilePng)) {
                header('Content-Type: image/png');
                readfile($cacheFilePng);
            } else {
                header('Content-Type: image/gif');
                readfile($cacheFileGif);
            }
            exit;
        }

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
                    $cacheFile = $cacheDir . $userId . '.' . $extension;
                    if (file_put_contents($cacheFile, $content) === false) {
                        die('Failed to write cache file');
                    }
                    header('Content-Type: image/' . $extension);
                    echo $content;
                    exit;
                } else {
                    die("Failed to get avatar content from URL: {$avatarUrl}");
                }
            // If the user does not have an avatar, use the default avatar
            } else {
                $defaultAvatar = "https://cdn.discordapp.com/embed/avatars/" . ($userId % 5) . ".png";
                $content = file_get_contents($defaultAvatar);
                if (file_put_contents($cacheFilePng, $content) === false) {
                    die('Failed to write cache file');
                }
                header('Content-Type: image/png');
                echo $content;
                exit;
            }
        // If the user data is not valid, show an error message
        } else {
            $defaultAvatar = "https://cdn.discordapp.com/embed/avatars/" . (rand(0, 4)) . ".png";
            $content = file_get_contents($defaultAvatar);
            if (file_put_contents($cacheFilePng, $content) === false) {
                die('Failed to write cache file');
            }
            header('Content-Type: image/png');
            echo $content;
            exit;
        }
    // If user ID is empty, show an error message
    } else {
        die("User ID is empty.");
    }
?>