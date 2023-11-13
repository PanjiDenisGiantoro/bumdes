<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project repository
set('repository', 'git@gitlab.com:shahonseven/kowargi.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// dep deploy staging
host('staging')
    ->hostname('103.171.84.11')
    ->user('user')
    ->multiplexing(false)
    ->set('branch', 'master')
    ->set('deploy_path', '~/www.dagangbareng.id/staging');
// dep deploy production
host('production')
    ->hostname('103.171.84.11')
    ->user('user')
    // ->multiplexing(false)
    ->set('branch', 'master')
    ->set('deploy_path', '~/www.dagangbareng.id/production');
// dep deploy coopxchange.id
host('coopxchange.id')
    ->hostname('103.171.84.11')
    ->user('user')
    // ->multiplexing(false)
    ->set('branch', 'master')
    ->set('deploy_path', '~/webapps/coopxchange.id');

task('deploy:optimize', function () {
    run('cd {{release_path}} && composer dump-autoload -o && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear');
});

task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'deploy:symlink',
    'deploy:optimize',
    'deploy:unlock',
    'cleanup',
]);

task('symlink:assets', function () {
    run('ln -s {{deploy_path}}/shared/assets/* {{deploy_path}}/current/public');
});

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php7.4-fpm restart');
})->onHosts('staging');

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php7.4-fpm restart');
})->onHosts('production');

before('deploy:symlink', 'artisan:migrate');
after('deploy:symlink', 'reload:php-fpm');

after('deploy', 'symlink:assets');
after('deploy:failed', 'deploy:unlock');

