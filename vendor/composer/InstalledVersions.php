<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '2b5ac84bc0f3321d59a79d5470a1a7573a66df79',
    'name' => '__root__',
  ),
  'versions' => 
  array (
    '__root__' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '2b5ac84bc0f3321d59a79d5470a1a7573a66df79',
    ),
    'anik/amqp' => 
    array (
      'pretty_version' => 'v1.5',
      'version' => '1.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '091620674aefc6bd5666be2fd9cbbdccfded93cc',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => '2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
    ),
    'illuminate/collections' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e61e796ff98e19eac5e6735ea6abfa66f4a2f6db',
    ),
    'illuminate/container' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd2a50bd53eaf3e273a488246ec58f085dce92ca7',
    ),
    'illuminate/contracts' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c23428149639d5257916ad10d390cdbeffe4d504',
    ),
    'illuminate/macroable' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '300aa13c086f25116b5f3cde3ca54ff5c822fb05',
    ),
    'illuminate/pipeline' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd406237ea39f6c655569551a8bfb2d00ace6e43d',
    ),
    'illuminate/support' => 
    array (
      'pretty_version' => 'v8.12.3',
      'version' => '8.12.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '4f8b2d2589dec51b3fb9844e35606a1f1a7536e8',
    ),
    'laravel/helpers' => 
    array (
      'pretty_version' => 'v1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b4b8d6e84a6306fc88870f61a244d8c537779f2d',
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '2.41.5',
      'version' => '2.41.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c4a9caf97cfc53adfc219043bcecf42bc663acee',
    ),
    'php-amqplib/php-amqplib' => 
    array (
      'pretty_version' => 'v2.12.1',
      'version' => '2.12.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '0eaaa9d5d45335f4342f69603288883388c2fe21',
    ),
    'phpseclib/phpseclib' => 
    array (
      'pretty_version' => '2.0.29',
      'version' => '2.0.29.0',
      'aliases' => 
      array (
      ),
      'reference' => '497856a8d997f640b4a516062f84228a772a48a8',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'psr/container-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.20.0',
      'version' => '1.20.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '39d483bdf39be819deabf04ec872eb0b2410b531',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.20.0',
      'version' => '1.20.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e70aa8b064c5b72d3df2abd5ab1e90464ad009de',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v5.1.8',
      'version' => '5.1.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '27980838fd261e04379fa91e94e81e662fe5a1b6',
    ),
    'symfony/translation-contracts' => 
    array (
      'pretty_version' => 'v2.3.0',
      'version' => '2.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e2eaa60b558f26a4b0354e1bbb25636efaaad105',
    ),
    'symfony/translation-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.0',
      ),
    ),
    'videlalvaro/php-amqplib' => 
    array (
      'replaced' => 
      array (
        0 => 'v2.12.1',
      ),
    ),
    'voku/portable-ascii' => 
    array (
      'pretty_version' => '1.5.3',
      'version' => '1.5.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '25bcbf01678930251fd572891447d9e318a6e2b8',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
