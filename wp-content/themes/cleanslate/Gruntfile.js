'use strict';
module.exports = function(grunt) {
 
    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);
 
    grunt.initConfig({
 
        // watch for changes and trigger compass, jshint, uglify and livereload
        watch: {
            options: {
                livereload: true,
            },
            compass: {
                files: ['assets/styles/scss/**/*.{scss,sass}'],
                tasks: ['compass']
            },
            js: {
                files: '<%= jshint.all %>',
                tasks: ['jshint', 'uglify']
            },
            livereload: {
                files: ['*.html', '*.php', 'assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },
 
        // compass and scss
        compass: {
            dist: {
                options: {
                    config: 'config.rb',
                    force: true
                }
            }
        },
 
        // javascript linting with jshint
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                "force": true
            },
            all: [
                'Gruntfile.js',
                'assets/js/source/main.js'
            ]
        },
 
        // uglify to concat, minify, and make source maps
        uglify: {
            dist: {
                options: {
                    sourceMap: 'js/map/source-map.js'
                },
                files: {
                    'js/plugins.min.js': [
                        'js/source/plugins.js',
                        'js/vendor/**/*.js',
                        '!assets/js/vendor/modernizr*.js'
                    ],
                    'js/main.min.js': [
                        'js/source/main.js'
                    ]
                }
            }
        },
 
        // image optimization
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 7,
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: 'assets/images/',
                    src: '**/*',
                    dest: 'assets/images/'
                }]
            }
        },
 
        // // deploy via rsync
        // deploy: {
        //     staging: {
        //         src: "./",
        //         dest: "~/path/to/theme",
        //         host: "user@host.com",
        //         recursive: true,
        //         syncDest: true,
        //         exclude: ['.git*', 'node_modules', '.sass-cache', 'Gruntfile.js', 'package.json', '.DS_Store', 'README.md', 'config.rb', '.jshintrc']
        //     },
        //     production: {
        //         src: "./",
        //         dest: "~/path/to/theme",
        //         host: "user@host.com",
        //         recursive: true,
        //         syncDest: true,
        //         exclude: '<%= rsync.staging.exclude %>'
        //     }
        // }
 
    });
 
    // rename tasks
    grunt.renameTask('rsync', 'deploy');
 
    // register task
    grunt.registerTask('default', ['watch']);
 
};