# SPMB

## Instalasi

Untuk instalasi:

- Clone project dengan perintah `git clone https://github.com/alfisahr/goman-mis-spmb.git`
- Akan ada folder `goman-mis-spmb`. Silahkan rename folder tsb sesuai yang dikehendaki, misalkan `spmb`
- Jalankan perintah `composer install` untuk menginstall dependency
- Jika ingin me-running aplikasi dengan subfolder, contohnya `http://localhost/spmb` atau `http://10.14.83.2/spmb` silahkan terlebih dahulu ubah `baseURL` config di `app/Config/App.php` dengan url yang dikehendaki. Setelahnya ubah file `.htaccess` di `public/.htaccess` menjadi spt ini:
```
# spmb/public/.htacess

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

- Buat file `.env` dengan kode kurang lebih spt ini
```
CI_ENVIRONMENT = production

database.default.DSN = sqlsrv:Server=PRINTING,5000;Database=BekalDB
database.default.hostname = PRINTING
database.default.database = BekalDB
database.default.username = 
database.default.password = 
database.default.DBDriver = sqlsrv
database.default.port = 5000
database.default.DBPrefix =

database.orderEntryDb.hostname = PRINTING
database.orderEntryDb.database = OrderEntryDB
database.orderEntryDb.username = 
database.orderEntryDb.password = 
database.orderEntryDb.DBDriver = SQLSRV
database.orderEntryDb.port = 5000
database.orderEntryDb.DBPrefix =

database.nls.DSN = sqlsrv:Server=0.0.0.0,5000;Database=LogisticDb
database.nls.hostname = 10.9.61.26
database.nls.database = LogisticDb
database.nls.username = 
database.nls.password = 
database.nls.DBDriver = SQLSRV
database.nls.port = 5000
database.nls.DBPrefix =
```

- Untuk melakukan update atau sync aplikasi terbaru (paling mutakhir) jalankan melalui perintah `git pull origin main`