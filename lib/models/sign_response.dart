// import '../animation/models/data.dart';

class SignResponse {
  int? code;
  String? status;
  String? message;
  SignData? data;

  SignResponse({this.code, this.status, this.message, this.data});

  @override
  String toString() {
    return 'SignResponse(code: $code, status: $status, message: $message, data: $data)';
  }

  factory SignResponse.fromJson(Map<String, dynamic> json) => SignResponse(
        code: json['code'] as int?,
        status: json['status'] as String?,
        message: json['message'] as String?,
        data: json['data'] == null
            ? null
            : SignData.fromJson(json['data'] as Map<String, dynamic>),
      );

  Map<String, dynamic> toJson() => {
        'code': code,
        'status': status,
        'message': message,
        'data': data?.toJson(),
      };

  SignResponse copyWith({
    int? code,
    String? status,
    String? message,
    SignData? data,
  }) {
    return SignResponse(
      code: code ?? this.code,
      status: status ?? this.status,
      message: message ?? this.message,
      data: data ?? this.data,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! SignResponse) return false;
    return other.code == code &&
        other.status == status &&
        other.message == message &&
        other.data == data;
  }

  @override
  int get hashCode =>
      code.hashCode ^ status.hashCode ^ message.hashCode ^ data.hashCode;
}

class SignData {
  User? user;
  String? token;

  SignData({this.user, this.token});

  @override
  String toString() => 'SignData(user: $user, token: $token)';

  factory SignData.fromJson(Map<String, dynamic> json) => SignData(
        user: json['user'] == null
            ? null
            : User.fromJson(json['user'] as Map<String, dynamic>),
        token: json['token'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'user': user?.toJson(),
        'token': token,
      };

  SignData copyWith({
    User? user,
    String? token,
  }) {
    return SignData(
      user: user ?? this.user,
      token: token ?? this.token,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! SignData) return false;
    return other.user == user && other.token == token;
  }

  @override
  int get hashCode => user.hashCode ^ token.hashCode;
}

class User {
  String? firstName;
  String? lastName;
  String? email;
  String? telephoneNumber;
  dynamic gender;
  dynamic regionId;
  dynamic cityId;
  String? registeredOn;
  String? registeredBy;
  String? mask;
  String? updatedAt;
  String? createdAt;
  int? id;
  LastLogin? lastLogin;
  String? city;
  String? region;

  User({
    this.firstName,
    this.lastName,
    this.email,
    this.telephoneNumber,
    this.gender,
    this.regionId,
    this.cityId,
    this.registeredOn,
    this.registeredBy,
    this.mask,
    this.updatedAt,
    this.createdAt,
    this.id,
    this.lastLogin,
    this.city,
    this.region,
  });

  @override
  String toString() {
    return 'User(firstName: $firstName, lastName: $lastName, email: $email, telephoneNumber: $telephoneNumber, gender: $gender, regionId: $regionId, cityId: $cityId, registeredOn: $registeredOn, registeredBy: $registeredBy, mask: $mask, updatedAt: $updatedAt, createdAt: $createdAt, id: $id, lastLogin: $lastLogin, city: $city, region: $region)';
  }

  factory User.fromJson(Map<String, dynamic> json) => User(
        firstName: json['first_name'] as String?,
        lastName: json['last_name'] as String?,
        email: json['email'] as String?,
        telephoneNumber: json['telephone_number'] as String?,
        gender: json['gender'] as dynamic,
        regionId: json['region_id'] as dynamic,
        cityId: json['city_id'] as dynamic,
        registeredOn: json['registered_on'] as String?,
        registeredBy: json['registered_by'] as String?,
        mask: json['mask'] as String?,
        updatedAt: json['updated_at'] as String?,
        createdAt: json['created_at'] as String?,
        id: json['id'] as int?,
        lastLogin: json['last_login'] == null
            ? null
            : LastLogin.fromJson(json['last_login'] as Map<String, dynamic>),
        city: json['city'] as String?,
        region: json['region'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'first_name': firstName,
        'last_name': lastName,
        'email': email,
        'telephone_number': telephoneNumber,
        'gender': gender,
        'region_id': regionId,
        'city_id': cityId,
        'registered_on': registeredOn,
        'registered_by': registeredBy,
        'mask': mask,
        'updated_at': updatedAt,
        'created_at': createdAt,
        'id': id,
        'last_login': lastLogin?.toJson(),
        'city': city,
        'region': region,
      };

  User copyWith({
    String? firstName,
    String? lastName,
    String? email,
    String? telephoneNumber,
    dynamic gender,
    dynamic regionId,
    dynamic cityId,
    String? registeredOn,
    String? registeredBy,
    String? mask,
    String? updatedAt,
    String? createdAt,
    int? id,
    LastLogin? lastLogin,
    String? city,
    String? region,
  }) {
    return User(
      firstName: firstName ?? this.firstName,
      lastName: lastName ?? this.lastName,
      email: email ?? this.email,
      telephoneNumber: telephoneNumber ?? this.telephoneNumber,
      gender: gender ?? this.gender,
      regionId: regionId ?? this.regionId,
      cityId: cityId ?? this.cityId,
      registeredOn: registeredOn ?? this.registeredOn,
      registeredBy: registeredBy ?? this.registeredBy,
      mask: mask ?? this.mask,
      updatedAt: updatedAt ?? this.updatedAt,
      createdAt: createdAt ?? this.createdAt,
      id: id ?? this.id,
      lastLogin: lastLogin ?? this.lastLogin,
      city: city ?? this.city,
      region: region ?? this.region,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! User) return false;
    return other.firstName == firstName &&
        other.lastName == lastName &&
        other.email == email &&
        other.telephoneNumber == telephoneNumber &&
        other.gender == gender &&
        other.regionId == regionId &&
        other.cityId == cityId &&
        other.registeredOn == registeredOn &&
        other.registeredBy == registeredBy &&
        other.mask == mask &&
        other.updatedAt == updatedAt &&
        other.createdAt == createdAt &&
        other.id == id &&
        other.lastLogin == lastLogin &&
        other.city == city &&
        other.region == region;
  }

  @override
  int get hashCode =>
      firstName.hashCode ^
      lastName.hashCode ^
      email.hashCode ^
      telephoneNumber.hashCode ^
      gender.hashCode ^
      regionId.hashCode ^
      cityId.hashCode ^
      registeredOn.hashCode ^
      registeredBy.hashCode ^
      mask.hashCode ^
      updatedAt.hashCode ^
      createdAt.hashCode ^
      id.hashCode ^
      lastLogin.hashCode ^
      city.hashCode ^
      region.hashCode;
}

class LastLogin {
  String? date;
  int? timezoneType;
  String? timezone;

  LastLogin({this.date, this.timezoneType, this.timezone});

  @override
  String toString() {
    return 'LastLogin(date: $date, timezoneType: $timezoneType, timezone: $timezone)';
  }

  factory LastLogin.fromJson(Map<String, dynamic> json) => LastLogin(
        date: json['date'] as String?,
        timezoneType: json['timezone_type'] as int?,
        timezone: json['timezone'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'date': date,
        'timezone_type': timezoneType,
        'timezone': timezone,
      };

  LastLogin copyWith({
    String? date,
    int? timezoneType,
    String? timezone,
  }) {
    return LastLogin(
      date: date ?? this.date,
      timezoneType: timezoneType ?? this.timezoneType,
      timezone: timezone ?? this.timezone,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! LastLogin) return false;
    return other.date == date &&
        other.timezoneType == timezoneType &&
        other.timezone == timezone;
  }

  @override
  int get hashCode => date.hashCode ^ timezoneType.hashCode ^ timezone.hashCode;
}
