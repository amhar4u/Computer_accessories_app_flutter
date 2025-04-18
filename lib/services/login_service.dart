import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import '../config/config.dart'; // Import the config file

class LoginService {
  static const String baseUrl = 'http://127.0.0.1:8000/api';

  Future<Map<String, dynamic>?> login(String email, String password) async {
    try {
        final response = await http.post(
            Uri.parse('${Config.baseUrl}/login'),
            headers: {'Content-Type': 'application/json'},
            body: jsonEncode({'email': email.trim(), 'password': password}),
        );

        if (response.statusCode == 200) {
            return json.decode(response.body);
        } else if (response.statusCode == 401) {
            return {'error': 'Invalid credentials'};
        } else if (response.statusCode == 404) {
            return {'error': 'User not found'};
        } else {
            return {'error': 'Login failed. Please try again.'};
        }
    } catch (e) {
        return {'error': 'Error connecting to server'};
    }
  }

  Future<bool> isLoggedIn() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.containsKey('token');
  }

  // Add a logout method to clear the stored token
  Future<void> logout() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.remove('token');  // Remove token to log out the user
  }
}
