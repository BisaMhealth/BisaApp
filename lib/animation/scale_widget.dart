import 'package:flutter/material.dart';
import 'package:simple_animations/simple_animations.dart';

class ScaleWidget extends StatelessWidget {
  const ScaleWidget(
      {Key? key,
      required this.child,
      required this.offsetX,
      required this.offsetY,
      required this.time})
      : super(key: key);

  final Widget child;
  final double offsetX, offsetY;
  final int time;

  @override
  Widget build(BuildContext context) {
    final tween = MultiTween<AnimProps>()
      ..add(AnimProps.offset, Tween(begin: 0.2, end: 0.5),
          const Duration(milliseconds: 500), Curves.easeOut)
      ..add(AnimProps.offset, Tween(begin: 0.5, end: 0.2),
          const Duration(milliseconds: 500), Curves.easeOut);

    return LoopAnimation<MultiTweenValues<AnimProps>>(
      builder: (context, child, value) {
        return Transform.scale(
          scale: value.get(AnimProps.offset),
          child: child,
        );
      },
      tween: tween,
      duration: tween.duration * 5,
      child: child,
    );
  }
}

enum AnimProps { offset, color, opacity }
