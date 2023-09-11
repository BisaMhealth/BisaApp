import 'dart:async';
import 'dart:io';

import 'package:bisa_app/animation/fade_animation.dart';
import 'package:bisa_app/models/chat_list_response.dart';
import 'package:bisa_app/models/current_user.dart';
import 'package:bisa_app/providers/bottom_nav_provider.dart';
import 'package:bisa_app/providers/current_user_provider.dart';
import 'package:bisa_app/services/api_service.dart';
import 'package:bisa_app/ui/chat/chat_details.dart';
// import 'package:bisa_app/ui/chat/chat_list.dart';
import 'package:bisa_app/ui/widgets/popup.dart';
import 'package:bisa_app/utils/validator.dart';
import 'package:cloudinary_public/cloudinary_public.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:image_picker/image_picker.dart';
import 'package:page_animation_transition/animations/top_to_bottom_transition.dart';
import 'package:page_animation_transition/page_animation_transition.dart';
import 'package:path_provider/path_provider.dart';
import 'package:provider/provider.dart';
import 'package:record/record.dart';

class StartQuestion extends StatefulWidget {
  const StartQuestion({Key? key}) : super(key: key);

  @override
  StartQuestionState createState() => StartQuestionState();
}

dynamic selectedId;

var selectedColor = [
  const Color.fromRGBO(181, 226, 85, 0.71),
  const Color.fromRGBO(88, 201, 0, 0.58),
];
var unselectedColor = [Colors.white, Colors.white];

var selectText = const Color.fromRGBO(255, 255, 255, 1);
var unselectText = const Color.fromRGBO(92, 94, 86, 1);

class StartQuestionState extends State<StartQuestion>
    with TickerProviderStateMixin {
  final _formKey = GlobalKey<FormState>();

  List<ChatListResponseData?> chatlist = [];

  late BottomNavProvider bottomNavVM;

  bool isRecording = false;

  final cloudinary = CloudinaryPublic('dzh1cgxjd', 'ooc0zhbu', cache: false);

  final _audioRecorder = Record();

  FutureOr onGoBack(dynamic value) {
    if (kDebugMode) {
      print('ok');
    }

    loadChat(currentUser.token).then((value) {
      if (kDebugMode) {
        print(value.data?.length);
      }
      if (mounted) {
        if (value.code == 200) {
          if (kDebugMode) {
            print('returned from ok');
          }
          setState(() {
            chatlist = value.data!;
          });

          bottomNavVM.setChatData(value.data);
          // setState(() {
          //   initialData = value;
          // });
        }
      }
    });
    // setState(() {

    // });
  }

  final textController = TextEditingController();

  bool _saving = false;

  @override
  void initState() {
    selectedId = null;
    super.initState();
  }

  @override
  void dispose() {
    _audioRecorder.dispose();
    super.dispose();
  }

  late CurrentUser currentUser;

  @override
  Widget build(BuildContext context) {
    currentUser = context.read<CurrentUserProvider>().currentUser!;
    bottomNavVM = context.watch<BottomNavProvider>();
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(
            Icons.arrow_back_ios,
            color: Colors.black,
          ),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        title: Text(
          'Start Question',
          style: TextStyle(
              fontFamily: 'Lato',
              fontWeight: FontWeight.w700,
              fontSize: 28.sp,
              color: const Color.fromRGBO(30, 29, 29, 0.98)),
        ),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(12.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              SizedBox(
                height: 20.h,
              ),
              FadeAnimation(
                  1.2,
                  0,
                  30,
                  Text(
                    'Select a Category',
                    style: TextStyle(
                        fontFamily: 'Lato',
                        fontWeight: FontWeight.w700,
                        fontSize: 21.sp,
                        color: const Color.fromRGBO(85, 80, 80, 0.98)),
                  )),
              FadeAnimation(
                  1.4,
                  0,
                  30,
                  Padding(
                    padding: const EdgeInsets.only(top: 12.0),
                    child: Container(
                      height: 120.h,
                      decoration: const BoxDecoration(boxShadow: [
                        BoxShadow(
                            color: Color.fromRGBO(0, 0, 0, .21),
                            blurRadius: 20,
                            offset: Offset(0, 10))
                      ]),
                      width: double.infinity,
                      child: ListView(
                        scrollDirection: Axis.horizontal,
                        children: [
                          InkWell(
                            onTap: () {
                              _selectCategory(1);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(1)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(10),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset(
                                    'assets/imgs/stethoscope1.png',
                                    height: 40.h,
                                    fit: BoxFit.cover,
                                    filterQuality: FilterQuality.high,
                                  ),
                                  SizedBox(
                                    height: 20.h,
                                  ),
                                  Text(
                                    'General',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(1)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(8);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(8)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset(
                                    'assets/imgs/pregnant.png',
                                    height: 40.h,
                                    fit: BoxFit.cover,
                                  ),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'Pregnancy',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(8)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(7);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(7)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset('assets/imgs/corona1.png',
                                      height: 40.h, fit: BoxFit.cover),
                                  SizedBox(
                                    height: 20.h,
                                  ),
                                  Text(
                                    ' Covid-19',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(7)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(6);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 120.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(6)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset('assets/imgs/sex.png',
                                      height: 40.h, fit: BoxFit.cover),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'Sexual\nHealth',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(6)
                                            ? selectText
                                            : unselectText),
                                    textAlign: TextAlign.center,
                                  ),
                                  // SizedBox(height: 8.h,),
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(3);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(3)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset('assets/imgs/red-ribbon.png',
                                      height: 40.h, fit: BoxFit.cover),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'HIV',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(3)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(5);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(5)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset('assets/imgs/kids.png',
                                      height: 40.h, fit: BoxFit.cover),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'Child\nHealth',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(5)
                                            ? selectText
                                            : unselectText),
                                    textAlign: TextAlign.center,
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(4);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(4)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset(
                                    'assets/imgs/diet.png',
                                    height: 30.h,
                                    fit: BoxFit.cover,
                                  ),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'Nutrition',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(4)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                          SizedBox(
                            width: 8.w,
                          ),
                          InkWell(
                            onTap: () {
                              _selectCategory(2);
                            },
                            child: AnimatedContainer(
                              duration: const Duration(milliseconds: 300),
                              width: MediaQuery.of(context).size.width * 0.25,
                              height: 100.h,
                              decoration: BoxDecoration(
                                gradient: LinearGradient(
                                    colors: isSelected(2)
                                        ? selectedColor
                                        : unselectedColor,
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight),
                                borderRadius: BorderRadius.circular(15),
                              ),
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                children: [
                                  Image.asset(
                                    'assets/imgs/glass.png',
                                    height: 30.h,
                                    fit: BoxFit.cover,
                                  ),
                                  SizedBox(
                                    height: 15.h,
                                  ),
                                  Text(
                                    'Others',
                                    style: TextStyle(
                                        fontFamily: 'Poppins',
                                        fontWeight: FontWeight.w600,
                                        fontSize: 15.sp,
                                        color: isSelected(2)
                                            ? selectText
                                            : unselectText),
                                  )
                                ],
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  )),
              SizedBox(
                height: 50.h,
              ),
              FadeAnimation(
                1.5,
                0,
                30,
                Text(
                  'Record or type your question in the field below.',
                  style: TextStyle(
                      fontFamily: 'Lato',
                      fontWeight: FontWeight.w700,
                      fontSize: 21.sp,
                      color: const Color.fromRGBO(85, 80, 80, 0.98)),
                  maxLines: 3,
                ),
              ),
              SizedBox(
                height: 20.h,
              ),
              FadeAnimation(
                1.6,
                0,
                30,
                isRecording
                    ? Row(
                        children: [
                          const CircularProgressIndicator.adaptive(
                            valueColor:
                                AlwaysStoppedAnimation<Color>(Colors.green),
                          ),
                          SizedBox(
                            width: 10.w,
                          ),
                          const Text(
                            'Recording...',
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontWeight: FontWeight.w400,
                                fontSize: 18),
                          )
                        ],
                      )
                    : _saving
                        ? const Row(
                            children: [
                              CircularProgressIndicator.adaptive(
                                valueColor:
                                    AlwaysStoppedAnimation<Color>(Colors.green),
                              ),
                              Padding(
                                padding: EdgeInsets.all(8.0),
                                child: Text(
                                  'Uploading..',
                                  style: TextStyle(
                                      fontFamily: 'Lato',
                                      fontWeight: FontWeight.w400,
                                      fontSize: 18),
                                ),
                              )
                            ],
                          )
                        : Form(
                            key: _formKey,
                            child: Container(
                              height: 130.h,
                              width: 400.w,
                              decoration: BoxDecoration(
                                  color: Colors.white,
                                  boxShadow: const [
                                    BoxShadow(
                                        color: Color.fromRGBO(0, 0, 0, 0.1),
                                        blurRadius: 20,
                                        offset: Offset(0, 10))
                                  ],
                                  borderRadius: BorderRadius.circular(10)),
                              child: TextFormField(
                                expands: true,
                                maxLines: null,
                                minLines: null,
                                controller: textController,
                                validator: Validator.textValidator,
                                decoration: InputDecoration(
                                  enabled: !_saving,
                                  contentPadding: EdgeInsets.all(12.h),
                                  focusColor: Colors.green,
                                  errorStyle: TextStyle(
                                      fontSize: 13.sp, color: Colors.red),
                                  border: InputBorder.none,
                                  errorBorder: const OutlineInputBorder(
                                    borderSide: BorderSide(
                                      color: Colors.red,
                                    ),
                                    borderRadius: BorderRadius.all(
                                      Radius.circular(15.0),
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          ),
              ),
              SizedBox(
                height: 20.h,
              ),
              FadeAnimation(
                  1.7,
                  0,
                  30,
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      _saving
                          ? const SizedBox.shrink()
                          : textController.text.isNotEmpty
                              ? const SizedBox.shrink()
                              : isRecording
                                  ? InkWell(
                                      onTap: () {
                                        setState(() {
                                          isRecording = false;
                                        });
                                        cancelRecording();
                                      },
                                      child: const Icon(CupertinoIcons.delete,
                                          color: Colors.green, size: 30),
                                    )
                                  : IconButton(
                                      iconSize: 28.w,
                                      onPressed: () async {
                                        handleImageSelection();
                                      },
                                      icon: const Icon(
                                        CupertinoIcons.camera,
                                        color: Colors.green,
                                      )),
                      SizedBox(
                        width: 5.w,
                      ),
                      _saving
                          ? const SizedBox.shrink()
                          : textController.text.isEmpty
                              ? isRecording
                                  ? FloatingActionButton(
                                      onPressed: () {
                                        stopRecording();
                                      },
                                      backgroundColor: Colors.green,
                                      elevation: 0,
                                      child: const Icon(
                                        Icons.send,
                                        color: Colors.white,
                                        size: 24,
                                      ),
                                    )
                                  : IconButton(
                                      iconSize: 28.w,
                                      onPressed: () {
                                        handleRecording();
                                      },
                                      icon: const Icon(CupertinoIcons.mic,
                                          color: Colors.green))
                              : InkWell(
                                  onTap: () {
                                    if (!_saving) {
                                      setState(() {
                                        _saving = true;
                                      });
                                      handlequestion();
                                    }
                                  },
                                  child: Container(
                                    width: 120.w,
                                    height: 40.h,
                                    decoration: BoxDecoration(
                                        color: const Color(0xFFB5E255),
                                        borderRadius: BorderRadius.circular(50),
                                        boxShadow: const [
                                          BoxShadow(
                                              color:
                                                  Color.fromRGBO(0, 0, 0, .25),
                                              blurRadius: 20,
                                              offset: Offset(0, 10))
                                        ]),
                                    child: _saving
                                        ? Center(
                                            child: SizedBox(
                                              height: 20.w,
                                              width: 20.w,
                                              child:
                                                  const CircularProgressIndicator
                                                      .adaptive(
                                                strokeWidth: 3,
                                                backgroundColor: Colors.white,
                                              ),
                                            ),
                                          )
                                        : Center(
                                            child: Text(
                                              'SEND',
                                              style: TextStyle(
                                                  fontSize: 18.sp,
                                                  fontFamily: 'Poppins',
                                                  fontWeight: FontWeight.w600,
                                                  color: Colors.white),
                                            ),
                                          ),
                                  ),
                                )
                    ],
                  ))
            ],
          ),
        ),
      ),
    );
  }

  void _selectCategory(int i) {
    if (!_saving) {
      setState(() {
        selectedId = i;
      });
    }
  }

  bool isSelected(int i) {
    return selectedId == i ? true : false;
  }

  void handlequestion() {
    if (selectedId == null) {
      setState(() {
        _saving = false;
      });
      showDialog(
          context: context,
          builder: (BuildContext context) {
            return const Popup(
              msg: 'Please, select a Question Category',
            );
          });
      // Popup(msg: 'Please, select Question Category',);
    } else {
      var form = _formKey.currentState!;

      if (form.validate()) {
        Map<String, dynamic> dataMap = {
          "token": currentUser.token,
          "msg": textController.text,
          'id': selectedId
        };

        sendQuestion(dataMap).then((value) {
          if (kDebugMode) {
            print(value);
          }
          if (value['status'] == 'success') {
            if (kDebugMode) {
              print('its a success');
            }
            var questionId = value['data']['id'];

            setState(() {
              _saving = false;
            });

            Navigator.pop(context);
            Navigator.push(
                context,
                PageAnimationTransition(
                    pageAnimationType: TopToBottomTransition(),
                    page: ChatDetails(
                      id: questionId,
                    ))).then((value) => onGoBack(value));
          } else {
            setState(() {
              _saving = false;
            });
            return showDialog(
                context: context,
                builder: (BuildContext context) {
                  return Popup(
                    msg: value['message'],
                  );
                });
          }
        });
      } else {
        setState(() {
          _saving = false;
        });
      }
    }
  }

  Future<void> uploadFile(
    String path,
    CloudinaryResourceType type,
  ) async {
    // var path = type == CloudinaryResourceType.Image? image
    try {
      CloudinaryResponse response = await cloudinary.uploadFile(
        CloudinaryFile.fromFile(path, resourceType: type),
      );

      if (kDebugMode) {
        print(response.secureUrl);
      }
      // sendMediaFollowUp(response.secureUrl);
      Map<String, dynamic> dataMap = {
        "token": currentUser.token,
        "media_url": response.secureUrl,
        // "msg": textController.text,
        'id': selectedId
      };
      sendQuestion(dataMap).then((value) {
        if (kDebugMode) {
          print(value);
        }
        if (value['status'] == 'success') {
          if (kDebugMode) {
            print('its a success');
          }
          var questionId = value['data']['id'];

          setState(() {
            _saving = false;
          });

          Navigator.pop(context);
          Navigator.push(
              context,
              PageAnimationTransition(
                  pageAnimationType: TopToBottomTransition(),
                  page: ChatDetails(
                    id: questionId,
                  ))).then((value) => onGoBack(value));
        } else {
          setState(() {
            _saving = false;
          });
          return showDialog(
              context: context,
              builder: (BuildContext context) {
                return Popup(
                  msg: value['message'],
                );
              });
        }
      });
      // return response.secureUrl;
    } on CloudinaryException catch (e) {
      if (kDebugMode) {
        print(e.message);
        print(e.request);
      }
      // return 'error';
      return showDialog(
          context: context,
          builder: (BuildContext context) {
            return Popup(
              msg: e.message,
            );
          });
    }
  }

  Future<String?> _findLocalPath() async {
    final directory = Platform.isAndroid
        ? await getExternalStorageDirectory()
        // ? await
        : await getApplicationDocumentsDirectory();
    if (kDebugMode) {
      print("File path: ${directory?.path}");
    }
    return directory?.path;
  }

  void startRecording() async {
    if (kDebugMode) {
      print('in start recording');
    }
    var platformExtension = Platform.isAndroid ? 'm4a' : 'caf';
    var pathV = await _findLocalPath();
    try {
      if (await _audioRecorder.hasPermission()) {
        await _audioRecorder.start(
            path:
                '${pathV!}${Platform.pathSeparator}recording_${DateTime.now()}.$platformExtension');

        if (kDebugMode) {
          print('in start recording try');
        }
        bool isRecordingAudio = await _audioRecorder.isRecording();
        if (kDebugMode) {
          print(isRecordingAudio);
        }
        setState(() {
          isRecording = isRecordingAudio;
          // _recordDuration = 0;
        });

        // _startTimer();
      }
    } catch (e) {
      if (kDebugMode) {
        print(e);
      }
    }
  }

  void cancelRecording() async {
    await _audioRecorder.stop();
    bool isRecordingAudio = await _audioRecorder.isRecording();
    setState(() {
      isRecording = isRecordingAudio;
      // _recordDuration = 0;
    });
  }

  void stopRecording() async {
    final path = await _audioRecorder.stop();
    bool isRecordingAudio = await _audioRecorder.isRecording();
    setState(() {
      isRecording = isRecordingAudio;
    });
    if (kDebugMode) {
      print(path);
    }
    setState(() {
      _saving = true;
    });
    uploadFile(path!, CloudinaryResourceType.Auto).then((value) {});
  }

  void handleRecording() {
    if (selectedId == null) {
      showDialog(
          context: context,
          builder: (BuildContext context) {
            return const Popup(
              msg: 'Please, select a Question Category',
            );
          });
      // Popup(msg: 'Please, select Question Category',);
    } else {
      setState(() {
        isRecording = true;
      });
      if (kDebugMode) {
        print('record');
      }
      startRecording();
    }
  }

  Future<void> handleImageSelection() async {
    if (selectedId == null) {
      showDialog(
          context: context,
          builder: (BuildContext context) {
            return const Popup(
              msg: 'Please, select a Question Category',
            );
          });
      // Popup(msg: 'Please, select Question Category',);
    } else {
      var image = await ImagePicker.platform
          .getImageFromSource(source: ImageSource.gallery);

      if (image != null) {
        setState(() {
          _saving = true;
        });

        uploadFile(image.path, CloudinaryResourceType.Image);
      }
    }
  }
}
