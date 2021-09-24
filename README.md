<div class="markdown-body editormd-preview-container editormd-preview-active" previewcontainer="true"
  style="padding: 20px;">
  <h1>Setup</h1>
  <ol>
    <li>Docker (require)</li>
    <li>Docker folder</li>
    <li>Config docker-compose.yml ( Nginx + Php7.4 + mysql + phpmyadmin)</li>
    <li>Config Laravel database enviroment<br><strong>DB_CONNECTION=mysql </strong><br><strong>DB_HOST=mysql </strong>
      // from service docker-compose<br><strong>DB_PORT=3306 </strong> // from service
      docker-compose<br><strong>DB_DATABASE=laravel </strong>// from service docker-compose<br><strong>DB_USERNAME=root
      </strong><br><strong>DB_PASSWORD=password </strong> // from service docker-compose </li>
      <li>Run
       <ul>
        <li>run: docker-compose up -d</li>
        <li>run: php artisan config:clear, php artisan config:cache</li>
        <li>run: docker-compose exec mysql bash, mysql -u root -p (Login and check database in mysql from docker)</li>
        <li>turn off docker-compose down</li>
      </ul>
      </li>
    </ol>
  <h1>Phpmyadmin</h1>
   <p>View: http://localhost:8200</p>
  <h1>Laravel</h1>
    <p>Run: php artisan serve </p>
   <p>View: http://127.0.0.1:8000</p>
</div>