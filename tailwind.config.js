/** @type {import('tailwindcss').Config} */
    import forms from '@tailwindcss/forms'
export default {
    presets: [require('./vendor/wireui/wireui/tailwind.config.js')],
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./vendor/wireui/wireui/src/*.php",
      "./vendor/wireui/wireui/ts/**/*.ts",
      "./vendor/wireui/wireui/src/View/**/*.php",
      "./vendor/wireui/wireui/src/WireUi/**/*.php",
      "./vendor/wireui/wireui/src/resources/**/*.blade.php",
    ],
    theme: {
      extend: {
        colors: {
            primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
          },
      },
      fontFamily: {
       'body' : ['Inter'],
       'sans' : ['Inter'],
      },
    },
    plugins: [
      forms,
      require('daisyui'),
    ],

    darkmode: 'class',

  }
