class TestingRes {
  int? code;
  String? status;
  String? message;
  List<Data>? data;

  TestingRes({this.code, this.status, this.message, this.data});

  TestingRes.fromJson(Map<String, dynamic> json) {
    code = json['code'];
    status = json['status'];
    message = json['message'];
    if (json['data'] != null) {
      data = <Data>[];
      json['data'].forEach((v) {
        data!.add(Data.fromJson(v));
      });
    }
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['code'] = code;
    data['status'] = status;
    data['message'] = message;
    if (this.data != null) {
      data['data'] = this.data!.map((v) => v.toJson()).toList();
    }
    return data;
  }
}

class Data {
  int? id;
  String? name;
  String? mask;
  String? code;
  int? status;
  String? createdAt;
  String? updatedAt;
  List<Testingcenters>? testingcenters;
  List<Cities>? cities;

  Data(
      {this.id,
      this.name,
      this.mask,
      this.code,
      this.status,
      this.createdAt,
      this.updatedAt,
      this.testingcenters,
      this.cities});

  Data.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    mask = json['mask'];
    code = json['code'];
    status = json['status'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
    if (json['testingcenters'] != null) {
      testingcenters = <Testingcenters>[];
      json['testingcenters'].forEach((v) {
        testingcenters!.add(Testingcenters.fromJson(v));
      });
    }
    if (json['cities'] != null) {
      cities = <Cities>[];
      json['cities'].forEach((v) {
        cities!.add(Cities.fromJson(v));
      });
    }
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['id'] = id;
    data['name'] = name;
    data['mask'] = mask;
    data['code'] = code;
    data['status'] = status;
    data['created_at'] = createdAt;
    data['updated_at'] = updatedAt;
    if (testingcenters != null) {
      data['testingcenters'] =
          testingcenters!.map((v) => v.toJson()).toList();
    }
    if (cities != null) {
      data['cities'] = cities!.map((v) => v.toJson()).toList();
    }
    return data;
  }
}

class Testingcenters {
  int? id;
  int? regionId;
  String? name;
  String? location;
  String? duration;
  String? workingHours;
  String? contact;
  int? standardPrice;
  int? premiumPrice;
  String? mask;
  dynamic status;
  String? createdAt;
  String? updatedAt;

  Testingcenters(
      {this.id,
      this.regionId,
      this.name,
      this.location,
      this.duration,
      this.workingHours,
      this.contact,
      this.standardPrice,
      this.premiumPrice,
      this.mask,
      this.status,
      this.createdAt,
      this.updatedAt});

  Testingcenters.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    regionId = json['region_id'];
    name = json['name'];
    location = json['location'];
    duration = json['duration'];
    workingHours = json['working_hours'];
    contact = json['contact'];
    standardPrice = json['standard_price'];
    premiumPrice = json['premium_price'];
    mask = json['mask'];
    status = json['status'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['id'] = id;
    data['region_id'] = regionId;
    data['name'] = name;
    data['location'] = location;
    data['duration'] = duration;
    data['working_hours'] = workingHours;
    data['contact'] = contact;
    data['standard_price'] = standardPrice;
    data['premium_price'] = premiumPrice;
    data['mask'] = mask;
    data['status'] = status;
    data['created_at'] = createdAt;
    data['updated_at'] = updatedAt;
    return data;
  }
}

class Cities {
  int? id;
  String? name;
  String? region;
  int? status;
  String? createdAt;
  String? updatedAt;

  Cities(
      {this.id,
      this.name,
      this.region,
      this.status,
      this.createdAt,
      this.updatedAt});

  Cities.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    region = json['region'];
    status = json['status'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['id'] = id;
    data['name'] = name;
    data['region'] = region;
    data['status'] = status;
    data['created_at'] = createdAt;
    data['updated_at'] = updatedAt;
    return data;
  }
}