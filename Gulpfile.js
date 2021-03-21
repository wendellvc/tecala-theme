const gulp = require('gulp');

const browserSync = require('browser-sync').create();
const changed = require('gulp-changed');
const concat = require('gulp-concat');
const del = require('del');
const imageMin = require('gulp-imagemin');
const map = require('lodash.map');
const plumber = require('gulp-plumber');
const postCSS = require('gulp-postcss');
const potGen = require('gulp-wp-pot');
const rename = require('gulp-rename');
const rev = require('gulp-rev');
const revDel = require('gulp-rev-delete-original');
const revUpdateCSS = require('gulp-rev-css-url');
const sass = require('gulp-sass');
const sort = require('gulp-sort');
const uglify = require('gulp-uglify');

/*
 |--------------------------------------------------------------------------
 | Config.
 |--------------------------------------------------------------------------
 |
 | Most of the important options are available here to edit, but some
 | are still in the tasks below. I could extract them, but the file's so
 | small that it's hardly warranted.
 |
 */
const config = {
	manifest: 'assets.json',
	project: {
		name: 'Tecala',
		textDomain: 'tecala',
		destPath: 'develop/languages/',
		localURL: 'https://tecala.test'
	},
	scss: [
		{
			src: 'develop/scss/style.scss',
			destFileName: 'style.css',
			destPath: 'assets/css/'
		},
		{
			src: 'develop/scss/normalize.scss',
			destFileName: 'normalize.css',
			destPath: 'assets/css/'
		}
	],
	js: [
		{
			src: [
				'develop/js/global.js'
			],
			destFileName: 'global.js',
			destPath: 'assets/js/'
		}
	]
};

/*
 |--------------------------------------------------------------------------
 | Available Tasks
 |--------------------------------------------------------------------------
 |
 | Each of the key build tasks are available to run standalone, or you
 | can run 'gulp watch` to keep an eye on all files. Run `gulp develop` to
 | launch BrowserSync and watch at the same time.
 |
 | The default task runs all build tasks (the equivalent of the old
 | `gulp build` task).
 |
 */

gulp.task(css);
gulp.task(js);
gulp.task(i18n);
gulp.task(images);
gulp.task(serve);
gulp.task(watch);
gulp.task(cacheBuster);
gulp.task(clean);

gulp.task('default', gulp.series(clean, gulp.parallel(css, js, i18n, images)));
gulp.task('dev', gulp.series(clean, 'default', gulp.parallel(serve, watch)));
gulp.task('prod', gulp.series(clean, gulp.parallel(css, js, i18n, images), cacheBuster));

/*
 |--------------------------------------------------------------------------
 | Tasks.
 |--------------------------------------------------------------------------
 |
 | Here are the tasks themselves. They're pretty simple, so should be easy
 | to debug or change if need be. Some config values are hard coded, as I
 | haven't felt the need to extract them. The file is short, it can easily
 | be edited.
 |
 */

function css(done) {
	map(config.scss, function (scssConfig) {
		return gulp.src(scssConfig.src)
			.pipe(plumber())
			.pipe(sass())
			.pipe(postCSS([
				require('postcss-sorting')({
					'properties-order': 'alphabetical'
				}),
				require('autoprefixer'),
				require('css-mqpacker')({
					sort: true,
				}),
				require('postcss-pxtorem')({
					replace: true,
					media_query: true
				}),
				require('cssnano')
			]))
			.pipe(rename(scssConfig.destFileName))
			.pipe(gulp.dest(scssConfig.destPath))
			.pipe(browserSync.stream());
	});
	done();
}

function js(done) {
	map(config.js, function (jsConfig) {
		return gulp.src(jsConfig.src)
			.pipe(plumber())
			.pipe(uglify())
			.pipe(concat(jsConfig.destFileName))
			.pipe(gulp.dest(jsConfig.destPath))
			.pipe(browserSync.stream());
	});
	done();
}

function i18n() {
	return gulp.src(['**/*.php', '!vendor/**'])
		.pipe(plumber())
		.pipe(sort())
		.pipe(potGen({
			domain: config.project.textDomain,
			package: config.project.name
		}))
		.pipe(gulp.dest(config.project.destPath + config.project.textDomain + '.pot'));
}

function images() {
	return gulp.src('develop/images/**/*')
		.pipe(plumber())
		.pipe(changed('assets/images/'))
		.pipe(imageMin({
			verbose: true,
			optimizationLevel: 3,
			progressive: true,
			interlaced: true,
		}))
		.pipe(gulp.dest('assets/images/'));
}

function serve(done) {
	browserSync.init({
		proxy: config.project.localURL,
		reloadDelay: 500
	});
	done();
}

function reload(done) {
	browserSync.reload();
	done();
}

function cacheBuster() {
	return gulp.src(['assets/**/*', '!assets/{fonts,fonts/**/*}'])
		.pipe(sort())
		.pipe(rev())
		.pipe(revDel())
		.pipe(revUpdateCSS())
		.pipe(gulp.dest('assets/'))
		.pipe(rev.manifest(config.manifest, {
			merge: true
		}))
		.pipe(gulp.dest('assets/'));
}

function clean(done) {
	del([
		'assets/assets.json',
		'assets/css/**/*',
		'assets/images/**/*',
		'assets/js/**/*'
	]);
	done();
}

function watch() {
	gulp.watch(['**/*.php', '!vendor/**'], gulp.series(i18n, reload));
	gulp.watch('develop/scss/**/*.scss', gulp.series(css, reload));
	gulp.watch('develop/js/*.js', gulp.series(js, reload));
	gulp.watch('develop/images/*', gulp.series(images, reload));
}
