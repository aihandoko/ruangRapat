# Ruang Rapat

## Instalasi

Untuk instalasi:

- Clone project dengan perintah `git clone https://github.com/aihandoko/ruangRapat.git`
- Jalankan perintah `composer install` untuk menginstall dependency
- Buat file `.env` dengan kode kurang lebih spt ini
```
CI_ENVIRONMENT = production

# Masukkan URL (silahkan sesuaikan)
app.baseURL = 'http://localhost/ruangrapat/'

database.orderEntryDb.hostname = PRINTING
database.orderEntryDb.database = OrderEntryDB
database.orderEntryDb.username = 
database.orderEntryDb.password = 
database.orderEntryDb.DBDriver = SQLSRV
database.orderEntryDb.port = 5000
database.orderEntryDb.DBPrefix =

```
- Buka console persis di directory project ini dan jalankan `php spark serve` untuk menstartup local web server
- Jika ingin me-running aplikasi dengan subfolder, contohnya `http://localhost/ruangrapat` silahkan ubah file `.htaccess` di `public/.htaccess` menjadi spt ini:
```
# public/.htacess

RewriteEngine on

RewriteCond $1 !^(index\.php|images|assets|css|js|robots\.txt|favicon\.ico)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*) index.php/$1 [L]

<IfModule mod_headers.c>
  <FilesMatch "\.(ttf|ttc|otf|eot|woff|woff2|font.css|css|js)$">
    Header set Access-Control-Allow-Origin "*"
  </FilesMatch>
</IfModule>
```
Kemudian tambahkan pula file `.htaccess` baru di root aplikasi, dengan kode spt ini:
```
# spmb/.htacess

DirectoryIndex index.php
Options -Indexes

RewriteEngine On

# Unconditionally rewrite everything to the "public" subdirectory
RewriteRule (.*) public/$1 [L]
```

- Untuk melakukan update atau sync aplikasi terbaru (paling mutakhir) jalankan melalui perintah `git pull origin main`
