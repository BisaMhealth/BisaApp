import 'dart:io';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class CustomTextField extends StatefulWidget {
  final FocusNode? nextFocus;
  final FocusNode currentFocus;
  final Function fieldValidator;
  final String fieldHintText;
  final TextInputAction fieldTextInputAction;
  final TextEditingController fieldController;
  final TextInputType? keyboardType;
  final bool? isEnabled;

  const CustomTextField(
      {Key? key,
      required this.fieldController,
      required this.fieldValidator,
      required this.currentFocus,
      required this.fieldHintText,
      required this.fieldTextInputAction,
      this.keyboardType,
      this.nextFocus,
      this.isEnabled})
      : super(key: key);

  @override
  CustomTextFieldState createState() => CustomTextFieldState();
}

class CustomTextFieldState extends State<CustomTextField> {
  @override
  void initState() {
    super.initState();
    widget.currentFocus.addListener(_onOnFocusNodeEvent);
  }

  _onOnFocusNodeEvent() {
    setState(() {});
  }

  bool isFocused = false;

  @override
  Widget build(BuildContext context) {
    // SizeConfig().init(context);

    return Platform.isIOS
        ? CupertinoTextField.borderless(
            padding: EdgeInsets.all(12.h),
            enabled: widget.isEnabled,
            focusNode: widget.currentFocus,
            controller: widget.fieldController,
            textInputAction: widget.fieldTextInputAction,
            placeholder: widget.fieldHintText,
            placeholderStyle: TextStyle(
              fontWeight: FontWeight.w500,
              color: const Color(0xFFC8C7C7),
              fontFamily: 'Lato',
              fontSize: 15.sp,
            ),
            clearButtonMode: OverlayVisibilityMode.editing,
            keyboardType: widget.keyboardType ?? TextInputType.text,
            style: const TextStyle(color: Colors.black),
            onSubmitted: (v) {
              FocusScope.of(context).requestFocus(widget.nextFocus);
            },
          )
        : TextFormField(
            enabled: widget.isEnabled,
            focusNode: widget.currentFocus,
            controller: widget.fieldController,
            textInputAction: widget.fieldTextInputAction,
            decoration: InputDecoration(
              enabled: !widget.isEnabled!,
              contentPadding: EdgeInsets.all(12.h),
              errorStyle: TextStyle(
                fontSize: 11.sp,
              ),
              border: InputBorder.none,
              errorBorder: const OutlineInputBorder(
                borderSide: BorderSide(
                  color: Colors.red,
                ),
                borderRadius: BorderRadius.all(
                  Radius.circular(15.0),
                ),
              ),
              hintText: widget.fieldHintText,
              hintStyle: TextStyle(
                fontWeight: FontWeight.w500,
                color: const Color(0xFFC8C7C7),
                fontFamily: 'Lato',
                fontSize: 15.sp,
              ),
            ),
            keyboardType: widget.keyboardType ?? TextInputType.text,
            style: const TextStyle(color: Colors.black),
            validator: widget.fieldValidator as String? Function(String?)?,
            onFieldSubmitted: (v) {
              FocusScope.of(context).requestFocus(widget.nextFocus);
            },
          );
  }
}
