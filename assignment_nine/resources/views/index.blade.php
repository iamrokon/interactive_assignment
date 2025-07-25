@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <main
        class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

    <!--      <div class="text-center p-12 border border-gray-800 rounded-xl">-->
    <!--        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>-->
    <!--      </div>-->
        @if(isset(auth()->user()->id))
        <!-- Barta Create Post Card -->
        <form
            method="POST"
            action="{{ route('posts.store') }}"
            enctype="multipart/form-data"
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
            @csrf
            <!-- Create Post Card Top -->
            <div>
            <div class="flex items-start /space-x-3/">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                  <img
                    class="h-10 w-10 rounded-full object-cover"
                    src="{{ auth()->user() ? asset(auth()->user()->image_url) : null }}"
                    alt="Ahmed Shamim" />
                </div>
                <!-- /User Avatar -->

                <!-- Content -->
                <div class="text-gray-700 font-normal w-full">
                <textarea
                    class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                    name="content"
                    rows="2"
                    placeholder="What's going on, Shamim?"></textarea>
                </div>
            </div>
            </div>

            <!-- Create Post Card Bottom -->
            <div>
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-end">
                <div class="flex gap-4 text-gray-600">
                    <div>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="hidden" />
                    <label
                        for="image"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                        <span class="sr-only">Picture</span>
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </label>
                    </div>

                    <button
                    type="button"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                    <span class="sr-only">GIF</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12.75 8.25v7.5m6-7.5h-3V12m0 0v3.75m0-3.75H18M9.75 9.348c-1.03-1.464-2.698-1.464-3.728 0-1.03 1.465-1.03 3.84 0 5.304 1.03 1.464 2.699 1.464 3.728 0V12h-1.5M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    </button>

                    <button
                    type="button"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                    <span class="sr-only">Emoji</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                    </svg>
                    </button>
                </div>
                </div>
                <!-- Post Button -->
                <button
                    type="submit"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                    Post
                </button>
                <!-- /Post Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
        <!-- /Barta Create Post Card -->
        @endif

        <!-- Newsfeed -->
        <section
            id="newsfeed"
            class="space-y-6">
            @foreach ($posts as $post)
            <!-- Barta Card -->
            <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img-->
    <!--                    class="h-10 w-10 rounded-full object-cover"-->
    <!--                    src="https://avatars.githubusercontent.com/u/61485238"-->
    <!--                    alt="Al Nahian" />-->
    <!--                </div>-->
                    <!-- /User Avatar -->

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a
                        href="profile.html"
                        class="hover:underline font-semibold line-clamp-1">
                        {{ $post->first_name }} {{ $post->last_name }}
                    </a>

                    <a
                        href="profile.html"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{ $post->user->email }}
                    </a>
                    </div>
                    <!-- /User Info -->
                </div>
                @if(isset(auth()->user()->id) && (auth()->user()->id==$post->user_id))

                <!-- Card Action Dropdown -->
                <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                    <div class="relative inline-block text-left">
                    <div>
                        <button
                        @click="open = !open"
                        type="button"
                        class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                        id="menu-0-button">
                        <span class="sr-only">Open options</span>
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true">
                            <path
                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                        </svg>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1">
                        <a
                            href="{{ route('posts.edit', $post->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            role="menuitem"
                            tabindex="-1"
                            id="user-menu-item-0"
                        >Edit</a
                        >
                        <form
                            action="{{ route('posts.destroy', $post->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-1"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                    </div>

                </div>
                <!-- /Card Action Dropdown -->

                @endif
                </div>
            </header>

            <!-- Content -->
            <a href="{{ route('posts-single', $post->id) }}">
                <div class="py-4 text-gray-700 font-normal">
                    <p>{{ $post->content }}</p>
                    {{-- <p>
                    🎉🥳 Turning 20 today! 🎂
                    <br />
                    One of the best things in my life has been my love affair with
                    <a
                        href="#laravel"
                        class="text-black font-semibold hover:underline"
                        >#Laravel</a
                    >
                    <br />
                    <br />
                    Keep me in your prayers 😌
                    </p> --}}
                </div>
            </a>

            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">{{ $post->created_at }}</span>
                <span class="">•</span>
                <span>450 views</span>
            </div>

            <!-- Barta Card Bottom -->
    <!--          <footer class="border-t border-gray-200 pt-2">-->
    <!--            &lt;!&ndash; Card Bottom Action Buttons &ndash;&gt;-->
    <!--            <div class="flex items-center justify-between">-->
    <!--              <div class="flex gap-8 text-gray-600">-->
    <!--                &lt;!&ndash; Heart Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Like</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="2"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />-->
    <!--                  </svg>-->

    <!--                  <p>36</p>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Heart Button &ndash;&gt;-->

    <!--                &lt;!&ndash; Comment Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Comment</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="2"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />-->
    <!--                  </svg>-->

    <!--                  <p>17</p>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Comment Button &ndash;&gt;-->
    <!--              </div>-->

    <!--              <div>-->
    <!--                &lt;!&ndash; Share Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Share</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="1.5"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />-->
    <!--                  </svg>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Share Button &ndash;&gt;-->
    <!--              </div>-->
    <!--            </div>-->
    <!--            &lt;!&ndash; /Card Bottom Action Buttons &ndash;&gt;-->
    <!--          </footer>-->
            <!-- /Barta Card Bottom -->
            </article>
            <!-- /Barta Card -->

            @endforeach

            <!-- Barta Card With Image -->
    <!--        <article-->
    <!--          class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">-->
    <!--          &lt;!&ndash; Barta Card Top &ndash;&gt;-->
    <!--          <header>-->
    <!--            <div class="flex items-center justify-between">-->
    <!--              <div class="flex items-center space-x-3">-->
    <!--                &lt;!&ndash; User Avatar &ndash;&gt;-->
    <!--                <div class="flex-shrink-0">-->
    <!--                  <img-->
    <!--                    class="h-10 w-10 rounded-full object-cover"-->
    <!--                    src="https://avatars.githubusercontent.com/u/61485238"-->
    <!--                    alt="Al Nahian" />-->
    <!--                </div>-->
    <!--                &lt;!&ndash; /User Avatar &ndash;&gt;-->

    <!--                &lt;!&ndash; User Info &ndash;&gt;-->
    <!--                <div class="text-gray-900 flex flex-col min-w-0 flex-1">-->
    <!--                  <a-->
    <!--                    href="https://github.com/alnahian2003"-->
    <!--                    class="hover:underline font-semibold line-clamp-1">-->
    <!--                    Al Nahian-->
    <!--                  </a>-->

    <!--                  <a-->
    <!--                    href="https://twitter.com/alnahian2003"-->
    <!--                    class="hover:underline text-sm text-gray-500 line-clamp-1">-->
    <!--                    @alnahian2003-->
    <!--                  </a>-->
    <!--                </div>-->
    <!--                &lt;!&ndash; /User Info &ndash;&gt;-->
    <!--              </div>-->

    <!--              &lt;!&ndash; Card Action Dropdown &ndash;&gt;-->
    <!--              <div class="flex flex-shrink-0 self-center">-->
    <!--                <div class="relative inline-block text-left">-->
    <!--                  <div>-->
    <!--                    <button-->
    <!--                      type="button"-->
    <!--                      class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"-->
    <!--                      id="menu-0-button">-->
    <!--                      <span class="sr-only">Open options</span>-->
    <!--                      <svg-->
    <!--                        class="h-5 w-5"-->
    <!--                        viewBox="0 0 20 20"-->
    <!--                        fill="currentColor"-->
    <!--                        aria-hidden="true">-->
    <!--                        <path-->
    <!--                          d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>-->
    <!--                      </svg>-->
    <!--                    </button>-->
    <!--                  </div>-->
    <!--                </div>-->
    <!--              </div>-->
    <!--              &lt;!&ndash; /Card Action Dropdown &ndash;&gt;-->
    <!--            </div>-->
    <!--          </header>-->

    <!--          &lt;!&ndash; Content &ndash;&gt;-->
    <!--          <div class="py-4 text-gray-700 font-normal space-y-2">-->
    <!--            <img-->
    <!--              src="https://images.pexels.com/photos/6261178/pexels-photo-6261178.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"-->
    <!--              class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72"-->
    <!--              alt="" />-->
    <!--            <p>Beautiful 😍😘 Innit?</p>-->
    <!--          </div>-->

    <!--          &lt;!&ndash; Date Created & View Stat &ndash;&gt;-->
    <!--          <div class="flex items-center gap-2 text-gray-500 text-xs my-2">-->
    <!--            <span class="">2 days ago</span>-->
    <!--            <span class="">•</span>-->
    <!--            <span>1,189 views</span>-->
    <!--          </div>-->

    <!--          &lt;!&ndash; Barta Card Bottom &ndash;&gt;-->
    <!--          <footer class="border-t border-gray-200 pt-2">-->
    <!--            &lt;!&ndash; Card Bottom Action Buttons &ndash;&gt;-->
    <!--            <div class="flex items-center justify-between">-->
    <!--              <div class="flex gap-8 text-gray-600">-->
    <!--                &lt;!&ndash; Heart Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Like</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="2"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />-->
    <!--                  </svg>-->

    <!--                  <p>24</p>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Heart Button &ndash;&gt;-->

    <!--                &lt;!&ndash; Comment Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Comment</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="2"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />-->
    <!--                  </svg>-->

    <!--                  <p>8</p>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Comment Button &ndash;&gt;-->
    <!--              </div>-->

    <!--              <div>-->
    <!--                &lt;!&ndash; Share Button &ndash;&gt;-->
    <!--                <button-->
    <!--                  type="button"-->
    <!--                  class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">-->
    <!--                  <span class="sr-only">Share</span>-->
    <!--                  <svg-->
    <!--                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                    fill="none"-->
    <!--                    viewBox="0 0 24 24"-->
    <!--                    stroke-width="1.5"-->
    <!--                    stroke="currentColor"-->
    <!--                    class="w-5 h-5">-->
    <!--                    <path-->
    <!--                      stroke-linecap="round"-->
    <!--                      stroke-linejoin="round"-->
    <!--                      d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />-->
    <!--                  </svg>-->
    <!--                </button>-->
    <!--                &lt;!&ndash; /Share Button &ndash;&gt;-->
    <!--              </div>-->
    <!--            </div>-->
    <!--            &lt;!&ndash; /Card Bottom Action Buttons &ndash;&gt;-->
    <!--          </footer>-->
    <!--          &lt;!&ndash; /Barta Card Bottom &ndash;&gt;-->
    <!--        </article>-->
        <!-- /Barta Card With Image -->
      </section>
      <!-- /Newsfeed -->
    </main>
@endsection
