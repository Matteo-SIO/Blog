<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'articles' => '\\Blog\\Map\\ArticleTableMap',
      'comments' => '\\Blog\\Map\\CommentTableMap',
      'roles' => '\\Blog\\Map\\RoleTableMap',
      'users' => '\\Blog\\Map\\UserTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Article' => '\\Blog\\Map\\ArticleTableMap',
      '\\Comment' => '\\Blog\\Map\\CommentTableMap',
      '\\Role' => '\\Blog\\Map\\RoleTableMap',
      '\\User' => '\\Blog\\Map\\UserTableMap',
    ),
  ),
));
