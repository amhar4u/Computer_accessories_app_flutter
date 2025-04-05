import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../../services/login_service.dart';
import '../login.dart';

class HomePage extends StatelessWidget {
  final LoginService _loginService = LoginService();

  Future<void> _logout(BuildContext context) async {
    await _loginService.logout();  // Log out by clearing the token
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (context) => LoginPage()),  // Remove the 'const' here
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Home Page'),
        actions: [
          IconButton(
            icon: const Icon(Icons.logout),
            onPressed: () => _logout(context),  // Call logout when the user presses the logout button
          ),
        ],
      ),
      body: Center(
        child: ElevatedButton(
          onPressed: () => _logout(context),  // Another logout button example
          child: const Text('Log Out'),
        ),
      ),
    );
  }
}
