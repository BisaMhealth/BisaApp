// import 'package:agora_rtc_engine/agora_rtc_engine.dart';
import 'package:flutter/material.dart';
// import 'package:permission_handler/permission_handler.dart';

class VideoCallScreen extends StatefulWidget {
  const VideoCallScreen(
      {Key? key,
      required this.appID,
      required this.channel,
      required this.token})
      : super(key: key);
  final String appID;
  final String token;
  final String channel;

  @override
  State<VideoCallScreen> createState() => _VideoCallScreenState();
}

class _VideoCallScreenState extends State<VideoCallScreen> {
  // ignore: unused_field
  int? _remoteUid;
  // ignore: prefer_final_fields, unused_field
  bool _localUserJoined = false;
  // late RtcEngine _engine;

  @override
  void initState() {
    super.initState();
    // initAgora();
  }

  // Future<void> initAgora() async {
  //   // retrieve permissions
  //   await [Permission.microphone, Permission.camera].request();

  //   //create the engine
  //   _engine = createAgoraRtcEngine();
  //   await _engine.initialize(RtcEngineContext(
  //     appId: widget.appID,
  //     channelProfile: ChannelProfileType.channelProfileLiveBroadcasting,
  //   ));

  //   _engine.registerEventHandler(
  //     RtcEngineEventHandler(
  //       onJoinChannelSuccess: (RtcConnection connection, int elapsed) {
  //         debugPrint("local user ${connection.localUid} joined");
  //         setState(() {
  //           _localUserJoined = true;
  //         });
  //       },
  //       onUserJoined: (RtcConnection connection, int remoteUid, int elapsed) {
  //         debugPrint("remote user $remoteUid joined");
  //         setState(() {
  //           _remoteUid = remoteUid;
  //         });
  //       },
  //       onUserOffline: (RtcConnection connection, int remoteUid,
  //           UserOfflineReasonType reason) {
  //         debugPrint("remote user $remoteUid left channel");
  //         setState(() {
  //           _remoteUid = null;
  //         });
  //       },
  //       onTokenPrivilegeWillExpire: (RtcConnection connection, String token) {
  //         debugPrint(
  //             '[onTokenPrivilegeWillExpire] connection: ${connection.toJson()}, token: $token');
  //       },
  //     ),
  //   );

  //   await _engine.setClientRole(role: ClientRoleType.clientRoleBroadcaster);
  //   await _engine.enableVideo();
  //   await _engine.startPreview();

  //   await _engine.joinChannel(
  //     token: widget.token,
  //     channelId: widget.channel,
  //     uid: 0,
  //     options: const ChannelMediaOptions(),
  //   );
  // }

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
      body: Stack(
        children: [
          Center(
            // child: _remoteVideo(),
          ),
          Align(
            alignment: Alignment.topLeft,
            child: SizedBox(
              width: 200,
              height: 260,
              // child: Center(
              //   child: _localUserJoined
              //       ? AgoraVideoView(
              //           controller: VideoViewController(
              //             rtcEngine: _engine,
              //             canvas: const VideoCanvas(uid: 0),
              //           ),
              //         )
              //       : const CircularProgressIndicator(),
              // ),
            ),
          ),
        ],
      ),
    );
  }

  // Display remote user's video
  // Widget _remoteVideo() {
  //   if (_remoteUid != null) {
  //     return AgoraVideoView(
  //       controller: VideoViewController.remote(
  //         rtcEngine: _engine,
  //         canvas: VideoCanvas(uid: _remoteUid),
  //         connection: RtcConnection(
  //           channelId: widget.channel,
  //         ),
  //       ),
  //     );
  //   } else {
  //     return const Text(
  //       'Please wait your doctor will join shortly.',
  //       textAlign: TextAlign.center,
  //     );
  //   }
  // }
}
