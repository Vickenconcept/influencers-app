 @seo([
     'title' => 'Trust Convert Io',
     'description' => 'Review Manager app',
     'image' => asset('images/trustconvert.png'),
     'site_name' => config('app.name'),
     'favicon' => asset('images/trustconvert.png'),
 ])
 <x-guest-layout>
     <div
         class="min-w-screen min-h-screen bg-gradient-to-b from-[#D0E8FF] to-[#bcbafb]  flex items-center justify-center px-5 py-5">
         <div class=" text-gray-500  w-full " style="max-width:1000px">
             <div class="md:flex w-full ">

                
                 <div class="w-full md:w-1/2">
                     <form action="{{ route('auth.login') }}" method="post"
                         class="w-full py-10 px-5 md:px-10  rounded-2xl bg-slate-200 bg-opacity-50">

                         @csrf

                         <div class="text-center mb-10  ">
                             <div class="flex items-center justify-center mb-5 space-x-1">
                                 <img src="{{ asset('images/logo.png') }}" alt="">
                                 <h1 class="font-bold text-xl text-gray-900">TrustConvertio</h1>
                             </div>
                             <h1 class="font-bold text-2xl text-gray-900">Sign in to your Account</h1>
                             <p>Please enter your details</p>
                         </div>
                         @if ($errors->any())
                             <div class="alert alert-danger">
                                 <ul class="text-red-400 bg-red-200 p-2 rounded-md">
                                     @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                     @endforeach
                                 </ul>
                             </div>
                         @endif

                         <x-session-msg />


                         <div>
                             <div class="flex -mx-3">
                                 <div class="w-full px-3 mb-5">
                                     <label for="" class="text-xs font-semibold px-1">Email</label>
                                     <div class="flex">
                                         <div
                                             class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center">
                                             <i class="mdi mdi-email-outline text-gray-400 text-lg"></i>
                                         </div>
                                         <input type="email"
                                             class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-[#5c6dd8]"
                                             placeholder="johnsmith@example.com" name="email" value="{{ old('email') }}">
                                     </div>
                                 </div>
                             </div>


                             <div class="flex -mx-3">
                                 <div class="w-full px-3 mb-5">
                                     <label for="" class="px-1 text-xs font-semibold">Password</label>
                                     <div class="">
                                         <div
                                             class="z-10 flex items-center justify-center w-10 pl-1 text-center pointer-events-none">
                                             <i class="text-lg text-gray-400 mdi mdi-lock-outline"></i>
                                         </div>
                                         <div class="relative">
                                             <input type="password"
                                                 class="block w-full py-2 pl-5 pr-10 text-sm text-gray-900 border-2  rounded-lg border-gray-200  outline-none focus:border-[#5c6dd8] "
                                                 placeholder="Enter password" name="password" id="password" />


                                             <button type="button" onclick="showPassword()"
                                                 class="text-gray-500 hover:text-gray-700 absolute end-2.5 bottom-1  font-medium rounded-lg text-sm  py-.5">
                                                 <i class="bx bx-show-alt text-2xl" id="show"></i>
                                                 <i class="bx bx-hide text-2xl" id="hide"
                                                     style="display: none"></i>
                                             </button>
                                         </div>
                                     </div>
                                 </div>

                             </div>

                             <div class="flex -mx-3">
                                 <div class="w-full px-3 mb-5">
                                     <button
                                         class="block w-full  mx-auto bg-[#5c6dd8] hover:bg-blue-700 focus:bg-blue-700 text-white rounded-lg px-3 py-3 font-semibold">
                                         <span id="hiddenText" class="hidden"> <i
                                                 class='bx bx-loader-alt animate-spin'></i></span>
                                         <span>LOGIN</span>
                                     </button>
                                 </div>
                             </div>
                             <div class="text-right hover:text-[#5c6dd8] font-semibold underline text-sm">
                                 <a href="{{ route('password.request') }}">Forgot Password</a>
                             </div>
                         </div>
                     </form>
                 </div>

                 <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/login-banner.png') }}" alt="">
                </div>
             </div>
         </div>
     </div>

     <script>
         function showPassword() {
             var passwordField = document.getElementById('password');
             var show = document.getElementById('show');
             var hide = document.getElementById('hide');
             if (passwordField.type === 'password') {
                 passwordField.type = 'text';
                 show.style.display = 'none'
                 hide.style.display = 'block'
             } else {
                 passwordField.type = 'password';
                 show.style.display = 'block'
                 hide.style.display = 'none'
             }
         }
     </script>
 </x-guest-layout>
