var SERVER_PORT = 3000;
var LIVERELOAD_PORT = 3100;
var DEV_HOST = 'localhost';

module.exports = function (grunt) {
	'use strict';

	var path = require('path');

	var config = {
		assets: 'public/assets',
		app: 'app',
		build: 'build',
		root: process.cwd().replace('c:', 'c').replace(/\\/g, '/')
	};

	// Project configuration
	grunt.initConfig({
		config: config,
		pkg: grunt.file.readJSON('package.json'),
		php: {
			development: {
				options: {
					open: false,
					router: '../server.php',
					hostname: '0.0.0.0',
					base: './public',
					port: SERVER_PORT
				}
			}
		},
		open: {
			development: {
				path: 'http://'+DEV_HOST+':' + SERVER_PORT
			}
		},
		less: {
			development: {
				options: {
					compress: true,
					sourceMap: true,
					sourceMapBasepath: 'public',
					sourceMapRootpath: '/',
					paths: [
						'<%= config.assets %>/styles/less',
						'public/vendor'
					]
				},
				files: {
					'<%= config.assets %>/styles/styles.css': '<%= config.assets %>/styles/less/styles.less'
				}
			},
			email: {
				options: {
					compress: false,
					sourceMap: false,
					paths: [
						'<%= config.assets %>/styles/less',
						'public/vendor'
					]
				},
				files: {
					'<%= config.assets %>/styles/mail.css': '<%= config.assets %>/styles/less/mail.less'
				}
			},
			dist: {
				options: {
					compress: true,
					sourceMap: false,
					paths: [
						'<%= config.assets %>/styles/less',
						'public/vendor'
					]
				},
				files: {
					'<%= config.assets %>/styles/survey.css': '<%= config.assets %>/styles/less/styles.less'
				}
			}
		},
		concat: {
			options: {
				separator: ';',
			},
			frontend: {
				src: [
					'public/vendor/jquery/dist/jquery.js',
					'public/vendor/jquery.smooth-scroll/jquery.smooth-scroll.js',
					'public/vendor/scrollReveal.js/scrollReveal.js',
					'public/vendor/headroom.js/dist/headroom.js',
					'public/vendor/headroom.js/dist/jQuery.headroom.js',
					'public/assets/scripts/script.js'
				],
				dest: 'public/assets/scripts/script.min.js',
			}
		},
		inlinecss: {
			main: {
				options: {
					applyLinkTags: true,
					url: 'file://<%= config.root %>/public/'
				},
				files: {
					'<%= config.app %>/views/emails/invitation/intro.blade.php': '<%= config.app %>/views/emails/invitation/intro_base.blade.php',
					'<%= config.app %>/views/emails/invitation/results.blade.php': '<%= config.app %>/views/emails/invitation/results_base.blade.php'
				}
			}
		},
		watch: {
			options: {
				livereload: {
					port: LIVERELOAD_PORT
				}
			},
			livereload: {
				files: [
					'<%= config.app %>/views/**/*.php',
					'<%= config.assets %>/scripts/**/*.js'
				]
			},
			less: {
				files: [
					'<%= config.assets %>/styles/less/{,*/}*.less'],
				tasks: ['less:development']
			},
			scripts: {
				files: [
					'<%= config.assets %>/scripts/script.js'],
				tasks: ['concat']
			}
		},

		requirejs: {
			dist: {
				// Options: https://github.com/jrburke/r.js/blob/master/build/example.build.js
				options: {
					almond: true,
					baseUrl: '<%= config.assets %>/scripts',
					dir: '<%= config.build %>/<%= config.assets %>/scripts',
					optimize: 'uglify',
					removeCombined: true,
					findNestedDependencies: true,
					wrapShim: true,
					mainConfigFile: '<%= config.assets %>/scripts/config/config.js',
					modules: [
						{name: 'survey'}
					],
					preserveLicenseComments: false,
					useStrict: true,
					wrap: false
				}
			}
		},
		clean: {
			options: { force: true },
			dist: ['<%= config.build %>/**/*']
		},
		copy: {
			dist: {
				files: [{
					expand: true,
					dot: true,
					cwd: '.',
					dest: '<%= config.build %>/',
					src: [
						'composer.{json,lock}',
						'index.php',
						'server.php',
						'artisan',
						'app/**/*',
						'bootstrap/**',
						'public/*.*',
						'public/assets/images/{,*/}*.{webp,gif,cur,svg,png,jpg}',
						'public/assets/fonts/{,*/}*.{eot,svg,ttf,woff}',
						'public/assets/styles/{,*/}*.css',
						'vendor/**',
					]
				}]
			}
		}
	});

	grunt.registerTask('dist', [
			'clean',
			'less:dist',
			'copy:dist'
		]);


	grunt.registerTask('build', function ( target ) {

		grunt.task.run([
			'less:development',
			'less:email',
			'concat'
			//'inlinecss'
		]);


	});

	// Default task
	grunt.registerTask('serve', [
		'build',
		'php:development',
		'open:development',
		'watch'
	]);

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-email-builder');
	grunt.loadNpmTasks('grunt-inline-css');
	grunt.loadNpmTasks('grunt-open');
	grunt.loadNpmTasks('grunt-php');

};
