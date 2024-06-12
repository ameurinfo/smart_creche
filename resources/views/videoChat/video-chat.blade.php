<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Chat</title>
    <script src="https://cdn.jsdelivr.net/npm/agora-rtc-sdk-ng"></script>
</head>
<body>
    <div id="local-player" style="width: 400px; height: 300px; background-color: #000;"></div>
    <div id="remote-player" style="width: 400px; height: 300px; background-color: #000;"></div>

    <script>
        const client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });

        async function startBasicCall() {
            try {
                const appID = "{{ $appID }}";
                const channel = "test-channel";
                const uid = Math.floor(Math.random() * 10000);

                client.on("user-published", async (user, mediaType) => {
                    await client.subscribe(user, mediaType);
                    if (mediaType === "video") {
                        const remotePlayerContainer = document.createElement("div");
                        remotePlayerContainer.id = user.uid.toString();
                        document.body.append(remotePlayerContainer);
                        user.videoTrack.play(remotePlayerContainer.id);
                    }
                });

                client.on("user-unpublished", user => {
                    const remotePlayerContainer = document.getElementById(user.uid.toString());
                    remotePlayerContainer.remove();
                });

                const tokenResponse = await fetch('/token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ channelName: channel, uid: uid })
                });
                
                if (!tokenResponse.ok) {
                    throw new Error('Failed to fetch token');
                }

                const tokenData = await tokenResponse.json();
                console.log('Token Data:', tokenData);

                await client.join(appID, channel, tokenData.token, uid);

                const localTrack = await AgoraRTC.createMicrophoneAndCameraTracks();
                const localPlayerContainer = document.createElement("div");
                localPlayerContainer.id = uid.toString();
                document.body.append(localPlayerContainer);
                localTrack[1].play(localPlayerContainer.id);

                await client.publish(localTrack);
                console.log('Successfully joined channel and published tracks');
            } catch (error) {
                console.error('Error in startBasicCall:', error);
            }
        }

        startBasicCall();
    </script>
</body>
</html>
