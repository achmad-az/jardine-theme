const gulp = require('gulp');
const yargs = require('yargs');
const sass = require('gulp-sass');
const minify = require('gulp-clean-css');
const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const imagemin = require('gulp-imagemin');
const del = require('del');
const webpack = require('webpack-stream');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync');

gulp.task('style', styleTask);
gulp.task('fonts', fonts);
gulp.task('watch', watch);
gulp.task('images', images);
gulp.task('clean', clean);
gulp.task('build', build);
gulp.task('dev', dev);
gulp.task('scripts', scripts);

const PRODUCTION = yargs.argv.prod;
const server = browserSync.create();

const paths = {
	styles: {
		src: ['src/assets/scss/bundle.scss'],
		dest: 'dist/assets/css'
	},
	images: {
		src: 'src/assets/img/**/*.{jpg,jpeg,png,svg}',
		dest: 'dist/assets/images'
	},
	fonts: {
		src: 'src/assets/webfonts/**',
		dest: 'dist/assets/webfonts'
	},
	scripts: {
		src: 'src/assets/js/bundle.js',
		dest: 'dist/assets/js'
	},
  other:{
    src: ['src/assets/**/*', '!src/assets/{images,js,scss}', '!src/assets/{images,js,scss}/**/*'],
    dest: 'dist/assets'
  }
}

function serve(done){
	server.init({
		proxy: 'http://localhost/wecreate/'
	});
	done();
}

function reload(done){
	server.reload();
	done();
}

function clean(){
	return del(['dist']);
}

function styleTask(){
	return gulp.src(paths.styles.src)
				.pipe(gulpif(!PRODUCTION, sourcemaps.init()))
				.pipe(sass().on('error', sass.logError))
				.pipe(gulpif(PRODUCTION, minify({compability: 'ie8'})))
				.pipe(gulpif(!PRODUCTION, sourcemaps.write()))
				.pipe(gulp.dest(paths.styles.dest))
				.pipe(server.stream());
				reload();
}

function fonts(){
  return gulp.src('node_modules/@fortawesome/fontawesome-free/css/all.css')
    .pipe(gulp.dest('dist/assets/fonts'));
}

function watch(){
	gulp.watch('src/assets/scss/**/*.scss', styleTask);
	gulp.watch('**/*.php', reload);
	gulp.watch('src/assets/js/**/*.js', gulp.series(scripts, reload));
}

function images(){
	return gulp.src(paths.images.src)
				.pipe(gulpif(PRODUCTION, imagemin()))
				.pipe(gulp.dest(paths.images.dest));
}

function fonts(){
	return gulp.src(paths.fonts.src)
			.pipe(gulp.dest(paths.fonts.dest));
}

function scripts(){
	return gulp.src(paths.scripts.src)
				.pipe(webpack({
					module: {
						rules: [
							{
								test: /\.js$/,
								use: ['babel-loader'],
								exclude: /node_modules/
							}
						]
					},
					output: {
						filename: 'main.js'
					},
					devtool: !PRODUCTION ? 'inline-source-map':false
				}))
				.pipe(gulpif(PRODUCTION, uglify()))
				.pipe(gulp.dest(paths.scripts.dest))
}

function build(){
	return gulp.series(clean, gulp.parallel(styleTask, scripts, images, fonts))();
}

function dev(){
	return gulp.series(clean, gulp.parallel(styleTask, scripts, images, fonts), serve, watch)();
}
