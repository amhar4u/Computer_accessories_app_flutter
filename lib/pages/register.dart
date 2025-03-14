import 'package:flutter/material.dart';
import 'login.dart';

class RegisterPage extends StatefulWidget {
  const RegisterPage({Key? key}) : super(key: key);

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  bool _isPasswordVisible = false;
  bool _isConfirmPasswordVisible = false;
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  final TextEditingController _passwordController = TextEditingController();
  final TextEditingController _confirmPasswordController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          // ✅ Background Design
          Container(
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color(0xFF2196F3), Color(0xFF0D47A1)], // Smooth gradient background
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,
              ),
            ),
          ),
          Center(
            child: SingleChildScrollView(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  // ✅ App Logo
                  ClipOval(
                    child: Image.asset(
                      'assets/logo.png',
                      width: 140,
                      height: 140,
                      fit: BoxFit.cover,
                    ),
                  ),
                  const SizedBox(height: 20), // ✅ Spacing

                  // ✅ Title
                  const Text(
                    "Create Account",
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Colors.white, // ✅ Improved readability
                    ),
                  ),
                  const SizedBox(height: 30), // ✅ Space before the form

                  Container(
                    constraints: const BoxConstraints(maxWidth: 320),
                    padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.9), // Slightly transparent white box
                      borderRadius: BorderRadius.circular(12), // Rounded edges
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black26,
                          blurRadius: 10,
                          spreadRadius: 2,
                        ),
                      ],
                    ),
                    child: Form(
                      key: _formKey,
                      child: Column(
                        children: [
                          _buildTextField("Full Name", Icons.person_outline, false),
                          _gap(),
                          _buildTextField("Contact Number", Icons.phone_outlined, false, isPhone: true),
                          _gap(),
                          _buildTextField("Email", Icons.email_outlined, false, isEmail: true),
                          _gap(),
                          _buildPasswordField("Password", _passwordController, true),
                          _gap(),
                          _buildPasswordField("Confirm Password", _confirmPasswordController, false),
                          _gap(),

                          // ✅ Sign Up Button with Rounded & Gradient Style
                          SizedBox(
                            width: double.infinity,
                            child: ElevatedButton(
                              style: ElevatedButton.styleFrom(
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(8), // ✅ Softer edges
                                ),
                                padding: const EdgeInsets.all(12),
                                backgroundColor: Colors.blue, // ✅ Modern blue button
                              ),
                              child: const Text(
                                'Sign Up',
                                style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold, color: Colors.white),
                              ),
                              onPressed: () {
                                if (_formKey.currentState?.validate() ?? false) {
                                  // Handle registration logic
                                }
                              },
                            ),
                          ),
                          _gap(),

                          // ✅ "Already have an account? Log In" Link
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              const Text("Already have an account? "),
                              GestureDetector(
                                onTap: () {
                                  Navigator.push(context, MaterialPageRoute(builder: (context) => const LoginPage()));
                                },
                                child: const Text(
                                  "Sign In",
                                  style: TextStyle(color: Colors.blue, fontWeight: FontWeight.bold),
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _gap() => const SizedBox(height: 16);

  // ✅ Function to Build Text Fields
  Widget _buildTextField(String label, IconData icon, bool isPassword, {bool isEmail = false, bool isPhone = false}) {
    return TextFormField(
      keyboardType: isPhone ? TextInputType.phone : (isEmail ? TextInputType.emailAddress : TextInputType.text),
      validator: (value) {
        if (value == null || value.isEmpty) {
          return 'Please enter $label';
        }
        if (isEmail) {
          bool emailValid = RegExp(r"^[a-zA-Z0-9.a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[a-zA-Z0-9]+\.[a-zA-Z]+").hasMatch(value);
          if (!emailValid) return 'Enter a valid email';
        }
        if (isPhone && value.length < 10) return 'Enter a valid phone number';
        return null;
      },
      obscureText: isPassword,
      decoration: InputDecoration(
        labelText: label,
        prefixIcon: Icon(icon),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
      ),
    );
  }

  // ✅ Function to Build Password Fields
  Widget _buildPasswordField(String label, TextEditingController controller, bool isPassword) {
    return TextFormField(
      controller: controller,
      validator: (value) {
        if (value == null || value.isEmpty) return 'Please enter $label';
        if (isPassword && value.length < 6) return 'Password must be at least 6 characters';
        if (!isPassword && value != _passwordController.text) return 'Passwords do not match';
        return null;
      },
      obscureText: isPassword ? !_isPasswordVisible : !_isConfirmPasswordVisible,
      decoration: InputDecoration(
        labelText: label,
        prefixIcon: const Icon(Icons.lock_outline_rounded),
        border: OutlineInputBorder(borderRadius: BorderRadius.circular(8)),
        suffixIcon: IconButton(
          icon: Icon(isPassword ? (_isPasswordVisible ? Icons.visibility_off : Icons.visibility) 
                                : (_isConfirmPasswordVisible ? Icons.visibility_off : Icons.visibility)),
          onPressed: () {
            setState(() {
              if (isPassword) {
                _isPasswordVisible = !_isPasswordVisible;
              } else {
                _isConfirmPasswordVisible = !_isConfirmPasswordVisible;
              }
            });
          },
        ),
      ),
    );
  }
}
