import 'package:flutter/material.dart';
import 'package:simple_animations/simple_animations.dart';

class LoopWidget extends StatelessWidget {
  // final double delay;
  final Widget child;
  final double offset;
  final int time;

  const LoopWidget(this.offset, this.child, this.time, {super.key});

  @override
  Widget build(BuildContext context) {
    final tween = MultiTween<AniProps>()
      // ..add(AniProps.opacity, Tween(begin: 0.5, end: 1.0),Duration(milliseconds: 800))
      ..add(
          AniProps.height,
          Tween(begin: Offset(0, offset), end: (Offset.zero)),
          Duration(milliseconds: time))
      ..add(
          AniProps.height,
          Tween(begin: (Offset.zero), end: Offset(0, offset)),
          Duration(milliseconds: time));

    return LoopAnimation<MultiTweenValues<AniProps>>(
      builder: (context, child, value) {
        // return Opacity(
        //   opacity: value.get(AniProps.opacity),
        return Transform.translate(
          offset: value.get(AniProps.height),
          child: child,
        );
        // );
      },
      tween: tween,
      duration: tween.duration * 5,
      child: child,
    );
  }
}

enum AniProps { width, height, color, opacity }
