module.exports = function (grunt) {
    grunt.initConfig({
        shell: {
            tests: {
                command: [
                    'clear',
                    'vendor/bin/phpspec run -n --ansi'
                ].join('&&'),
                options: {
                    stdout: true
                }
            }
        },
        watch: {
            tests: {
                files: ['{lib,src,spec}/**/*.php'],
                tasks: ['shell:tests']
            }
        }
    });

    // plugins
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-shell');

    // tasks
    grunt.registerTask('tests', ['shell:tests', 'watch:tests']);
};