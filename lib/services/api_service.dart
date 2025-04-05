import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000/api';

  Future<Map<String, dynamic>?> registerUser(String name, String email, String contact, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/register'),
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
