<div>
    <p>Install project:</p>
    <b>Linux</b>
            <p>Install project:</p>
            <ol>
                <li><code>cp .env.example .env</code></li>
                <li>В .env файле укажите настройки подключения к базе данных DB_USERNAME,DB_PASSWORD</li>
                <li><code>./install_project.sh</code></li>
            </ol>
            <p>Доступы в админку: логин <code>admin</code> пароль можно получить выполнив команду <code>php artisan pass admin</code></p>
    <b>Windows</b>
    <ol>
        <li> <code>copy .env.example .env</code></li>
        <li><code>composer install</code></li>
        <li>В .env файле укажите настройки подключения к базе данных DB_DATABASE, DB_USERNAME,DB_PASSWORD. </li>
        <li>
            <small>Если запускаешь проект не через Laravel сервер (<code>php artisan serve</code>) установи APP_URL(файл .env) на твой хост(с протоколом), пример: <code>APP_URL=http://project.loc</code>
                <p>И выполни команду <code>copy .htaccess.example .htaccess</code> </p>
            </small>
        </li>
        <li><code>php artisan migrate --seed</code></li>
        <li><code>php artisan storage:link</code><small>(нужно для нормального отображения картинок)</small></li>
    </ol>
    <p>Run server: <code>php artisan serve</code></p>
    <p>Доступы в админку: <p>superadmin</p> пароль можно получить выполнив команду <code>php artisan pass superadmin</code>

</div>