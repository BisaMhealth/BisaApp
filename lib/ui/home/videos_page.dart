import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/models/video_res.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:provider/provider.dart';
// import 'package:youtube_player_flutter/youtube_player_flutter.dart';
// import 'package:youtube_player_flutter/youtube_player_flutter.dart';
import 'package:youtube_player_iframe/youtube_player_iframe.dart';

class VideoPage extends StatefulWidget {
  const VideoPage({Key? key}) : super(key: key);

  @override
  VideoPageState createState() => VideoPageState();
}

class VideoPageState extends State<VideoPage> {
  late CurrentUser currentUser;
  // VideoItem videoItem;

  List<YoutubePlayerController> youtubeControllers = [];

  @override
  void initState() {
    super.initState();
    // _isPlayerReady = false;
    // _controller = YoutubePlayerController(
    //   initialVideoId: 'TTqIonMj90Q',
    //   params: const YoutubePlayerParams(
    //     showControls: true,
    //     showFullscreenButton: true,
    //     desktopMode: false,
    //     privacyEnhanced: true,
    //     useHybridComposition: true,
    //   ),
    // );

    // _controller.onEnterFullscreen = () {
    //   SystemChrome.setPreferredOrientations([
    //     DeviceOrientation.landscapeLeft,
    //     DeviceOrientation.landscapeRight,
    //   ]);
    //   print('Entered Fullscreen');
    // };
    // _controller.onExitFullscreen = () {
    //   print('Exited Fullscreen');
    // };
    // ..addListener(_listener);

    // _isPlayerReady2 = false;
    // _controller2 = YoutubePlayerController(
    //     initialVideoId: 'hEyKH6236_Y',
    //     params: YoutubePlayerParams(
    //       showControls: true,
    //       showFullscreenButton: true,
    //       desktopMode: false,
    //       privacyEnhanced: true,
    //       useHybridComposition: true,
    //     )
    //   );

    // // _controller2.onEnterFullscreen = () {
    //   SystemChrome.setPreferredOrientations([
    //     DeviceOrientation.landscapeLeft,
    //     DeviceOrientation.landscapeRight,
    //   ]);
    //   print('Entered Fullscreen');
    // };
    // _controller2.onExitFullscreen = () {
    //   print('Exited Fullscreen');
    // };
    // ..addListener(_listener);
    // ..addListener(_listener);
  }

  // void _listener() {
  //   if (_isPlayerReady && mounted && !_controller.value.isFullScreen) {
  //     //
  //   }
  // }

  @override
  void deactivate() {
    youtubeControllers.map((e) => e.pause());
    super.deactivate();
  }

  @override
  void dispose() {
    youtubeControllers.map((e) => e.close());
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        leading: const BackButton(
          color: Colors.black,
        ),
        title: Text(
          'Videos',
          style: TextStyle(
            fontWeight: FontWeight.w700,
            fontFamily: 'Lato',
            fontSize: 30.sp,
            color: const Color.fromRGBO(85, 80, 80, 0.98)
          ),
        ),
        elevation: 0,
      ),
      body: SingleChildScrollView(
        child: FutureBuilder(
          future: getVideos(currentUser.token),
          builder: (context,AsyncSnapshot<VideosRes> snapshot){
            if(snapshot.hasData){
              List<VideoCategory> cats = snapshot.data!.data!;
              return Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  children: cats.map((e){
                    return Padding(
                      padding: const EdgeInsets.only(bottom: 10),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Padding(
                            padding: const EdgeInsets.all(8.0),
                            child: Text('${e.name}',
                              style: TextStyle(
                                fontFamily: 'Lato',
                                fontSize: 22.sp,
                                fontWeight: FontWeight.w800
                              ),
                            ),
                          ),
                          e.videos != null?
                          e.videos!.isNotEmpty ?
                          ListView.builder(
                            itemCount: e.videos!.length,
                            shrinkWrap: true,
                            itemBuilder: (context, index){
                              Video? video = e.videos?.elementAt(index);
                              var controller = YoutubePlayerController(
                                initialVideoId: '${video!.mLink}',
                                params: const YoutubePlayerParams(
                                  showControls: true,
                                  showFullscreenButton: true,
                                  desktopMode: false,
                                  privacyEnhanced: true,
                                  useHybridComposition: true,
                                )
                              );

                              youtubeControllers.add(controller);

                              // controller.onEnterFullscreen = () {
                              //   SystemChrome.setPreferredOrientations([
                              //     DeviceOrientation.landscapeLeft,
                              //     DeviceOrientation.landscapeRight,
                              //   ]);
                              //   print('Entered Fullscreen');
                              // };
                              // controller.onExitFullscreen = () {
                              //   print('Exited Fullscreen');
                              // };
                              return Padding(
                                padding: const EdgeInsets.all(8.0),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    const SizedBox(height: 12,),
                                    Text('${video.title}',
                                      style: TextStyle(
                                        fontFamily: 'Lato',
                                        fontSize: 18.sp,
                                        fontWeight: FontWeight.w500
                                      ),
                                    ),
                                     const SizedBox(height: 6,),
                                    YoutubePlayerIFrame(
                                      controller: controller
                                    ),
                                  ],
                                ),
                              );
                            }
                          ):
                          const Text("No vidoes in this category")
                          :const SizedBox.shrink()
                        ],
                      ),
                    );
                  }).toList(),
                )
              );
            }
            else{
              return Container(
                width: 1.sw,
                height: 1.sh,
                alignment: Alignment.center,
                child: const CircularProgressIndicator.adaptive(),
              );
            }
          },
        )
      ),
    );
  }
}

// children: [
  // Padding(
  //   padding: const EdgeInsets.all(8.0),
  //   child: YoutubePlayerIFrame(
  //     controller: _controller,
  //   ),
  // ),
//   SizedBox(
//     height: 10.h,
//   ),
//   Padding(
//     padding: const EdgeInsets.all(8.0),
//     child: YoutubePlayerIFrame(
//       controller: _controller2,
//     ),
//   ),
//   SizedBox(
//     height: 10.h,
//   ),
//   Padding(
//     padding: const EdgeInsets.all(8.0),
//     child: YoutubePlayerIFrame(
//       controller: _controller3,
//     ),
//   ),
// ],
