import 'package:bisa_app/models/current_user.dart';
import 'package:flutter/material.dart';

class CurrentUserProvider extends ChangeNotifier {
  CurrentUser? _currentUser;

  CurrentUser? get currentUser => _currentUser;

  setCurrentUser(CurrentUser c) {
    _currentUser = c;
    notifyListeners();
  }

  clearCurrentUser() {
    _currentUser = null;
    notifyListeners();
  }
}
