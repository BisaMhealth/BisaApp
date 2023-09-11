import 'package:bisa_app/models/chat_list_response.dart';
import 'package:flutter/material.dart';

class BottomNavProvider extends ChangeNotifier {
  int _currentIndex = 0;
  String? _currentTitle = 'Home';
  List<ChatListResponseData?>? _chatList;
  int get currentIndex => _currentIndex;
  String? get currentTitle => _currentTitle;

  // ChatListResponse? get chatList => _chatList;

  List<ChatListResponseData?>? get chatList => _chatList;

  void changeView(int index, String? title) {
    _currentIndex = index;
    _currentTitle = title;
    notifyListeners();
  }

  void setChatData(List<ChatListResponseData?>? data) {
    _chatList = data;
    notifyListeners();
  }
}
