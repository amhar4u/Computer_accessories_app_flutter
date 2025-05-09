import 'package:flutter/material.dart';
import 'pages/onboard.dart'; // Import the Onboarding screen

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: const OnboardingPagePresenter(), // Navigate to Onboarding
    );
  }
}
