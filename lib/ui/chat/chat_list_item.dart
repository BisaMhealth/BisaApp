import 'package:badges/badges.dart' as badges;
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class ChatListItem extends StatefulWidget {
  const ChatListItem(
      {Key? key,
      required this.category,
      required this.lastmsg,
      required this.time,
      required this.isClosed,
      required this.media,
      required this.hasUnRead})
      : super(key: key);

  final String category, lastmsg, time, hasUnRead;
  final String? media;
  final bool isClosed;

  @override
  ChatListItemState createState() => ChatListItemState();
}

class ChatListItemState extends State<ChatListItem> {
  @override
  Widget build(BuildContext context) {
    bool hasMedia = widget.media == "none" ? false : true;
    return Container(
      width: 1.sw,
      decoration: const BoxDecoration(color: Colors.white),
      child: Column(
        children: [
          badges.Badge(
            position: badges.BadgePosition.topEnd(top: 40.h, end: 30.w),
            badgeStyle: const badges.BadgeStyle(badgeColor: Colors.green,),
            // badgeColor: Colors.green,
            showBadge: widget.hasUnRead == 'true' ? true : false,
            badgeContent: Text(
              '1',
              style: TextStyle(
                  color: Colors.white,
                  fontFamily: 'Lato',
                  fontWeight: FontWeight.w400,
                  fontSize: 14.sp),
            ),
            child: Padding(
              padding: const EdgeInsets.only(left: 8.0, right: 8.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  SizedBox(
                    // color: Colors.blue,
                    width: 0.75.sw,
                    child: Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            widget.category,
                            style: TextStyle(
                                fontFamily: 'Lato',
                                fontSize: 19.sp,
                                fontWeight: FontWeight.w700,
                                color: const Color.fromRGBO(66, 61, 61, 1)),
                          ),
                          SizedBox(
                            height: 8.h,
                          ),
                          hasMedia
                              ? Row(
                                  children: [
                                    widget.media == 'Image'
                                        ? Icon(
                                            CupertinoIcons.photo,
                                            size: 18.h,
                                          )
                                        : widget.media == 'Audio'
                                            ? Icon(
                                                CupertinoIcons.mic_fill,
                                                size: 18.h,
                                              )
                                            : const SizedBox.shrink(),
                                    // Icon(CupertinoIcons.mic_fill,size: 18.h,),
                                    SizedBox(
                                      width: 5.w,
                                    ),
                                    Text(
                                      '${widget.media}',
                                      style: TextStyle(
                                          fontFamily: 'Lato',
                                          fontSize: 15.sp,
                                          fontWeight: FontWeight.w400,
                                          color:
                                              const Color.fromRGBO(151, 147, 147, 1)),
                                      overflow: TextOverflow.ellipsis,
                                    ),
                                  ],
                                )
                              : Text(
                                  widget.lastmsg,
                                  style: TextStyle(
                                      fontFamily: 'Lato',
                                      fontSize: 15.sp,
                                      fontWeight: FontWeight.w400,
                                      color: const Color.fromRGBO(151, 147, 147, 1)),
                                  overflow: TextOverflow.ellipsis,
                                ),
                        ],
                      ),
                    ),
                  ),
                  Column(
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      Text(
                        widget.time,
                        style: TextStyle(
                            fontFamily: 'Lato',
                            fontWeight: widget.hasUnRead == 'true'
                                ? FontWeight.w700
                                : FontWeight.w400,
                            fontSize: 15.sp,
                            color: widget.hasUnRead == 'true'
                                ? Colors.green
                                : const Color.fromRGBO(174, 159, 159, 1)),
                      ),
                      SizedBox(
                        height: 8.h,
                      ),
                      widget.isClosed
                          ? Container(
                              height: 20.h,
                              width: 60.w,
                              decoration: BoxDecoration(
                                  color: const Color.fromRGBO(182, 164, 144, 1),
                                  borderRadius: BorderRadius.circular(30)),
                              child: Center(
                                  child: Text(
                                'Closed',
                                style: TextStyle(
                                    color: Colors.white,
                                    fontFamily: 'Poppins',
                                    fontWeight: FontWeight.w400,
                                    fontSize: 10.sp),
                              )),
                            )
                          : const SizedBox.shrink(),
                      // : widget.hasUnRead == 'true'?
                      // Container(
                      //   width: 60.h,
                      //   decoration: BoxDecoration(
                      //     color: Colors.green,
                      //     // borderRadius: BorderRadius.circular(30),
                      //     shape: BoxShape.circle
                      //   ),
                      //   child: Center(
                      //     child: Text('1',
                      //       style: TextStyle(
                      //         color: Colors.white,
                      //         fontFamily: 'Poppins',
                      //         fontWeight: FontWeight.w400,
                      //         fontSize: 10.sp
                      //       ),
                      //     )
                      //   ),
                      // ):SizedBox.shrink()
                      // ,
                      SizedBox(
                        height: 6.h,
                      ),
                    ],
                  )
                ],
              ),
            ),
          ),
          const Divider(
            color: Color.fromRGBO(240, 228, 228, 1),
            thickness: 2,
          )
        ],
      ),
    );
  }
}
