import 'dart:io';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class CustomPasswordField extends StatefulWidget {
  final FocusNode? nextFocus;
  final FocusNode currentFocus;
  final Function fieldValidator;
  final String fieldHintText;
  final TextInputAction fieldTextInputAction;
  final TextEditingController fieldController;
  final bool? isEnabled;

  const CustomPasswordField(
      {Key? key,
      required this.fieldController,
      required this.fieldValidator,
      required this.currentFocus,
      required this.fieldHintText,
      required this.fieldTextInputAction,
      this.isEnabled,
      this.nextFocus})
      : super(key: key);

  @override
  CustomPasswordFieldState createState() => CustomPasswordFieldState();
}

class CustomPasswordFieldState extends State<CustomPasswordField> {
  bool _obscureText = true;

  @override
  void initState() {
    super.initState();
    widget.currentFocus.addListener(_onOnFocusNodeEvent);
  }

  _onOnFocusNodeEvent() {
    setState(() {});
  }

  void _toggleObscurity() {
    setState(() {
      _obscureText = !_obscureText;
    });
  }

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
            keyboardType: TextInputType.text,
            obscureText: _obscureText,
            suffixMode: OverlayVisibilityMode.editing,
            suffix: IconButton(
              icon: _obscureText == true
                  ? const Icon(
                      Icons.visibility,
                      color: Color(0xFFB5E255),
                    )
                  : const Icon(
                      Icons.visibility_off,
                      color: Color(0xFFB5E255),
                    ),
              onPressed: _toggleObscurity,
            ),
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
              suffixIcon: IconButton(
                icon: _obscureText == true
                    ? const Icon(
                        Icons.visibility,
                        color: Color(0xFFB5E255),
                      )
                    : const Icon(
                        Icons.visibility_off,
                        color: Color(0xFFB5E255),
                      ),
                onPressed: _toggleObscurity,
              ),
              errorStyle: TextStyle(
                fontSize: 11.sp,
              ),
              border: InputBorder.none,
              focusedErrorBorder: const OutlineInputBorder(
                borderSide: BorderSide(color: Colors.red),
                borderRadius: BorderRadius.all(
                  Radius.circular(15.0),
                ),
              ),
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
                  fontSize: 15.sp,
                  fontFamily: 'Lato'),
            ),
            keyboardType: TextInputType.text,
            style: const TextStyle(color: Colors.black),
            validator: widget.fieldValidator as String? Function(String?)?,
            obscureText: _obscureText,
            onFieldSubmitted: (v) {
              FocusScope.of(context).requestFocus(widget.nextFocus);
            },
          );
  }
}
