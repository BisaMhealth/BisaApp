import 'package:bisa_app/services/api_service.dart';
import 'package:flutter/material.dart';

class SettingsProvider extends ChangeNotifier {
  // int _currentIndex = 0;
  // String? _currentTitle = 'Home';
  // int get currentIndex => _currentIndex;
  // String? get currentTitle => _currentTitle;
  dynamic _settings;
  dynamic get settings => _settings;

  // void changeView(int index, String? title) {
  //   _currentIndex = index;
  //   _currentTitle = title;
  //   notifyListeners();
  // }

  Future<void> getSettings() async {
    // _settings = await loadSettings();
    loadSettings().then((value) {
      if (value['status'] == 'success') {
        _settings = value['data'];
        notifyListeners();
      }
      // else{
      //   return showDialog(
      //     context: context,
      //     builder: (BuildContext context){
      //       return Popup(msg: value['message'],);
      //     }
      //   );
      // }
    });
  }

  setSettings(dynamic c) {
    _settings = c;
    notifyListeners();
  }
}
