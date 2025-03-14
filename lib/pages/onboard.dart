import 'package:flutter/material.dart';
import 'login.dart'; // Import the login page

class OnboardingPagePresenter extends StatefulWidget {
  const OnboardingPagePresenter({Key? key}) : super(key: key);

  @override
  State<OnboardingPagePresenter> createState() => _OnboardingPageState();
}

class _OnboardingPageState extends State<OnboardingPagePresenter> {
  int _currentPage = 0;
  final PageController _pageController = PageController(initialPage: 0);

  final List<OnboardingPageModel> pages = [
    OnboardingPageModel(
      title: 'Wide Range of Accessories',
      description: 'Explore a vast collection of computer accessories at your fingertips.',
      imageUrl: 'https://i.ibb.co/cJqsPSB/scooter.png',
      bgColor: Colors.indigo,
    ),
    OnboardingPageModel(
      title: 'Fast & Secure Shopping',
      description: 'Enjoy a seamless and secure shopping experience with us.',
      imageUrl: 'https://i.ibb.co/LvmZypG/storefront-illustration-2.png',
      bgColor: const Color(0xff1eb090),
    ),
    OnboardingPageModel(
      title: 'Stay Updated on Deals',
      description: 'Get notified about the latest discounts and offers on top accessories.',
      imageUrl: 'https://i.ibb.co/420D7VP/building.png',
      bgColor: const Color(0xfffeae4f),
    ),
    OnboardingPageModel(
      title: 'Easy & Fast Checkout',
      description: 'Experience hassle-free and quick checkout for a smooth purchase process.',
      imageUrl: 'https://i.ibb.co/cJqsPSB/scooter.png',
      bgColor: Colors.purple,
    ),
  ];

  void goToLoginPage() {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (context) => const LoginPage()),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: AnimatedContainer(
        duration: const Duration(milliseconds: 250),
        color: pages[_currentPage].bgColor,
        child: SafeArea(
          child: Column(
            children: [
              Expanded(
                child: PageView.builder(
                  controller: _pageController,
                  itemCount: pages.length,
                  onPageChanged: (idx) {
                    setState(() {
                      _currentPage = idx;
                    });
                  },
                  itemBuilder: (context, idx) {
                    final item = pages[idx];
                    return Column(
                      children: [
                        Expanded(
                          flex: 3,
                          child: Padding(
                            padding: const EdgeInsets.all(32.0),
                            child: Image.network(item.imageUrl),
                          ),
                        ),
                        Expanded(
                          flex: 1,
                          child: Column(
                            children: [
                              Padding(
                                padding: const EdgeInsets.all(16.0),
                                child: Text(
                                  item.title,
                                  style: Theme.of(context)
                                      .textTheme
                                      .titleLarge
                                      ?.copyWith(
                                        fontWeight: FontWeight.bold,
                                        color: Colors.white,
                                      ),
                                ),
                              ),
                              Container(
                                constraints: const BoxConstraints(maxWidth: 280),
                                padding: const EdgeInsets.symmetric(horizontal: 24.0, vertical: 8.0),
                                child: Text(
                                  item.description,
                                  textAlign: TextAlign.center,
                                  style: Theme.of(context)
                                      .textTheme
                                      .bodyMedium
                                      ?.copyWith(
                                        color: Colors.white,
                                      ),
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    );
                  },
                ),
              ),

              // Page indicator
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: pages
                    .map((item) => AnimatedContainer(
                          duration: const Duration(milliseconds: 250),
                          width: _currentPage == pages.indexOf(item) ? 30 : 8,
                          height: 8,
                          margin: const EdgeInsets.all(2.0),
                          decoration: BoxDecoration(
                            color: Colors.white,
                            borderRadius: BorderRadius.circular(10.0),
                          ),
                        ))
                    .toList(),
              ),

              // Bottom buttons
              SizedBox(
                height: 100,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    // Skip Button Logic
                    TextButton(
                      style: TextButton.styleFrom(
                        foregroundColor: Colors.white,
                        textStyle: const TextStyle(
                            fontSize: 16, fontWeight: FontWeight.bold),
                      ),
                      onPressed: () {
                        if (_currentPage == pages.length - 1) {
                          goToLoginPage();
                        } else {
                          _pageController.animateToPage(
                            _currentPage + 1,
                            curve: Curves.easeInOutCubic,
                            duration: const Duration(milliseconds: 250),
                          );
                        }
                      },
                      child: const Text("Skip"),
                    ),

                    // Next / Finish Button Logic
                    TextButton(
                      style: TextButton.styleFrom(
                        foregroundColor: Colors.white,
                        textStyle: const TextStyle(
                            fontSize: 16, fontWeight: FontWeight.bold),
                      ),
                      onPressed: () {
                        if (_currentPage == pages.length - 1) {
                          goToLoginPage();
                        } else {
                          _pageController.animateToPage(
                            _currentPage + 1,
                            curve: Curves.easeInOutCubic,
                            duration: const Duration(milliseconds: 250),
                          );
                        }
                      },
                      child: Row(
                        children: [
                          Text(
                            _currentPage == pages.length - 1 ? "Finish" : "Next",
                          ),
                          const SizedBox(width: 8),
                          Icon(
                            _currentPage == pages.length - 1
                                ? Icons.done
                                : Icons.arrow_forward,
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class OnboardingPageModel {
  final String title;
  final String description;
  final String imageUrl;
  final Color bgColor;

  OnboardingPageModel({
    required this.title,
    required this.description,
    required this.imageUrl,
    this.bgColor = Colors.blue,
  });
}
