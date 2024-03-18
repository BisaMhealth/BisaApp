

import 'dart:io';

import 'package:flutter/material.dart';
import 'package:page_transition/page_transition.dart';

void PagetransAnimate(BuildContext context,PageTransitionType pageTransitionType, Widget child){
  Navigator.pushReplacement(
    context,
    PageTransition(
      type: pageTransitionType,
      child: child,
      duration: Duration(milliseconds: 1500),
      isIos: Platform.isIOS,
    ),
  );
}

void PageAnimateNoRep(BuildContext context,PageTransitionType pageTransitionType, Widget child){
  Navigator.push(
    context,
    PageTransition(
      type: pageTransitionType,
      child: child,
      duration: Duration(milliseconds: 1500),
      isIos: Platform.isIOS,
    ),
  );
}