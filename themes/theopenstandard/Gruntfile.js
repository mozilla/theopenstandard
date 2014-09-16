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
        watch: {
            options: {
                livereload: true
            },
            css: {
                files: ['_/css/*.styl', '_/css/imports/*.styl'],
                tasks: ['stylus']
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-stylus');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['watch']);

};