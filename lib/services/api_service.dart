import 'dart:convert';
import 'dart:io';
import 'package:bisa_app/models/models.dart';
import 'package:bisa_app/models/sign_response.dart';
import 'package:bisa_app/models/testing_res.dart';
import 'package:bisa_app/models/vaccination_res.dart';
import 'package:bisa_app/models/video_res.dart';
import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;

const oldBisa = 'https://ghapi.bisa.com.gh/api';
const newBisa = 'https://www.ghapp.bisa.com.gh/api';
http.Client client = http.Client();

Future<LoginResponse> loginUser(data) async {
  try {
    final http.Response response = await http
        // .post(Uri.parse('$oldBisa/user/role/login'),
        .post(Uri.parse('$newBisa/v1/patient/auth/login'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
            },
            body: jsonEncode(data)
            // body: jsonEncode({
            //   'userId': data['email'],
            //   'password': data['password'],
            // })
            );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return LoginResponse(
            code: 403,
            status: requestBody['status'],
            message: requestBody['message']
          );
      // break;
      default:
        // return requestBody;
        return LoginResponse(
            code: 405,
            status: 'error',
            message: 'Sorry Unable to Process Request.');
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return LoginResponse(
        code: 405,
        status: 'error',
        message: 'Please, Check your Internet Connection');
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return LoginResponse(
        code: 405,
        status: 'error',
        message: 'Sorry Unable to Process Request.');
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
  }
}

Future<dynamic> resetPwd(data) async {
  try {
    final http.Response response = await http
        // .post(Uri.parse('$oldBisa/user/role/login'),
        .post(Uri.parse('$newBisa/v1/patient/auth/reset-password'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
            },
            body: jsonEncode(data)
            // body: jsonEncode({
            //   'userId': data['email'],
            //   'password': data['password'],
            // })
            );

    var requestBody = jsonDecode(response.body);

    switch (response.statusCode) {
      case 200:
        return requestBody;
      // return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      // return LoginResponse(code: 403,status: requestBody['status'],message: requestBody['message'] );
      // break;
      default:
        // return requestBody;
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry Unable to Process Request.' );
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'Please, Check your Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry Unable to Process Request.' );
  }
}

Future<SignResponse> registerUser(data) async {
  try {
    final http.Response response =
        await http.post(Uri.parse('$newBisa/v1/patient/auth/register'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
            },
            body: jsonEncode(data));

    var requestBody = jsonDecode(response.body);
    if (kDebugMode) {
      print(requestBody);
    }

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return SignResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return SignResponse(
            code: 403, status: 'error', message: requestBody['message']);
      // break;
      default:
        // return requestBody;
        return SignResponse(
            code: 405,
            status: 'error',
            message: 'Sorry. Unable to Process Request.');
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return SignResponse(
        code: 500,
        status: 'error',
        message: 'Please Check your Internet Connection',
        data: null);
    // return LoginResponse(code: 405,status: 'error',message: 'No Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
    return SignResponse(
        code: 500,
        status: 'error',
        message: 'Sorry Unable to Process Request.',
        data: null);
  }
}

Future<dynamic> loadSettings() async {
  try {
    final http.Response response = await http.get(
        Uri.parse('$newBisa/v1/patient/settingsitems'),
        headers: <String, String>{
          'Content-Type': 'application/json; charset=UTF-8',
        });

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      // return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      // return showDialog(
      //       context: context,
      //       builder: (BuildContext context){
      //         return Popup(msg: value['message'],);
      //       }
      //     );
      // return LoginResponse(code: 403,status: requestBody['status'],message: requestBody['message'] );
      // break;
      default:
        // return requestBody;
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );

    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return {'message': 'No Internet Connection'};
    // return LoginResponse(code: 405,status: 'error',message: 'No Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {'message': 'Sorry, Unable to Process Request'};
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
  }
}

Future<dynamic> loadCities(regionId) async {
  try {
    final http.Response response = await http.get(
        Uri.parse('$newBisa/v1/patient/settingsitems/getcities/$regionId'),
        headers: <String, String>{
          'Content-Type': 'application/json; charset=UTF-8',
        });

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody['data'];
      // return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        return null;
      // return LoginResponse(code: 403,status: requestBody['status'],message: requestBody['message'] );
      // break;
      default:
        return null;
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );

    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'No Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
  }
}

Future<dynamic> sendInterest(data) async {
  try {
    final http.Response response =
        await http.post(Uri.parse('$newBisa/v1/patient/news-interest'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
              'Authorization': 'Bearer ${data['token']}',
            },
            body: jsonEncode({'interest': data['interest']}));

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      // return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      // return LoginResponse(code: 403,status: requestBody['status'],message: requestBody['message'] );
      // break;
      default:
        // return requestBody;
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
    }
  } on SocketException {
    // print('No Internet connection');
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'No Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
  }
}

Future<dynamic> sendQuestion(data) async {
  try {
    final http.Response response = await http.post(
        Uri.parse('$newBisa/v1/patient/question'),
        headers: <String, String>{
          'Content-Type': 'application/json; charset=UTF-8',
          'Authorization': 'Bearer ${data['token']}',
        },
        body: jsonEncode(
            {'question': data['msg'],
             'question_category_id': data['id'],
             'media_url': data['media_url']
            }));

    var requestBody = jsonDecode(response.body);
    if (kDebugMode) {
      print(jsonDecode(response.body));
    }

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      // return LoginResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      // return LoginResponse(code: 403,status: requestBody['status'],message: requestBody['message'] );
      // break;
      default:
        // return requestBody;
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
      // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'No Internet Connection' );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
    // return LoginResponse(code: 405,status: 'error',message: 'Sorry unable to process request.' );
  }
}

Future<ChatListResponse> loadChat(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/all-question'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $data',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return ChatListResponse.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return ChatListResponse(
          code: 403,
          status: requestBody['status'],
          message: requestBody['message']
        );
      // break;
      default:
        // return requestBody;
        return ChatListResponse(
            code: 405,
            status: 'error',
            message: 'Sorry unable to process request.');
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return ChatListResponse(
        code: 405, status: 'error', message: 'No Internet Connection');
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return ChatListResponse(
        code: 405,
        status: 'error',
        message: 'Sorry unable to process request.');
  }
}

Future<VaccinationRes> loadVaccination(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/vacinationcenter'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $data',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return VaccinationRes.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return VaccinationRes(
          code: 403,
          status: requestBody['status'],
          message: requestBody['message']
        );
      // break;
      default:
        // return requestBody;
        return VaccinationRes(
            code: 405,
            status: 'error',
            message: 'Sorry unable to process request.');
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return VaccinationRes(
        code: 405, status: 'error', message: 'No Internet Connection');
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return VaccinationRes(
        code: 405,
        status: 'error',
        message: 'Sorry unable to process request.');
  }
}

Future<TestingRes> loadTesting(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/testingcenter'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $data',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return TestingRes.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return TestingRes(
          code: 403,
          status: requestBody['status'],
          message: requestBody['message']
        );
      // break;
      default:
        // return requestBody;
        return TestingRes(
            code: 405,
            status: 'error',
            message: 'Sorry unable to process request.');
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return TestingRes(
        code: 405, status: 'error', message: 'No Internet Connection');
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return TestingRes(
        code: 405,
        status: 'error',
        message: 'Sorry unable to process request.');
  }
}

Future<ChatThread> getQuestionDetails(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/question/${data['id']}'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer ${data['token']}',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody;
        return ChatThread.fromJson(requestBody);
      // break;

      case 403:
        // return requestBody;
        return ChatThread(
            code: 403,
            status: requestBody['status'],
            message: requestBody['message']);
      // break;
      default:
        // return requestBody;
        return ChatThread(
            code: 405,
            status: 'error',
            message: 'Sorry unable to process request.');
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return ChatThread(
        code: 405, status: 'error', message: 'No Internet Connection');
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return ChatThread(
        code: 405,
        status: 'error',
        message: 'Sorry unable to process request.');
  }
}

Future<ConnectRes> getBooking(data) async{
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/bookings'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $data',
      },
    );

    var requestBody = jsonDecode(response.body);
    // print(response.body.toString());

    switch (requestBody['code']) {
      case 200:
        return ConnectRes.fromJson(requestBody);
      case 403:
        return ConnectRes(
          code: 403,
          status: requestBody['status'],
          message: requestBody['message']
        );
      default:
        return ConnectRes(
          code: 405,
          status: 'error',
          message: 'Sorry unable to process request.'
        );
    }
  } on SocketException{
    return ConnectRes(
      code: 405,
      status: 'error',
      message: 'No Internet Connection'
    );
  }
  catch (e) {
    return ConnectRes(
      code: 405,
      status: 'error',
      message: 'Sorry unable to process request.'
    );
  }
}

Future<dynamic> sendBooking(data) async {
  try {
    final http.Response response = await http.post(
      Uri.parse('$newBisa/v1/patient/bookings'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer ${data['token']}',
      },
      body: jsonEncode({
        'doctor_id': data['doctorId'],
        'day': data['day'],
        'time': data['time']
      })
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      
      case 403:
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      default:
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
    }
  } on SocketException{
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
  }
  catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
  }
}

Future<dynamic> sendFollowUp(data) async {
  try {
    final http.Response response =
        await http.post(Uri.parse('$newBisa/v1/patient/question/followup'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
              'Authorization': 'Bearer ${data['token']}',
            },
            body: jsonEncode({
              'question': data['msg'],
              'question_id': data['id'],
              'media_url': data['media_url']
            }));

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      // break;

      case 403:
        // return requestBody;
        return {
          'code': 403,
          'status': 'error',
          'message': requestBody['message']
        };
      // break;
      default:
        return {
          'code': 405,
          'status': 'error',
          'message': 'Sorry, Unable to Process Request'
        };
      // return requestBody;
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return {
      'code': 405,
      'status': 'error',
      'message': 'Please, Check your Internet Connection'
    };
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return {
      'code': 405,
      'status': 'error',
      'message': 'Sorry, Unable to Process Request'
    };
  }
}

Future<dynamic> getFaq() async {
  try {
    final http.Response response =
        await http.post(Uri.parse('https://ghapi.bisa.com.gh/api/faq/1'),
            headers: <String, String>{
              'Content-Type': 'application/json; charset=UTF-8',
            },
            body: jsonEncode({
              'token': '5c20d216f981585fe92e',
            }));

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody;
      // break;

      case 403:
        return requestBody;
      // break;
      default:
        return requestBody;
    }
  } on SocketException {
    // print('No Internet connection');
    throw 'No Internet connection';
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
  }
}

Future<dynamic> getArticles(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/article/${data['id']}'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer ${data['token']}',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        return requestBody['data'];
      // break;

      case 403:
        return requestBody;
      // break;
      default:
        return requestBody;
    }
  } on SocketException {
    // print('No Internet connection');
    throw 'No Internet connection';
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
  }
}

Future<VideosRes> getVideos(data) async {
  try {
    final http.Response response = await http.get(
      Uri.parse('$newBisa/v1/patient/video-list'),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
        'Authorization': 'Bearer $data',
      },
    );

    var requestBody = jsonDecode(response.body);

    switch (requestBody['code']) {
      case 200:
        // return requestBody['data'];
        return VideosRes.fromJson(requestBody);
      // break;

      case 403:
        return VideosRes(
          code: 403,
          status: requestBody['status'],
          message: requestBody['message']
        );
      // break;
      default:
        return VideosRes(
          code: 405,
          status: 'error',
          message: 'Sorry unable to process request.'
        );
    }
  } on SocketException {
    // print('No Internet connection');
    // throw 'No Internet connection';
    return VideosRes(
      code: 405,
      status: 'error',
      message: 'No Internet Connection'
    );
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    return VideosRes(
      code: 405,
      status: 'error',
      message: 'Sorry unable to process request.'
    );
  }
}
