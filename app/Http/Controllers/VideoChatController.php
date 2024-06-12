<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Agora\RtcTokenBuilder\RtcTokenBuilder;

class VideoChatController extends Controller
{
    public function index()
    {
        $appID = env('AGORA_APP_ID');
        return view('videoChat.video-chat', compact('appID'));
    }

    public function generateToken(Request $request)
    {
        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        return $appCertificate;
        $channelName = $request->channelName;
        $uid = $request->uid;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);

        return response()->json(['token' => $token]);
    }
}
