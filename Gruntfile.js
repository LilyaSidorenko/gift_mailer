module.exports = function(grunt) {
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            build: {
                files: [{
                    expand: true,
                    src: '*.js',
                    dest: 'build/js',
                    cwd: 'src/js/',
                    ext: '.min.js'
                }]
            }

        },
        sass: {
            dist: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'build/css/styles.css': 'src/styles/styles.scss'

                }
            }
        },
        jade: {
            compile: {
                files: [{
                    expand: true,
                    src: '*.jade',
                    dest: 'build/pages/',
                    cwd: 'src/jade-tpl/',
                    ext: '.html'
                }]
            }
        },
        watch: {
            scripts: {
                files: ['src/js/**/*.js'],
                tasks: ['uglify'],
                options: {
                    spawn: false
                }
            },
            sass: {
                files: ['src/styles/**/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false
                }
            },
            jade: {
                files: ['src/jade-tpl/**/*.jade'],
                tasks: ['jade'],
                options: {
                    spawn: false
                }
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-jade');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['jade'], ['sass'], ['uglify'], ['watch']);
};