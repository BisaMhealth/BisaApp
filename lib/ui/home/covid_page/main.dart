import 'dart:async';
import 'package:bisa_app/ui/home/covid_page/browser.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';
import 'package:url_launcher/url_launcher.dart';
// import 'package:flutter_inappwebview/flutter_inappwebview.dart';

class CovidPage extends StatefulWidget {
  const CovidPage({Key? key}) : super(key: key);

  @override
  CovidPageState createState() => CovidPageState();
}

class CovidPageState extends State<CovidPage> {
  // InAppWebViewController _webViewController;
  String url = "";
  double progress = 0;
  // final Completer<WebViewController> _controller =
  //     Completer<WebViewController>();
  // late final WebViewController _controller;
  String initialUrl = 'https://ghanahealth.maps.arcgis.com/apps/opsdashboard/index.html#/2acce23387f24cfbb8b9efe76a93e1f7';

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        leading: const BackButton(
          color: Colors.black,
        ),
        title: Text(
          'Covid-19',
          style: TextStyle(
              fontWeight: FontWeight.w700,
              fontFamily: 'Lato',
              fontSize: 30.sp,
              color: const Color.fromRGBO(85, 80, 80, 0.98)),
        ),
        elevation: 0,
      ),
      body: Stack(
        children: [
          SingleChildScrollView(
            child: Column(
              children: [
                SizedBox(
                  height: 670.h,
                  child: Covid19BrowserView(covidPageUrl: initialUrl),
                ),
                SizedBox(
                  height: 10.h,
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Text(
                        'Source: Ghana Health Service',
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontWeight: FontWeight.w700,
                            fontSize: 20.sp),
                      ),
                    ),
                  ],
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: InkWell(
                        onTap: () {
                          _launchInBrowser(
                              'https://ghanahealthservice.org/covid19/');
                        },
                        child: Text(
                          'https://ghanahealthservice.org/covid19/',
                          style: TextStyle(
                              fontFamily: 'Lato',
                              fontWeight: FontWeight.w400,
                              fontSize: 18.sp,
                              decoration: TextDecoration.underline,
                              color: Colors.blue),
                        ),
                      ),
                    ),
                  ],
                ),
                SizedBox(
                  height: 50.h,
                )
              ],
            ),
          ),
        ],
      ),
    );
  }
}

Future<void> _launchInBrowser(String url) async {
  if (await canLaunchUrl(Uri.parse(url))) {
    await launchUrl(
      Uri.parse(url),
      // forceSafariVC: true,
      // forceWebView: true,
      // headers: <String, String>{'my_header_key': 'my_header_value'},
    );
  } else {
    throw 'Could not launch $url';
  }
}
