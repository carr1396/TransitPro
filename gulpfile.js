var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.assetsPath = 'public/themes/default/assets';
elixir.config.publicPath = elixir.config.assetsPath;
elixir.config.css.sass.pluginOptions.includePaths = [
  'vendor/bower/bootstrap-sass/assets/stylesheets',
  'vendor/bower/font-awesome/scss'
];

elixir(function(mix) {
  mix.copy('vendor/bower/bootstrap-sass/assets/fonts',
           elixir.config.publicPath + '/fonts');
  mix.copy('vendor/bower/bootstrap-sass/assets/javascripts/bootstrap.min.js',
           elixir.config.publicPath + '/js/bootstrap.js');
  mix.copy('vendor/bower/font-awesome/fonts',
           elixir.config.publicPath + '/fonts');
  mix.copy('vendor/bower/jquery/dist/jquery.min.js',
           elixir.config.publicPath + '/js/jquery.js');
  mix.copy('vendor/bower/moment/min/moment.min.js',
           elixir.config.publicPath + '/js/moment.js');
  mix.copy('vendor/bower/lodash/dist/lodash.min.js',
           elixir.config.publicPath + '/js/lodash.js');
  mix.copy(
      'vendor/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
      elixir.config.publicPath + '/js/datetimepicker.js');
  mix.copy(
      'vendor/bower/eonasdan-bootstrap-datetimepicker/src/sass/_bootstrap-datetimepicker.scss',
      elixir.config.publicPath + '/sass/datetimepicker.scss');

  mix.copy('vendor/bower/simplemde/dist/simplemde.min.css',
           elixir.config.publicPath + '/css/simplemde.css');
  mix.copy(
      'vendor/bower/bootstrap-formhelpers/dist/css/bootstrap-formhelpers.min.css',
      elixir.config.publicPath + '/sass/bootstrap-formhelpers.css');
  mix.copy(
      'vendor/bower/bootstrap-formhelpers/dist/js/bootstrap-formhelpers.min.js',
      elixir.config.publicPath + '/js/bootstrap-formhelpers.js');
  mix.copy('vendor/bower/simplemde/dist/simplemde.min.js',
           elixir.config.publicPath + '/js/simplemde.js');
  mix.copy('vendor/bower/jquery-ui/jquery-ui.min.js',
           elixir.config.publicPath + '/js/jquery-ui.js');
  mix.copy('vendor/bower/Chart.js/Chart.js',
           elixir.config.publicPath + '/js/Chart.js');
  mix.copy('vendor/bower/toastr/toastr.min.js',
           elixir.config.publicPath + '/js/toastr.js');
  mix.copy('vendor/bower/toastr/toastr.scss',
           elixir.config.publicPath + '/sass/toastr.scss');
  mix.scripts([
    'jquery.js',
    'bootstrap.js',
    'moment.js',
    'simplemde.js',
    'datetimepicker.js',
    'bootstrap-formhelpers.js',
    'jquery-ui.js',
    'toastr.js',
    'Chart.js',
  ]);

  mix.sass('backend.scss');
  mix.sass('frontend.scss');
});
