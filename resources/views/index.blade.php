<x-page-header/>
<body class="text-gray-700 bg-white" style="font-family: 'Source Sans Pro', sans-serif">
<nav>
      <div class="container mx-auto px-6 py-2 flex justify-between items-center">
        <a class="font-bold text-2xl lg:text-4xl" href="#">
          PiLSi
        </a>
        <div class="block lg:hidden">
          <button class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-800 hover:border-teal-500 appearance-none focus:outline-none">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:block">
          <ul class="inline-flex">
            <li><a class="px-4 font-bold" href="/">Home</a></li>
            <li><a class="px-4 hover:text-gray-800" href="#about">About</a></li>
            <li><a class="px-4 hover:text-gray-800" href="#contact">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section style="background-color: #2a2b38">
      <div class="container mx-auto px-6 text-center py-20">
        <h2 class="mb-6 text-4xl font-bold text-center text-white">
          Coming soon
        </h2>
        <div class="flex justify-center pt-8 sm:pt-0">
            <img src="{{URL::asset('/images/PiLSi-logo.png') }}" alt="PiLSI logo">
        </div>
      </div>
    </section>

    <div class="space-y-4">
  <details
    class="group border-s-4 border-green-500 bg-gray-50 p-6 [&_summary::-webkit-details-marker]:hidden"
    open
  >
    <summary class="flex cursor-pointer items-center justify-between gap-1.5">
      <h2 class="text-lg font-medium text-gray-900">
        What is PiLSi?
      </h2>

      <span class="shrink-0 rounded-full bg-white p-1.5 text-gray-900 sm:p-3">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-45"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd"
          />
        </svg>
      </span>
    </summary>

    <p class="mt-4 leading-relaxed text-gray-700">
    <a id="about"></a>
    A squeeze is a passage or element of a cave that requires careful consideration or planning of body positioning and movement to pass through.
    </p>

    <p class="mt-4 leading-relaxed text-gray-700">
    Utilising the Pilkington-Lewis Squeeze Index (PiLSI) cave constrictions can be rated similarly to the climbing grades used by rock climbers.
    </p>
  </details>

  <details
    class="group border-s-4 border-green-500 bg-gray-50 p-6 [&_summary::-webkit-details-marker]:hidden"
  >
    <summary class="flex cursor-pointer items-center justify-between gap-1.5">
      <h2 class="text-lg font-medium text-gray-900">
        So what's this website about then?
      </h2>

      <span class="shrink-0 rounded-full bg-white p-1.5 text-gray-900 sm:p-3">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-45"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd"
          />
        </svg>
      </span>
    </summary>

    <p class="mt-4 leading-relaxed text-gray-700">
      The aim of this website is to allow you to document you favourite squeezes, and help develop this tool as a useful one for cavers.
    </p>
  </details>

  <details
    class="group border-s-4 border-green-500 bg-gray-50 p-6 [&_summary::-webkit-details-marker]:hidden"
  >
    <summary class="flex cursor-pointer items-center justify-between gap-1.5">
      <h2 class="text-lg font-medium text-gray-900">
        What does PiLSi mean?
      </h2>

      <span class="shrink-0 rounded-full bg-white p-1.5 text-gray-900 sm:p-3">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-45"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd"
          />
        </svg>
      </span>
    </summary>

    <p class="mt-4 leading-relaxed text-gray-700">
    The PiLSI is named after prominent South Australian cavers Graham Pilkington and Ian Lewis.
    </p>
  </details>
</div>

<section style="background-color: #2a2b38">
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16">
      <div class="relative h-64 overflow-hidden rounded-lg sm:h-80 lg:order-last lg:h-full">
        <img
          alt="Squeeze"
          src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
          class="absolute inset-0 h-full w-full object-cover"
        />
        <img src="{{URL::asset('/images/wedding-cake-squeeze.png') }}" alt="Wedding Cake Squeeze.  Photo: Joel Dillon" class="absolute inset-0 h-full w-full object-cover">
      </div>

      <div class="lg:py-24">
        <h2 class="text-3xl font-bold sm:text-4xl text-white">Want to get involved?</h2>

        <p class="mt-4 text-white">
        <a id="contact"></a>
          This site is currently in a closed alpha.  Access is via invite only at his point, but you can always checkout the site on Github and get in touch if you're super keen.
        </p>

        <a
          href="https://github.com/hellboy1975/pilsi"
          class="mt-8 inline-block rounded bg-indigo-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-yellow-400"
        >
          Check out the Github
        </a>
      </div>
    </div>
  </div>
</section>




<footer class="bg-gray-50">
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center sm:justify-between">

      <p class="mt-4 text-center text-sm text-gray-500 lg:mt-0 lg:text-right">
        Copyright &copy; 2024. All rights reserved.
      </p>
    </div>
  </div>
</footer>

</body>
</html>