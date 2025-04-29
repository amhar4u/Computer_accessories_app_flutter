<div>
    @push('styles')
    <style>
        .changing-text {
            animation: none; /* Remove the fade animation */
        }
        .login-gradient-bg  {
            /* background: linear-gradient(135deg, #0d6efd 0%, #ffffff 100%); */
             /* background: linear-gradient(135deg, #0d6efd 0%, #8650dd 50%, #ffffff 100%); */
             /* background: linear-gradient(135deg, #0d6efd 0%, #5434d6 100%); */
            /* Alternative blue combinations you might like: */
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);  // Bootstrap blue to light blue
            /* background: linear-gradient(135deg, #1a237e 0%, #4723D9 100%);  // Dark blue to purple-blue */
            /* background: linear-gradient(135deg, #2196f3 0%, #0d47a1 100%);  // Material blue gradient */
            
           
        }
    </style>
    @endpush
    <div class="container-fluid overflow-auto p-0 vh-100 ">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card rounded-4 shadow h-100">
                <div class="card-body p-0 h-100">
                    <div class="row g-0 h-100">
                        <!-- Desktop Section -->
                        <div class="col-lg-6 d-none d-lg-block h-100 bg-success">
                            <div
                                class="h-100 position-relative overflow-hidden bg-white rounded-start d-flex flex-column align-items-center justify-content-center p-4">
                                <!-- Background Image -->
                                <div class="position-relative mb-4" style="height: 60%;">
                                    <img src="{{ asset('assets/onboard.png') }}" alt="Onboarding Image"
                                        class="h-100 w-100" style="object-fit: contain;">
                                </div>

                                <!-- Content Below Image -->
                                <div class="text-center">
                                    <h1 class="display-5 fw-bold mb-4 text-primary">Welcome to Laptop Zone</h1>
                                    <p class="lead text-primary">Log in to explore the latest in computers, accessories,
                                        and unbeatable tech deals.</p>
                                    <div class="animated-text mt-3">
                                        <span class="text-primary fs-4 fw-bold">Buy </span>
                                        <span class="changing-text text-primary fs-1 fw-bold" id="changingProduct">Mouse</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Section -->
                        <div class="col-12 d-lg-none" style="height: 150px;">
                            <div
                                class="h-100 bg-white d-flex align-items-center justify-content-center p-3 position-relative">
                             
                                <!-- Mobile Content -->
                                <div class="text-center position-relative">
                                    <h2 class="h4 fw-bold mb-2 text-primary">Welcome to Laptop Zone</h2>
                                    {{-- <p class="small mb-0 text-primary">Log in to explore the latest in tech</p>
                                    --}}
                                    <div class="animated-text mt-2">
                                        <span class="text-primary large">Buy </span>
                                        <span class="changing-text text-primary large fw-bold"
                                            style="font-size: 1.5rem;" id="changingProductMobile">Mouse</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Login Form Section -->
                        {{-- <div class="col-lg-6 col-12 bg-primary"> --}}
                        <div class="col-lg-6 col-12 login-gradient-bg">
                            <div class="d-flex align-items-center justify-content-center min-vh-100 p-4">
                                <div class="w-auto">
                                    <div class="card shadow-sm rounded-4 p-4">
                                        <div class="text-center mb-4">

                                            <h2 class="mb-2">Login</h2>
                                        </div>
                                        <form wire:submit.prevent="login">
                                            <!-- Email Input -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email"
                                                    class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                                    id="email" wire:model="email">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Password Input -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password"
                                                    class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                                    id="password" wire:model="password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Remember Me Checkbox -->
                                            <div class="mb-4 form-check">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                    wire:model="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>

                                            <!-- Login Button -->
                                            <button type="submit"
                                                class="btn btn-primary btn-lg w-100 rounded-3 fw-bold">Login</button>

                                            <!-- Forgot Password Link -->
                                            <div class="text-center mt-3">
                                                {{-- <a href="{{ route('password.request') }}"
                                                    class="text-decoration-none">
                                                    Forgot Password?
                                                </a> --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        const products = ['Mouse', 'Keyboard', 'Headphones', 'Monitor', 'Laptop', 'Webcam', 'SSD', 'RAM'];
        let currentIndex = 0;
        let currentLetterIndex = 0;
        let currentWord = '';
        let isTyping = true;
        let isPaused = false;
    
        function typeEffect() {
            const word = products[currentIndex];
            const elements = [
                document.getElementById('changingProduct'),
                document.getElementById('changingProductMobile')
            ].filter(el => el); // Filter out null elements
    
            if (isTyping && !isPaused) {
                if (currentLetterIndex < word.length) {
                    currentWord += word[currentLetterIndex];
                    elements.forEach(el => el.textContent = currentWord);
                    currentLetterIndex++;
                    if (currentLetterIndex === word.length) {
                        isPaused = true;
                        setTimeout(() => {
                            isPaused = false;
                            isTyping = false;
                        }, 1500); // Pause when word is complete
                    }
                }
            } else if (!isPaused) {
                if (currentLetterIndex > 0) {
                    currentLetterIndex--;
                    currentWord = word.substring(0, currentLetterIndex);
                    elements.forEach(el => el.textContent = currentWord);
                } else {
                    currentIndex = (currentIndex + 1) % products.length;
                    currentWord = '';
                    isTyping = true;
                }
            }
        }
    
        // Start the animation
        setInterval(typeEffect, 150); // Adjust speed: lower number = faster typing
    </script>
    @endpush
</div>