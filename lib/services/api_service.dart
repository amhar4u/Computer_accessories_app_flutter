import 'dart:convert';
import 'package:http/http.dart' as http;
import '../config/config.dart'; // Import the config file

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000/api';

  Future<Map<String, dynamic>?> registerUser(String name, String email, String contact, String password) async {
    final response = await http.post(
      Uri.parse('${Config.baseUrl}/register'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({
        'name': name,
        'email': email,
        'contact': contact,
        'password': password,
        'password_confirmation': password,
      }),
    );

    if (response.statusCode == 201) {
      return json.decode(response.body); // Successful registration
    } else if (response.statusCode == 400) {
      return json.decode(response.body); // Validation errors
    } else {
      return null; // Other errors
    }
  }

}
