import 'package:bisa_app/animation/fade_animation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:intl/intl.dart';
import 'package:transparent_image/transparent_image.dart';
// import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';

class TipDetails extends StatelessWidget {
  const TipDetails({Key? key, required this.article}) : super(key: key);

  final dynamic article;
  @override
  Widget build(BuildContext context) {
    var date = DateFormat.yMMMMd('en_US')
        .format(DateTime.parse(article['created_at']));
    return Scaffold(
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Column(
              children: [
                SizedBox(
                  height: 305.h,
                ),
                // Html(
                //   data: article['content'],
                //   // onLinkTap: (url,RenderContext context,toHome,elt){
                //   //   launchInBrowser(url!);
                //   // },
                // ),
                // HtmlWidget(article['content']),
              ],
            ),
          ),
          Stack(
            children: [
              SizedBox(
                height: 300.h,
                width: 1.sw,
                child: ClipRRect(
                  borderRadius: const BorderRadius.only(
                      bottomLeft: Radius.circular(25),
                      bottomRight: Radius.circular(25)),
                  // child: Image.asset('assets/imgs/article_pic.png',fit: BoxFit.cover,),
                  child: Hero(
                    tag: '${article['image']}',
                    child: FadeInImage.memoryNetwork(
                      placeholder: kTransparentImage,
                      image: '${article['image']}',
                      fit: BoxFit.cover,
                    ),
                  ),
                ),
              ),
              Container(
                height: 300.h,
                width: 1.sw,
                decoration: const BoxDecoration(
                  borderRadius: BorderRadius.only(
                      bottomLeft: Radius.circular(25),
                      bottomRight: Radius.circular(25)),
                  color: Colors.black26,
                ),
              ),
              SizedBox(
                height: 300.h,
                width: 1.sw,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Align(
                      alignment: Alignment.topLeft,
                      child: InkWell(
                        onTap: () {
                          Navigator.pop(context);
                        },
                        child: Container(
                          height: 60.h,
                          width: 60.h,
                          decoration: const BoxDecoration(
                              shape: BoxShape.circle, color: Colors.white54),
                          child: const Icon(Icons.keyboard_backspace),
                        ),
                      ),
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.center,
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        FadeAnimation(
                            1,
                            -30,
                            0,
                            Text(
                              '${article['title']}',
                              style: TextStyle(
                                fontFamily: 'Poppins',
                                fontSize: 30.sp,
                                fontWeight: FontWeight.w600,
                                color: Colors.white,
                              ),
                              textAlign: TextAlign.center,
                              maxLines: 3,
                            )),
                        SizedBox(
                          height: 12.sp,
                        ),
                        FadeAnimation(
                            1.2,
                            -30,
                            0,
                            Text(
                              date,
                              style: TextStyle(
                                  fontFamily: 'Poppins',
                                  fontSize: 18.sp,
                                  fontWeight: FontWeight.w500,
                                  color: Colors.white),
                              textAlign: TextAlign.center,
                            )),
                      ],
                    ),
                  ],
                ),
              )
            ],
          ),
        ],
      ),
    );
  }
}
