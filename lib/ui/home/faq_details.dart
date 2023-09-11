import 'package:bisa_app/animation/fade_animation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class FaqDetails extends StatefulWidget {
  const FaqDetails({Key? key, this.content}) : super(key: key);

  final dynamic content;
  @override
  FaqDetailsState createState() => FaqDetailsState();
}

class FaqDetailsState extends State<FaqDetails> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        leading: const BackButton(
          color: Colors.black,
        ),
        title: Text(
          'Popular Questions',
          style: TextStyle(
              fontWeight: FontWeight.w700,
              fontFamily: 'Lato',
              fontSize: 27.sp,
              color: const Color.fromRGBO(85, 80, 80, 0.98)),
        ),
        elevation: 0,
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // SizedBox(height: 0.16.sh,),
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Text(
                '${widget.content['question']}',
                style: TextStyle(
                    color: Colors.black,
                    fontFamily: 'Lato',
                    fontSize: 26.sp,
                    fontWeight: FontWeight.w700),
              ),
            ),
            SizedBox(
              height: 25.h,
            ),
            FadeAnimation(
                1.3,
                -30,
                0,
                Padding(
                  padding: const EdgeInsets.all(28.0),
                  child: Text(
                    '${widget.content['answer']}',
                    style: TextStyle(
                        color: Colors.black,
                        fontFamily: 'Lato',
                        fontSize: 18.sp,
                        fontWeight: FontWeight.w400),
                  ),
                )),
          ],
        ),
      ),
    );
  }
}
