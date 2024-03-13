
import 'package:audio_video_progress_bar/audio_video_progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:just_audio/just_audio.dart';

class Meditating_Screen extends StatefulWidget {
  final int index;
  final String? title;
  const Meditating_Screen({super.key,required this.index,required this.title});

  @override
  State<Meditating_Screen> createState() => _Meditating_ScreenState();
}

class _Meditating_ScreenState extends State<Meditating_Screen> {
final _player = AudioPlayer();


@override
  void dispose() {
    _player.dispose();
    super.dispose();
  }

@override
  void initState() {
    super.initState();
    WidgetsFlutterBinding.ensureInitialized();
    _setupAudioPlayer();
  }



  _playbackControlButton(){
    return StreamBuilder<PlayerState>(
      stream: _player.playerStateStream, 
      builder: (context,snapshot){
        final processingState = snapshot.data?.processingState;
        final playing = snapshot.data?.playing;
        if(processingState == ProcessingState.loading || processingState == ProcessingState.buffering){
          return const CircularProgressIndicator(
            color: Color(0xFFB5E255),
          );
          }else if(playing != true){
            return Container(
              height: 50,
              width: 50,
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(10),
              ),
              child: IconButton(
                icon: const Icon(
                  Icons.play_arrow,
                  color: Colors.black,
                  size: 30,
                ),
                onPressed: _player.play,
              ),
            );
      }else if(processingState != ProcessingState.completed){
        return Container(
          height: 50,
          width: 50,
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(10),
          ),
          child: IconButton(
            icon: const Icon(
              Icons.pause,
              color: Colors.black,
              size: 30,
            ),
            onPressed: _player.pause,
          ),
        );
        }else{
          return IconButton(
            icon: const Icon(
              Icons.replay,
              color: Colors.white,
              size: 30,
            ),
            onPressed: () => _player.seek(Duration.zero, index: 0),
          );
        
        }
        }
      );
  }

 Future<void> _setupAudioPlayer()async{
  _player.playbackEventStream.listen((event) { },
    onError: (Object e, StackTrace stacktrace){
      print("A Stream error occured: ${e.toString()}");
    }
  );
  try {
    _player.setAudioSource(
    //  AudioSource.asset('assets/songs/happy.mp3')
    AudioSource.uri(Uri.parse('https://res.cloudinary.com/dzh1cgxjd/video/upload/v1710349509/BisaMeditationAudio/1_Hour_Upbeat_Background_Music_Best_MBB_Music_Collection_Free_Download_No_Copyright_wcqfqo.mp3'))
    );
  } catch (e) {
    print("Error Loading audio source: ${e.toString()}"); 
  }
 }

    _progressBar(){
      return StreamBuilder<Duration?>(
        stream: _player.durationStream,
        builder: (context, snapshot){
          return ProgressBar(
            timeLabelLocation: TimeLabelLocation.none,
            thumbRadius: 8,
            barHeight: 8,
            timeLabelPadding: 0,
            progressBarColor: Colors.white,
            baseBarColor: Colors.grey,
            thumbColor: Colors.white,
            bufferedBarColor: Colors.white.withOpacity(0.5),
            thumbGlowColor: Colors.white,
            progress: snapshot.data ?? Duration.zero,
            total: _player.duration ?? Duration.zero,
            buffered: _player.bufferedPosition ?? Duration.zero,
            onSeek: (duration){
              _player.seek(duration);
            },
          );
        },
      );
    }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: Colors.black.withOpacity(1.0),
       // backgroundBlendMode: BlendMode.values[1],
       //backgroundBlendMode: BlendMode.darken,
        image: DecorationImage(
          colorFilter: ColorFilter.mode(
            Colors.black.withOpacity(0.6),
            BlendMode.dstATop,
          ),
          image: AssetImage(
            'assets/imgs/med2.png',
            ),
          fit: BoxFit.cover
        )
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        body: Container(
          padding: const EdgeInsets.symmetric(
            horizontal: 20,vertical: 20
            ),
            child: Container(
              child: SingleChildScrollView(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    SizedBox(height: 30,),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        IconButton(
                          onPressed: (){
                            Navigator.pop(context);
                          },
                          icon: const Icon(
                            Icons.arrow_back_ios,
                            color: Colors.white,
                            size: 30,
                          ),
                        ),
                      ],
                    ),
                    SizedBox(height: 20,),
                    Text(
                     widget.title ?? 'Focus',
                      style: const TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w600,
                        fontSize: 22,
                        color: Colors.white,
                      ),
                    ),
                   const SizedBox(height: 10,),
                    Text(
                      'Meditation . 3-10 min',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w400,
                        fontSize: 16,
                        color: Colors.white,
                      ),
                    ),
                    SizedBox(height: 20,),
                    Container(
                      height: 280,
                      width: double.infinity,
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(20),
                        image:const DecorationImage(
                          image: AssetImage(
                            'assets/imgs/med5.png',
                          ),
                          fit: BoxFit.cover
                        )
                      ),
                    ),
                  const  SizedBox(
                    height: 20,
                    ),
                    _progressBar(),
                    const SizedBox(
                      height: 20,
                    ),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        // Container(
                        //   height: 50,
                        //   width: 50,
                        //   decoration: BoxDecoration(
                        //     color: Colors.white,
                        //     borderRadius: BorderRadius.circular(10),
                        //   ),
                        //   child: IconButton(
                        //     onPressed: (){
                        //       _player.play();
                        //     },
                        //     icon: const Icon(
                        //       Icons.play_arrow,
                        //       color: Colors.black,
                        //       size: 30,
                        //     ),
                        //   ),
                        //   ),
                        _playbackControlButton()
                          ]
                          ),
                    SizedBox(height: 20,),
                    Text(
                      'Meditation',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w600,
                        fontSize: 22,
                        color: Colors.white,
                      ),
                    ),
                    SizedBox(height: 10,),
                    Text(
                      'Meditation is a practice where an individual uses a technique – such as mindfulness, or focusing the mind on a particular object, thought, or activity – to train attention and awareness, and achieve a mentally clear and emotionally calm and stable state.',
                      style: TextStyle(
                        fontFamily: 'Poppins',
                        fontWeight: FontWeight.w400,
                        fontSize: 16,
                        color: Colors.white,
                      ),
                    ),
                    SizedBox(height: 20,),
                    
                          ]
                          ),
              )
                        )
        ),
      ),
    );
  }
}