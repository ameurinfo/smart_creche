const APP_ID = "cb93d3b6d50745558bb937ed08e9f6b7";

        const uid = String(Math.floor(Math.random() * 10000));
        const token = null;

        let client;
        let channel;

        let localStream;
        let remoteStream;
        let peerConnection;

        const servers = {
            iceServers: [
                {
                    urls: ['stun:stun1.google.com:19302', 'stun:stun2.google.com:19302']
                }
            ]
        };

        const constraints = {
            video: {
                width: { min: 640, ideal: 1920, max: 1920 },
                height: { min: 480, ideal: 1080, max: 1080 },
            },
            audio: true
        };

        const init = async () => {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                console.error('WebRTC is not supported in this browser.');
                alert('Your browser does not support WebRTC. Please use a modern browser.');
                return;
            }

            client = await AgoraRTM.createInstance(APP_ID);
            await client.login({ uid, token });

            channel = client.createChannel('main');
            await channel.join();
            channel.on('MemberJoined', handleUserJoined);
            channel.on('MemberLeft', handleUserLeft);

            client.on('MessageFromPeer', handleMessageFromPeer);

            localStream = await navigator.mediaDevices.getUserMedia(constraints);
            document.getElementById('user-1').srcObject = localStream;
        };

        const handleUserLeft = async (MemberId) => {
            document.getElementById('user-2').style.display = 'none';
            document.getElementById('user-1').classList.remove('smallFrame');
        };

        const handleMessageFromPeer = async (message, MemberId) => {
            message = JSON.parse(message.text);
            if (message.type === 'offer') {
                await createAnswer(MemberId, message.offer);
            } else if (message.type === 'answer') {
                await addAnswer(message.answer);
            } else if (message.type === 'candidate') {
                if (peerConnection) {
                    await peerConnection.addIceCandidate(message.candidate);
                }
            }
        };

        const handleUserJoined = async (MemberId) => {
            console.log('a new user joined the channel:', MemberId);
            await createOffer(MemberId);
        };

        const createPeerConnection = async (MemberId) => {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                console.error('WebRTC is not supported in this browser.');
                alert('Your browser does not support WebRTC. Please use a modern browser.');
                return;
            }

            peerConnection = new RTCPeerConnection(servers);

            remoteStream = new MediaStream();
            document.getElementById('user-2').srcObject = remoteStream;
            document.getElementById('user-2').style.display = 'block';
            document.getElementById('user-1').classList.add('smallFrame');

            if (!localStream) {
                localStream = await navigator.mediaDevices.getUserMedia(constraints);
                document.getElementById('user-1').srcObject = localStream;
            }

            localStream.getTracks().forEach((track) => {
                peerConnection.addTrack(track, localStream);
            });

            peerConnection.ontrack = (event) => {
                event.streams[0].getTracks().forEach((track) => {
                    remoteStream.addTrack(track);
                });
            };

            peerConnection.onicecandidate = async (event) => {
                if (event.candidate) {
                    await client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'candidate', 'candidate': event.candidate }) }, MemberId);
                }
            };
        };

        const createOffer = async (MemberId) => {
            await createPeerConnection(MemberId);
            const offer = await peerConnection.createOffer();
            await peerConnection.setLocalDescription(offer);

            await client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'offer', 'offer': offer }) }, MemberId);
        };

        const createAnswer = async (MemberId, offer) => {
            await createPeerConnection(MemberId);
            await peerConnection.setRemoteDescription(offer);

            const answer = await peerConnection.createAnswer();
            await peerConnection.setLocalDescription(answer);

            await client.sendMessageToPeer({ text: JSON.stringify({ 'type': 'answer', 'answer': answer }) }, MemberId);
        };

        const addAnswer = async (answer) => {
            if (!peerConnection.currentRemoteDescription) {
                await peerConnection.setRemoteDescription(answer);
            }
        };

        const leaveChannel = async () => {
            await channel.leave();
            await client.logout();
        };

        const toggleCamera = async () => {
            const videoTrack = localStream.getTracks().find(track => track.kind === 'video');

            if (videoTrack.enabled) {
                videoTrack.enabled = false;
                document.getElementById('camera-btn').style.backgroundColor = 'rgb(255, 80, 80)';
            } else {
                videoTrack.enabled = true;
                document.getElementById('camera-btn').style.backgroundColor = 'rgb(179, 102, 249, .9)';
            }
        };

        const toggleMic = async () => {
            const audioTrack = localStream.getTracks().find(track => track.kind === 'audio');

            if (audioTrack.enabled) {
                audioTrack.enabled = false;
                document.getElementById('mic-btn').style.backgroundColor = 'rgb(255, 80, 80)';
            } else {
                audioTrack.enabled = true;
                document.getElementById('mic-btn').style.backgroundColor = 'rgb(179, 102, 249, .9)';
            }
        };

        window.addEventListener('beforeunload', leaveChannel);

        document.getElementById('camera-btn').addEventListener('click', toggleCamera);
        document.getElementById('mic-btn').addEventListener('click', toggleMic);

        init();