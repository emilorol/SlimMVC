const mix = require("laravel-mix");

mix.js("backend/Resources/scripts/main.js", "public/assets/js/main.min.js")
  .sass("backend/Resources/styles/main.sass", "public/assets/css/main.min.css");


// Removes unused CSS
// According to Discord chat: Running Purge CSS as part of Post CSS is a ton faster than laravel-mix-purgecss
// But if that doesn't work use https://github.com/spatie/laravel-mix-purgecss
const purgecss = require("@fullhuman/postcss-purgecss")({
  // Specify the paths to all of the template files in your project
  content: [
    "backend/Views/pages/*.twig",
    "backend/Views/templates/*.twig"
  ],

  whitelistPatterns: [/show/],
  variables: true,

  // Include any special characters you're using in this regular expression
  defaultExtractor: (content) => content.match(/[A-Za-z0-9-_:/]+/g) || []
});

mix.options({
    extractVueStyles: false,
    processCssUrls: true,
    terser: {},
    purifyCss: false,
    //purifyCss: {},
    postCss: [require("autoprefixer"), purgecss],
    clearConsole: false,
    cssNano: {
      discardComments: {removeAll: true},
    }
  });
