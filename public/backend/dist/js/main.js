const APP_ID = "cb93d3b6d50745558bb937ed08e9f6b7";

let uid = String(Math.floor(Math.random() * 10000));
let token = null;

let client;
let channel;
let localStream;
let remoteStream;
let peerConnection;

const servers = {
    iceServers: [
        { urls: ['stun:stun1.google.com:19302', 'stun:stun2.google.com:19302'] }
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
    try {
        client = await AgoraRTM.createInstance(APP_ID);
        await client.login({ uid, token });

        channel = client.createChannel('main');
        await channel.join();
        channel.on('MemberJoined', handleUserJoined);
        channel.on('MemberLeft', handleUserLeft);

        client.on('MessageFromPeer', handleMessageFromPeer);

        localStream = await navigator.mediaDevices.getUserMedia(constraints);
        document.getElementById('user-1').srcObject = localStream;
    } catch (error) {
        console.error('Error during initialization:', error);
    }
};

const handleUserLeft = (MemberId) => {
    document.getElementById('user-2').style.display = 'none';
    document.getElementById('user-1').classList.remove('smallFrame');
};

const handleMessageFromPeer = async (message, MemberId) => {
    const parsedMessage = JSON.parse(message.text);
    switch (parsedMessage.type) {
        case 'offer':
            await createAnswer(MemberId, parsedMessage.offer);
            break;
        case 'answer':
            await addAnswer(parsedMessage.answer);
            break;
        case 'candidate':
            if (peerConnection) {
                await peerConnection.addIceCandidate(parsedMessage.candidate);
            }
            break;
    }
};

const handleUserJoined = (MemberId) => {
    console.log('A new user joined the channel:', MemberId);
    createOffer(MemberId);
};

const createPeerConnection = async (MemberId) => {
    peerConnection = new RTCPeerConnection(servers);

    remoteStream = new MediaStream();
    document.getElementById('user-2').srcObject = remoteStream;
    document.getElementById('user-2').style.display = 'block';
    document.getElementById('user-1').classList.add('smallFrame');

    if (!localStream) {
        localStream = await navigator.mediaDevices.getUserMedia(constraints);
        document.getElementById('user-1').srcObject = localStream;
    }

    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

    peerConnection.ontrack = (event) => {
        event.streams[0].getTracks().forEach(track => remoteStream.addTrack(track));
    };

    peerConnection.onicecandidate = (event) => {
        if (event.candidate) {
            client.sendMessageToPeer({ text: JSON.stringify({ type: 'candidate', candidate: event.candidate }) }, MemberId);
        }
    };
};

const createOffer = async (MemberId) => {
    try {
        await createPeerConnection(MemberId);
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);

        client.sendMessageToPeer({ text: JSON.stringify({ type: 'offer', offer }) }, MemberId);
    } catch (error) {
        console.error('Error creating offer:', error);
    }
};

const createAnswer = async (MemberId, offer) => {
    try {
        await createPeerConnection(MemberId);
        await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));

        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);

        client.sendMessageToPeer({ text: JSON.stringify({ type: 'answer', answer }) }, MemberId);
    } catch (error) {
        console.error('Error creating answer:', error);
    }
};

const addAnswer = async (answer) => {
    try {
        if (!peerConnection.currentRemoteDescription) {
            await peerConnection.setRemoteDescription(new RTCSessionDescription(answer));
        }
    } catch (error) {
        console.error('Error adding answer:', error);
    }
};

const leaveChannel = async () => {
    try {
        await channel.leave();
        await client.logout();
    } catch (error) {
        console.error('Error leaving channel:', error);
    }
};

const toggleCamera = () => {
    const videoTrack = localStream.getTracks().find(track => track.kind === 'video');
    if (videoTrack) {
        videoTrack.enabled = !videoTrack.enabled;
        document.getElementById('camera-btn').style.backgroundColor = videoTrack.enabled ? 'rgb(179, 102, 249, .9)' : 'rgb(255, 80, 80)';
    }
};

const toggleMic = () => {
    const audioTrack = localStream.getTracks().find(track => track.kind === 'audio');
    if (audioTrack) {
        audioTrack.enabled = !audioTrack.enabled;
        document.getElementById('mic-btn').style.backgroundColor = audioTrack.enabled ? 'rgb(179, 102, 249, .9)' : 'rgb(255, 80, 80)';
    }
};

window.addEventListener('beforeunload', leaveChannel);

document.getElementById('camera-btn').addEventListener('click', toggleCamera);
document.getElementById('mic-btn').addEventListener('click', toggleMic);

init();
