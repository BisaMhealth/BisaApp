// import '../animation/models/data.dart';

class LoginResponse {
  int? code;
  String? status;
  String? message;
  LoginData? data;

  LoginResponse({this.code, this.status, this.message, this.data});

  @override
  String toString() {
    return 'LoginResponse(code: $code, status: $status, message: $message, data: $data)';
  }

  factory LoginResponse.fromJson(Map<String, dynamic> json) => LoginResponse(
        code: json['code'] as int?,
        status: json['status'] as String?,
        message: json['message'] as String?,
        data: json['data'] == null
            ? null
            : LoginData.fromJson(json['data'] as Map<String, dynamic>),
      );

  Map<String, dynamic> toJson() => {
        'code': code,
        'status': status,
        'message': message,
        'data': data?.toJson(),
      };

  LoginResponse copyWith({
    int? code,
    String? status,
    String? message,
    LoginData? data,
  }) {
    return LoginResponse(
      code: code ?? this.code,
      status: status ?? this.status,
      message: message ?? this.message,
      data: data ?? this.data,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! LoginResponse) return false;
    return other.code == code &&
        other.status == status &&
        other.message == message &&
        other.data == data;
  }

  @override
  int get hashCode =>
      code.hashCode ^ status.hashCode ^ message.hashCode ^ data.hashCode;
}

class LoginData {
  User? user;
  String? token;

  LoginData({this.user, this.token});

  @override
  String toString() => 'LoginData(user: $user, token: $token)';

  factory LoginData.fromJson(Map<String, dynamic> json) => LoginData(
        user: json['user'] == null
            ? null
            : User.fromJson(json['user'] as Map<String, dynamic>),
        token: json['token'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'user': user?.toJson(),
        'token': token,
      };

  LoginData copyWith({
    User? user,
    String? token,
  }) {
    return LoginData(
      user: user ?? this.user,
      token: token ?? this.token,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! LoginData) return false;
    return other.user == user && other.token == token;
  }

  @override
  int get hashCode => user.hashCode ^ token.hashCode;
}

class User {
  int? id;
  String? firstName;
  String? lastName;
  String? telephoneNumber;
  String? email;
  LastLogin? lastLogin;
  dynamic gender;
  dynamic regionId;
  dynamic sourceOfInfoId;
  dynamic cityId;
  String? registeredBy;
  dynamic dob;
  String? registeredOn;
  dynamic image;
  dynamic oldId;
  dynamic token;
  dynamic imageFilename;
  String? mask;
  String? createdAt;
  String? updatedAt;
  String? city;
  String? region;

  User({
    this.id,
    this.firstName,
    this.lastName,
    this.telephoneNumber,
    this.email,
    this.lastLogin,
    this.gender,
    this.regionId,
    this.sourceOfInfoId,
    this.cityId,
    this.registeredBy,
    this.dob,
    this.registeredOn,
    this.image,
    this.oldId,
    this.token,
    this.imageFilename,
    this.mask,
    this.createdAt,
    this.updatedAt,
    this.city,
    this.region,
  });

  @override
  String toString() {
    return 'User(id: $id, firstName: $firstName, lastName: $lastName, telephoneNumber: $telephoneNumber, email: $email, lastLogin: $lastLogin, gender: $gender, regionId: $regionId, sourceOfInfoId: $sourceOfInfoId, cityId: $cityId, registeredBy: $registeredBy, dob: $dob, registeredOn: $registeredOn, image: $image, oldId: $oldId, token: $token, imageFilename: $imageFilename, mask: $mask, createdAt: $createdAt, updatedAt: $updatedAt, city: $city, region: $region)';
  }

  factory User.fromJson(Map<String, dynamic> json) => User(
        id: json['id'] as int?,
        firstName: json['first_name'] as String?,
        lastName: json['last_name'] as String?,
        telephoneNumber: json['telephone_number'] as String?,
        email: json['email'] as String?,
        lastLogin: json['last_login'] == null
            ? null
            : LastLogin.fromJson(json['last_login'] as Map<String, dynamic>),
        gender: json['gender'] as dynamic,
        regionId: json['region_id'] as dynamic,
        sourceOfInfoId: json['source_of_info_id'] as dynamic,
        cityId: json['city_id'] as dynamic,
        registeredBy: json['registered_by'] as String?,
        dob: json['dob'] as dynamic,
        registeredOn: json['registered_on'] as String?,
        image: json['image'] as dynamic,
        oldId: json['old_id'] as dynamic,
        token: json['token'] as dynamic,
        imageFilename: json['image_filename'] as dynamic,
        mask: json['mask'] as String?,
        createdAt: json['created_at'] as String?,
        updatedAt: json['updated_at'] as String?,
        city: json['city'] as String?,
        region: json['region'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'first_name': firstName,
        'last_name': lastName,
        'telephone_number': telephoneNumber,
        'email': email,
        'last_login': lastLogin?.toJson(),
        'gender': gender,
        'region_id': regionId,
        'source_of_info_id': sourceOfInfoId,
        'city_id': cityId,
        'registered_by': registeredBy,
        'dob': dob,
        'registered_on': registeredOn,
        'image': image,
        'old_id': oldId,
        'token': token,
        'image_filename': imageFilename,
        'mask': mask,
        'created_at': createdAt,
        'updated_at': updatedAt,
        'city': city,
        'region': region,
      };

  User copyWith({
    int? id,
    String? firstName,
    String? lastName,
    String? telephoneNumber,
    String? email,
    LastLogin? lastLogin,
    dynamic gender,
    dynamic regionId,
    dynamic sourceOfInfoId,
    dynamic cityId,
    String? registeredBy,
    dynamic dob,
    String? registeredOn,
    dynamic image,
    dynamic oldId,
    dynamic token,
    dynamic imageFilename,
    String? mask,
    String? createdAt,
    String? updatedAt,
    String? city,
    String? region,
  }) {
    return User(
      id: id ?? this.id,
      firstName: firstName ?? this.firstName,
      lastName: lastName ?? this.lastName,
      telephoneNumber: telephoneNumber ?? this.telephoneNumber,
      email: email ?? this.email,
      lastLogin: lastLogin ?? this.lastLogin,
      gender: gender ?? this.gender,
      regionId: regionId ?? this.regionId,
      sourceOfInfoId: sourceOfInfoId ?? this.sourceOfInfoId,
      cityId: cityId ?? this.cityId,
      registeredBy: registeredBy ?? this.registeredBy,
      dob: dob ?? this.dob,
      registeredOn: registeredOn ?? this.registeredOn,
      image: image ?? this.image,
      oldId: oldId ?? this.oldId,
      token: token ?? this.token,
      imageFilename: imageFilename ?? this.imageFilename,
      mask: mask ?? this.mask,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
      city: city ?? this.city,
      region: region ?? this.region,
    );
  }

  @override
  bool operator ==(dynamic other) {
    if (identical(other, this)) return true;
    if (other is! User) return false;
    return other.id == id &&
        other.firstName == firstName &&
        other.lastName == lastName &&
        other.telephoneNumber == telephoneNumber &&
        other.email == email &&
        other.lastLogin == lastLogin &&
        other.gender == gender &&
        other.regionId == regionId &&
        other.sourceOfInfoId == sourceOfInfoId &&
        other.cityId == cityId &&
        other.registeredBy == registeredBy &&
        other.dob == dob &&
        other.registeredOn == registeredOn &&
        other.image == image &&
        other.oldId == oldId &&
        other.token == token &&
        other.imageFilename == imageFilename &&
        other.mask == mask &&
        other.createdAt == createdAt &&
        other.updatedAt == updatedAt &&
        other.city == city &&
        other.region == region;
  }

  @override
  int get hashCode =>
      id.hashCode ^
      firstName.hashCode ^
      lastName.hashCode ^
      telephoneNumber.hashCode ^
      email.hashCode ^
      lastLogin.hashCode ^
      gender.hashCode ^
      regionId.hashCode ^
      sourceOfInfoId.hashCode ^
      cityId.hashCode ^
      registeredBy.hashCode ^
      dob.hashCode ^
      registeredOn.hashCode ^
      image.hashCode ^
      oldId.hashCode ^
      token.hashCode ^
      imageFilename.hashCode ^
      mask.hashCode ^
      createdAt.hashCode ^
      updatedAt.hashCode ^
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
