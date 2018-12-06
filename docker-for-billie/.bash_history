cd ../doc
git status
npm install -g swagger-cli
cd Tools/
swagger-cli validate base.yml 
php convert_json_reponse.php -f 
php convert_json_reponse.php -f json_reponse/authcheck.json  -m /var/www/docs/public/common/models/ -y /var/www/docs/public/welcome-api/v1
