ローカルで動作するようになってます。  
データベースとデータベースユーザーの設定はinit.sqlを確認。  
PHPからのデータベース接続に関してはenv.phpとdbconnect.phpを確認。

追記(08/13/24)：env.phpを非表示にしました。（ファイル名も.env.phpに変更しました）  
.env.php書式は以下のようになっています。  
```php:.env.php
<?php

define("DB_HOST", "");          // ホスト
define("DB_NAME", "keijiban");  // データベース名
define("DB_USER", "");          // ユーザー名
define("DB_PASS", "");          // パスワード
```
他、軽微な修正をしました。
