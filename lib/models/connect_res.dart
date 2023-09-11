import 'package:flutter/foundation.dart';

class ConnectRes {
  int? code;
  String? status;
  String? message;
  ConnectData? data;

  ConnectRes({this.code, this.status, this.message, this.data});

  @override
  String toString() {
    return 'ConnectRes(code: $code, status: $status, message: $message, data: $data)';
  }

  factory ConnectRes.fromJson(Map<String, dynamic> json) => ConnectRes(
        code: json['code'] as int?,
        status: json['status'] as String?,
        message: json['message'] as String?,
        data: json['data'] == null
            ? null
            : ConnectData.fromJson(json['data'] as Map<String, dynamic>),
      );

  Map<String, dynamic> toJson() => {
        'code': code,
        'status': status,
        'message': message,
        'data': data?.toJson(),
      };

  ConnectRes copyWith({
    int? code,
    String? status,
    String? message,
    ConnectData? data,
  }) {
    return ConnectRes(
      code: code ?? this.code,
      status: status ?? this.status,
      message: message ?? this.message,
      data: data ?? this.data,
    );
  }

  @override
  bool operator ==(Object other) {
    if (identical(other, this)) return true;
    if (other is! ConnectRes) return false;
    return mapEquals(other.toJson(), toJson());
  }

  @override
  int get hashCode =>
      code.hashCode ^ status.hashCode ^ message.hashCode ^ data.hashCode;
}

class ConnectData {
  List<Specialty>? specialties;
  List<dynamic>? booking;

  ConnectData({this.specialties, this.booking});

  @override
  String toString() => 'Data(specialties: $specialties, booking: $booking)';

  factory ConnectData.fromJson(Map<String, dynamic> json) => ConnectData(
        specialties: (json['specialties'] as List<dynamic>?)
            ?.map((e) => Specialty.fromJson(e as Map<String, dynamic>))
            .toList(),
        booking: json['booking'] as List<dynamic>?,
      );

  Map<String, dynamic> toJson() => {
        'specialties': specialties?.map((e) => e.toJson()).toList(),
        'booking': booking,
      };

  ConnectData copyWith({
    List<Specialty>? specialties,
    List<dynamic>? booking,
  }) {
    return ConnectData(
      specialties: specialties ?? this.specialties,
      booking: booking ?? this.booking,
    );
  }

  @override
  bool operator ==(Object other) {
    if (identical(other, this)) return true;
    if (other is! ConnectData) return false;
    return mapEquals(other.toJson(), toJson());
  }

  @override
  int get hashCode => specialties.hashCode ^ booking.hashCode;
}

class Specialty {
  int? id;
  String? name;
  String? description;
  String? mask;
  String? createdAt;
  String? updatedAt;
  List<Doctor>? doctors;

  Specialty({
    this.id,
    this.name,
    this.description,
    this.mask,
    this.createdAt,
    this.updatedAt,
    this.doctors,
  });

  @override
  String toString() {
    return 'Specialty(id: $id, name: $name, description: $description, mask: $mask, createdAt: $createdAt, updatedAt: $updatedAt, doctors: $doctors)';
  }

  factory Specialty.fromJson(Map<String, dynamic> json) => Specialty(
        id: json['id'] as int?,
        name: json['name'] as String?,
        description: json['description'] as String?,
        mask: json['mask'] as String?,
        createdAt: json['created_at'] as String?,
        updatedAt: json['updated_at'] as String?,
        doctors: (json['doctors'] as List<dynamic>?)
            ?.map((e) => Doctor.fromJson(e as Map<String, dynamic>))
            .toList(),
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'name': name,
        'description': description,
        'mask': mask,
        'created_at': createdAt,
        'updated_at': updatedAt,
        'doctors': doctors?.map((e) => e.toJson()).toList(),
      };

  Specialty copyWith({
    int? id,
    String? name,
    String? description,
    String? mask,
    String? createdAt,
    String? updatedAt,
    List<Doctor>? doctors,
  }) {
    return Specialty(
      id: id ?? this.id,
      name: name ?? this.name,
      description: description ?? this.description,
      mask: mask ?? this.mask,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
      doctors: doctors ?? this.doctors,
    );
  }

  @override
  bool operator ==(Object other) {
    if (identical(other, this)) return true;
    if (other is! Specialty) return false;
    return mapEquals(other.toJson(), toJson());
  }

  @override
  int get hashCode =>
      id.hashCode ^
      name.hashCode ^
      description.hashCode ^
      mask.hashCode ^
      createdAt.hashCode ^
      updatedAt.hashCode ^
      doctors.hashCode;
}

class Doctor {
  int? id;
  String? firstName;
  String? lastName;
  String? email;
  String? telephoneNumber;
  int? status;
  String? lastLogin;
  dynamic image;
  dynamic imageFilename;
  dynamic token;
  String? mask;
  String? createdAt;
  String? updatedAt;
  dynamic deletedAt;
  List<Day>? days;

  Doctor({
    this.id,
    this.firstName,
    this.lastName,
    this.email,
    this.telephoneNumber,
    this.status,
    this.lastLogin,
    this.image,
    this.imageFilename,
    this.token,
    this.mask,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
    this.days,
  });

  @override
  String toString() {
    return 'Doctor(id: $id, firstName: $firstName, lastName: $lastName, email: $email, telephoneNumber: $telephoneNumber, status: $status, lastLogin: $lastLogin, image: $image, imageFilename: $imageFilename, token: $token, mask: $mask, createdAt: $createdAt, updatedAt: $updatedAt, deletedAt: $deletedAt, days: $days)';
  }

  factory Doctor.fromJson(Map<String, dynamic> json) => Doctor(
        id: json['id'] as int?,
        firstName: json['first_name'] as String?,
        lastName: json['last_name'] as String?,
        email: json['email'] as String?,
        telephoneNumber: json['telephone_number'] as String?,
        status: json['status'] as int?,
        lastLogin: json['last_login'] as String?,
        image: json['image'] as dynamic,
        imageFilename: json['image_filename'] as dynamic,
        token: json['token'] as dynamic,
        mask: json['mask'] as String?,
        createdAt: json['created_at'] as String?,
        updatedAt: json['updated_at'] as String?,
        deletedAt: json['deleted_at'] as dynamic,
        days: (json['days'] as List<dynamic>?)
            ?.map((e) => Day.fromJson(e as Map<String, dynamic>))
            .toList(),
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'first_name': firstName,
        'last_name': lastName,
        'email': email,
        'telephone_number': telephoneNumber,
        'status': status,
        'last_login': lastLogin,
        'image': image,
        'image_filename': imageFilename,
        'token': token,
        'mask': mask,
        'created_at': createdAt,
        'updated_at': updatedAt,
        'deleted_at': deletedAt,
        'days': days?.map((e) => e.toJson()).toList(),
      };

  Doctor copyWith({
    int? id,
    String? firstName,
    String? lastName,
    String? email,
    String? telephoneNumber,
    int? status,
    String? lastLogin,
    dynamic image,
    dynamic imageFilename,
    dynamic token,
    String? mask,
    String? createdAt,
    String? updatedAt,
    dynamic deletedAt,
    List<Day>? days,
  }) {
    return Doctor(
      id: id ?? this.id,
      firstName: firstName ?? this.firstName,
      lastName: lastName ?? this.lastName,
      email: email ?? this.email,
      telephoneNumber: telephoneNumber ?? this.telephoneNumber,
      status: status ?? this.status,
      lastLogin: lastLogin ?? this.lastLogin,
      image: image ?? this.image,
      imageFilename: imageFilename ?? this.imageFilename,
      token: token ?? this.token,
      mask: mask ?? this.mask,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
      deletedAt: deletedAt ?? this.deletedAt,
      days: days ?? this.days,
    );
  }

  @override
  bool operator ==(Object other) {
    if (identical(other, this)) return true;
    if (other is! Doctor) return false;
    return mapEquals(other.toJson(), toJson());
  }

  @override
  int get hashCode =>
      id.hashCode ^
      firstName.hashCode ^
      lastName.hashCode ^
      email.hashCode ^
      telephoneNumber.hashCode ^
      status.hashCode ^
      lastLogin.hashCode ^
      image.hashCode ^
      imageFilename.hashCode ^
      token.hashCode ^
      mask.hashCode ^
      createdAt.hashCode ^
      updatedAt.hashCode ^
      deletedAt.hashCode ^
      days.hashCode;
}

class Day {
  int? id;
  int? doctorId;
  String? day;
  String? time;
  String? value;
  String? mask;
  String? createdAt;
  String? updatedAt;

  Day({
    this.id,
    this.doctorId,
    this.day,
    this.time,
    this.value,
    this.mask,
    this.createdAt,
    this.updatedAt,
  });

  @override
  String toString() {
    return 'Day(id: $id, doctorId: $doctorId, day: $day, time: $time, value: $value, mask: $mask, createdAt: $createdAt, updatedAt: $updatedAt)';
  }

  factory Day.fromJson(Map<String, dynamic> json) => Day(
        id: json['id'] as int?,
        doctorId: json['doctor_id'] as int?,
        day: json['day'] as String?,
        time: json['time'] as String?,
        value: json['value'] as String?,
        mask: json['mask'] as String?,
        createdAt: json['created_at'] as String?,
        updatedAt: json['updated_at'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'doctor_id': doctorId,
        'day': day,
        'time': time,
        'value': value,
        'mask': mask,
        'created_at': createdAt,
        'updated_at': updatedAt,
      };

  Day copyWith({
    int? id,
    int? doctorId,
    String? day,
    String? time,
    String? value,
    String? mask,
    String? createdAt,
    String? updatedAt,
  }) {
    return Day(
      id: id ?? this.id,
      doctorId: doctorId ?? this.doctorId,
      day: day ?? this.day,
      time: time ?? this.time,
      value: value ?? this.value,
      mask: mask ?? this.mask,
      createdAt: createdAt ?? this.createdAt,
      updatedAt: updatedAt ?? this.updatedAt,
    );
  }

  @override
  bool operator ==(Object other) {
    if (identical(other, this)) return true;
    if (other is! Day) return false;
    return mapEquals(other.toJson(), toJson());
  }

  @override
  int get hashCode =>
      id.hashCode ^
      doctorId.hashCode ^
      day.hashCode ^
      time.hashCode ^
      value.hashCode ^
      mask.hashCode ^
      createdAt.hashCode ^
      updatedAt.hashCode;
}
