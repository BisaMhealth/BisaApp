import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class MultiPopup extends StatefulWidget {
  const MultiPopup({
    Key? key,
    this.msg,
    required this.title,
    required this.img,
    required this.onTap,
  }) : super(key: key);
  final String? msg;
  final String title;
  final String img;
  final void Function() onTap;
  // final int type;
  @override
  MultiPopupState createState() => MultiPopupState();

  // static int TYPE_EXIT = 1;
  // static int TYPE_ERROR = 2;
}

class MultiPopupState extends State<MultiPopup> {
  @override
  Widget build(BuildContext context) {
    return Dialog(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      elevation: 5,
      backgroundColor: Colors.transparent,
      child: Container(
        padding: const EdgeInsets.all(18),
        width: 0.7.sw,
        decoration: BoxDecoration(
          shape: BoxShape.rectangle,
          color: Colors.white,
          borderRadius: BorderRadius.circular(12),
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Image.asset(
                widget.img,
                height: 90.h,
              ),
            ),
            SizedBox(height: 8.h),
            Text(
              widget.title,
              textAlign: TextAlign.center,
              style: TextStyle(
                  fontSize: 18.sp,
                  fontFamily: 'Poppins',
                  fontWeight: FontWeight.w800),
            ),
            SizedBox(height: 20.h),
            Text(
              widget.msg!,
              textAlign: TextAlign.center,
              style: Theme.of(context)
                  .textTheme
                  .headlineMedium
                  ?.copyWith(fontSize: 18.sp),
            ),
            SizedBox(height: 30.h),
            SizedBox(
              width: 0.4.sw,
              child: Center(
                child: Container(
                  decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(25),
                      color: const Color.fromRGBO(181, 226, 85, 1),
                      boxShadow: const [
                        BoxShadow(
                            color: Color.fromRGBO(0, 0, 0, .25),
                            blurRadius: 20,
                            offset: Offset(0, 10))
                      ]),
                  child: InkWell(
                    onTap: widget.onTap,
                    child: Padding(
                      padding: const EdgeInsets.only(
                          top: 15, right: 25, left: 25, bottom: 15.0),
                      child: Text('Okay',
                          style: TextStyle(
                              fontSize: 16.sp,
                              color: Colors.white,
                              fontWeight: FontWeight.w400)),
                    ),
                  ),
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
