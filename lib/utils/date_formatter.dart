// import 'package:flutterclutter/app_localizations.dart';
import 'package:intl/intl.dart';

class DateFormatter {
  // DateFormatter(this.localizations);

  // AppLocalizations localizations;

  String getVerboseDate(DateTime dateTime) {
    DateTime now = DateTime.now();
    DateTime justNow = now.subtract(const Duration(minutes: 1));
    DateTime localDateTime = dateTime.toLocal();

    if (!localDateTime.difference(justNow).isNegative) {
      return 'Today';
    }

    String roughTimeString = DateFormat('jm').format(dateTime);

    if (localDateTime.day == now.day &&
        localDateTime.month == now.month &&
        localDateTime.year == now.year) {
      return roughTimeString;
    }

    DateTime yesterday = now.subtract(const Duration(days: 1));

    if (localDateTime.day == yesterday.day &&
        localDateTime.month == now.month &&
        localDateTime.year == now.year) {
      return 'Yesterday';
    }

    if (now.difference(localDateTime).inDays < 4) {
      String weekday = DateFormat('EEEE').format(localDateTime);

      return weekday;
      // return '$weekday, $roughTimeString';
    }

    return DateFormat(
      'yMd',
    ).format(dateTime);
    // DateTime.february
    // return '${DateFormat('yMd',).format(dateTime)}, $roughTimeString';
  }

  String getMonth(int dateTime){
    switch (dateTime) {
      case 1 :
        return 'January';
      case 2:
        return 'February';

      case 3:
        return 'March';
      case 4:
        return 'April';
      case 5:
        return 'May';
      case 6:
        return 'June';
      case 7:
        return 'July';
      case 8:
        return 'August';
      case 9:
        return 'September';
      case 10:
        return 'October';
      case 11:
        return 'November';
      case 12:
        return 'December';
      default:
        return 'Unkown';
    }
  }

  String getWeekDay(int dateTime){
    switch (dateTime) {
      case 1 :
        return 'MON';
      case 2:
        return 'TUE';
      case 3:
        return 'WED';
      case 4:
        return 'THUR';
      case 5:
        return 'FRI';
      case 6:
        return 'SAT';
      case 7:
        return 'SUN';
      default:
        return 'NON';
    }
  }
}
