  <!--👇 NAVBAR COMPONENT 👇-->
  <nav x-data aria-label="Site Navbar">
      <div class="bg-white border-b">
          <div class="mx-auto max-w-screen-xl p-4">
              <div class="flex items-center justify-between gap-x-8">
                  <a href="{{route('welcome')}}" class="flex cursor-pointer items-center gap-x-1">
                      <img width="300"  class="object-cover" src="{{ \Storage::url($setting->logo) }}"
                          alt="logo" />
                      {{-- <span class="text-lg font-black text-purple-800">CODES</span> --}}
                  </a>
                  <ul class="flex items-center gap-x-6">
                      <li class="hidden md:block">
                          <a href="{{ route('welcome') }}"
                              class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800">Home</a>
                      </li>
                      <li class="hidden md:block">
                          <a href="{{ route('products') }}"
                              class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800">Products</a>
                      </li>
                      <li class="hidden md:block">
                          <a href="{{ route('services') }}"
                              class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800">Service</a>
                      </li>
                      <li class="hidden md:block">
                          <a href="{{ route('projects') }}"
                              class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800">Projects</a>
                      </li>
                      <!-- <li class="hidden md:block">
              <a
                class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800"
                >Blog</a
              >
            </li> -->
                      <li class="hidden md:block">
                          <a href="{{ route('contact.us') }}"
                              class="cursor-pointer text-sm text-[#244fa8] hover:text-blue-800 border-t-4 transition-all duration-300 border-white outline-blue-800 py-5 hover:border-blue-800">Contacts</a>
                      </li>
                  </ul>
                  <ul class="flex items-center gap-x-6">
                      <li class="flex items-center gap-x-4">
                          <button>
                              <a class="flex items-center gap-x-2 cursor-pointer font-medium text-orange-400">
                                  <div class="bg-orange-500 p-2 rounded-full text-gray-50 shadow">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                          class="w-4 h-4">
                                          <path fill-rule="evenodd"
                                              d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                              clip-rule="evenodd" />
                                      </svg>
                                  </div>
                                  <span>{{ $setting->phone_no ?? '' }}</span>

                              </a>
                          </button>
                          <button>
                              <a class="flex items-center gap-x-2 cursor-pointer font-medium text-orange-400">
                                  <div class="bg-orange-500 p-2 rounded-full text-gray-50 shadow">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                          class="w-4 h-4">
                                          <path
                                              d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                          <path
                                              d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                      </svg>
                                  </div>
                                  <span>{{ $setting->email ?? '' }}</span>

                              </a>
                          </button>
                          <button
                              @click="
                $refs.dropdown.classList.toggle('h-[180px]')
                $refs.menu.classList.toggle('hidden')
                $refs.close.classList.toggle('hidden')
                "
                              class="block cursor-pointer p-2 text-sm font-medium text-orange-500 hover:text-orange-500 md:hidden">
                              <svg x-ref="menu" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                              </svg>
                              <svg x-ref="close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="hidden h-6 w-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                              </svg>
                          </button>
                      </li>
                  </ul>
              </div>
          </div>
          <div x-ref="dropdown" class="duration-900 h-0 overflow-y-hidden transition-all md:hidden">
              <hr />
              <ul class="mx-auto max-w-screen-xl px-4 py-4">
                  <li>
                      <a href="{{route('welcome')}}"
                          class="block cursor-pointer rounded-full p-2 text-center text-sm font-medium text-[#244fa8] hover:bg-blue-500 ">HOME</a>
                  </li>
                  <li>
                      <a href="{{route('products')}}"
                          class="block cursor-pointer rounded-full p-2 text-center text-sm font-medium text-[#244fa8] hover:bg-blue-500 ">PRODUCTS</a>
                  </li>
                  <li>
                      <a href="{{route('services')}}"
                          class="block cursor-pointer rounded-full p-2 text-center text-sm font-medium text-[#244fa8] hover:bg-blue-500 ">SERVICE</a>
                  </li>
                  <li>
                      <a href="{{route('contact.us')}}"
                          class="block cursor-pointer rounded-full p-2 text-center text-sm font-medium text-[#244fa8] hover:bg-blue-500 ">CONTACTS</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  <!-- ******************* -->
