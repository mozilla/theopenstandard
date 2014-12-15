module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        stylus: {
            compile: {
                options: {
                },
                files: {
                    '_/css/blog.css': '_/css/blog.styl'
                }
            }
        },
        sass: {
            dist: {
                options: {
                    loadPath: ['_/zurb_src/bower_components/foundation/scss/']
                },
                files: {
                    '_/zurb_src/dist/assets/css/app.css': '_/zurb_src/src/assets/scss/app.scss'
                }
            }
        },
        uglify: {
            dist: {
                files: {
                    '_/zurb_src/dist/assets/js/all.js': [
                        '_/zurb_src/bower_components/foundation/js/foundation.js',
                        '_/zurb_src/bower_components/OwlCarousel/owl-carousel/owl.carousel.js',
                        '_/zurb_src/src/assets/js/*'
                    ]
                }
            }
        },
        watch: {
            options: {
                livereload: 35730
            },
            stylus: {
                files: ['_/css/*.styl', '_/css/imports/*.styl'],
                tasks: ['stylus']
            },
            sass: {
                files: '_/zurb_src/src/assets/scss/**/*.scss',
                tasks: ['sass']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // Default task(s).
    grunt.registerTask('default', ['watch']);
    grunt.registerTask('build', ['uglify'])

};