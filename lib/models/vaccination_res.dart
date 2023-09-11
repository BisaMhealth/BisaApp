class VaccinationRes {
  int? code;
  String? status;
  String? message;
  List<Data>? data;

  VaccinationRes({this.code, this.status, this.message, this.data});

  VaccinationRes.fromJson(Map<String, dynamic> json) {
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
  List<Districtlist>? districtlist;
  List<Cities>? cities;

  Data(
      {this.id,
      this.name,
      this.mask,
      this.code,
      this.status,
      this.createdAt,
      this.updatedAt,
      this.districtlist,
      this.cities});

  Data.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    name = json['name'];
    mask = json['mask'];
    code = json['code'];
    status = json['status'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
    if (json['districtlist'] != null) {
      districtlist = <Districtlist>[];
      json['districtlist'].forEach((v) {
        districtlist!.add(Districtlist.fromJson(v));
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
    if (districtlist != null) {
      data['districtlist'] = districtlist!.map((v) => v.toJson()).toList();
    }
    if (cities != null) {
      data['cities'] = cities!.map((v) => v.toJson()).toList();
    }
    return data;
  }
}

class Districtlist {
  int? id;
  int? regionId;
  String? name;
  String? mask;
  String? createdAt;
  String? updatedAt;
  int? count;
  List<Centerlist>? centerlist;

  Districtlist(
      {this.id,
      this.regionId,
      this.name,
      this.mask,
      this.createdAt,
      this.updatedAt,
      this.count,
      this.centerlist});

  Districtlist.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    regionId = json['region_id'];
    name = json['name'];
    mask = json['mask'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
    count = json['count'];
    if (json['centerlist'] != null) {
      centerlist = <Centerlist>[];
      json['centerlist'].forEach((v) {
        centerlist!.add(Centerlist.fromJson(v));
      });
    }
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['id'] = id;
    data['region_id'] = regionId;
    data['name'] = name;
    data['mask'] = mask;
    data['created_at'] = createdAt;
    data['updated_at'] = updatedAt;
    data['count'] = count;
    if (centerlist != null) {
      data['centerlist'] = centerlist!.map((v) => v.toJson()).toList();
    }
    return data;
  }
}

class Centerlist {
  int? id;
  int? districtId;
  String? name;
  String? mask;
  String? createdAt;
  String? updatedAt;

  Centerlist(
      {this.id,
      this.districtId,
      this.name,
      this.mask,
      this.createdAt,
      this.updatedAt});

  Centerlist.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    districtId = json['district_id'];
    name = json['name'];
    mask = json['mask'];
    createdAt = json['created_at'];
    updatedAt = json['updated_at'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = {};
    data['id'] = id;
    data['district_id'] = districtId;
    data['name'] = name;
    data['mask'] = mask;
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