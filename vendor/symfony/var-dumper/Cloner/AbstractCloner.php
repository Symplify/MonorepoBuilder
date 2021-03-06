<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner;

use MonorepoBuilder20210715\Symfony\Component\VarDumper\Caster\Caster;
use MonorepoBuilder20210715\Symfony\Component\VarDumper\Exception\ThrowingCasterException;
/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements \MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner\ClonerInterface
{
    public static $defaultCasters = ['__PHP_Incomplete_Class' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\Caster', 'castPhpIncompleteClass'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\CutStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castCutArray'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ConstStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castStub'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\EnumStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'castEnum'], 'Closure' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClosure'], 'Generator' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castGenerator'], 'ReflectionType' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castType'], 'ReflectionAttribute' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castAttribute'], 'ReflectionGenerator' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReflectionGenerator'], 'ReflectionClass' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClass'], 'ReflectionClassConstant' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castClassConstant'], 'ReflectionFunctionAbstract' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castFunctionAbstract'], 'ReflectionMethod' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castMethod'], 'ReflectionParameter' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castParameter'], 'ReflectionProperty' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castProperty'], 'ReflectionReference' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castReference'], 'ReflectionExtension' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castExtension'], 'ReflectionZendExtension' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster', 'castZendExtension'], 'MonorepoBuilder20210715\\Doctrine\\Common\\Persistence\\ObjectManager' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Doctrine\\Common\\Proxy\\Proxy' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castCommonProxy'], 'MonorepoBuilder20210715\\Doctrine\\ORM\\Proxy\\Proxy' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castOrmProxy'], 'MonorepoBuilder20210715\\Doctrine\\ORM\\PersistentCollection' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster', 'castPersistentCollection'], 'MonorepoBuilder20210715\\Doctrine\\Persistence\\ObjectManager' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'DOMException' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castException'], 'DOMStringList' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNameList' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMImplementation' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castImplementation'], 'DOMImplementationList' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNode' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNode'], 'DOMNameSpaceNode' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNameSpaceNode'], 'DOMDocument' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocument'], 'DOMNodeList' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMNamedNodeMap' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLength'], 'DOMCharacterData' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castCharacterData'], 'DOMAttr' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castAttr'], 'DOMElement' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castElement'], 'DOMText' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castText'], 'DOMTypeinfo' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castTypeinfo'], 'DOMDomError' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDomError'], 'DOMLocator' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castLocator'], 'DOMDocumentType' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castDocumentType'], 'DOMNotation' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castNotation'], 'DOMEntity' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castEntity'], 'DOMProcessingInstruction' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castProcessingInstruction'], 'DOMXPath' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DOMCaster', 'castXPath'], 'XMLReader' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster', 'castXmlReader'], 'ErrorException' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castErrorException'], 'Exception' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castException'], 'Error' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castError'], 'MonorepoBuilder20210715\\Symfony\\Bridge\\Monolog\\Logger' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Symfony\\Component\\DependencyInjection\\ContainerInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Symfony\\Component\\EventDispatcher\\EventDispatcherInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Symfony\\Component\\HttpClient\\CurlHttpClient' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'MonorepoBuilder20210715\\Symfony\\Component\\HttpClient\\NativeHttpClient' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClient'], 'MonorepoBuilder20210715\\Symfony\\Component\\HttpClient\\Response\\CurlResponse' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'MonorepoBuilder20210715\\Symfony\\Component\\HttpClient\\Response\\NativeResponse' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castHttpClientResponse'], 'MonorepoBuilder20210715\\Symfony\\Component\\HttpFoundation\\Request' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster', 'castRequest'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castThrowingCasterException'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\TraceStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castTraceStub'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\FrameStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castFrameStub'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Symfony\\Component\\ErrorHandler\\Exception\\SilencedErrorContext' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster', 'castSilencedErrorContext'], 'MonorepoBuilder20210715\\Imagine\\Image\\ImageInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ImagineCaster', 'castImage'], 'MonorepoBuilder20210715\\Ramsey\\Uuid\\UuidInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\UuidCaster', 'castRamseyUuid'], 'MonorepoBuilder20210715\\ProxyManager\\Proxy\\ProxyInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster', 'castProxy'], 'PHPUnit_Framework_MockObject_MockObject' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\PHPUnit\\Framework\\MockObject\\MockObject' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\PHPUnit\\Framework\\MockObject\\Stub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Prophecy\\Prophecy\\ProphecySubjectInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'MonorepoBuilder20210715\\Mockery\\MockInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\StubCaster', 'cutInternals'], 'PDO' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdo'], 'PDOStatement' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PdoCaster', 'castPdoStatement'], 'AMQPConnection' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castConnection'], 'AMQPChannel' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castChannel'], 'AMQPQueue' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castQueue'], 'AMQPExchange' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castExchange'], 'AMQPEnvelope' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\AmqpCaster', 'castEnvelope'], 'ArrayObject' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayObject'], 'ArrayIterator' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castArrayIterator'], 'SplDoublyLinkedList' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castDoublyLinkedList'], 'SplFileInfo' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileInfo'], 'SplFileObject' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castFileObject'], 'SplHeap' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'SplObjectStorage' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castObjectStorage'], 'SplPriorityQueue' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castHeap'], 'OuterIterator' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castOuterIterator'], 'WeakReference' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\SplCaster', 'castWeakReference'], 'Redis' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedis'], 'RedisArray' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisArray'], 'RedisCluster' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RedisCaster', 'castRedisCluster'], 'DateTimeInterface' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castDateTime'], 'DateInterval' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castInterval'], 'DateTimeZone' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castTimeZone'], 'DatePeriod' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DateCaster', 'castPeriod'], 'GMP' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\GmpCaster', 'castGmp'], 'MessageFormatter' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castMessageFormatter'], 'NumberFormatter' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castNumberFormatter'], 'IntlTimeZone' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlTimeZone'], 'IntlCalendar' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlCalendar'], 'IntlDateFormatter' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\IntlCaster', 'castIntlDateFormatter'], 'Memcached' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster', 'castMemcached'], 'MonorepoBuilder20210715\\Ds\\Collection' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castCollection'], 'MonorepoBuilder20210715\\Ds\\Map' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castMap'], 'MonorepoBuilder20210715\\Ds\\Pair' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPair'], 'MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\DsCaster', 'castPairStub'], 'CurlHandle' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':curl' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castCurl'], ':dba' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], ':dba persistent' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castDba'], 'GdImage' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':gd' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castGd'], ':mysql link' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castMysqlLink'], ':pgsql large object' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLargeObject'], ':pgsql link' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql link persistent' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castLink'], ':pgsql result' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster', 'castResult'], ':process' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castProcess'], ':stream' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], 'OpenSSLCertificate' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':OpenSSL X.509' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castOpensslX509'], ':persistent stream' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStream'], ':stream-context' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\ResourceCaster', 'castStreamContext'], 'XmlParser' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], ':xml' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster', 'castXml'], 'RdKafka' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castRdKafka'], 'MonorepoBuilder20210715\\RdKafka\\Conf' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castConf'], 'MonorepoBuilder20210715\\RdKafka\\KafkaConsumer' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castKafkaConsumer'], 'MonorepoBuilder20210715\\RdKafka\\Metadata\\Broker' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castBrokerMetadata'], 'MonorepoBuilder20210715\\RdKafka\\Metadata\\Collection' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castCollectionMetadata'], 'MonorepoBuilder20210715\\RdKafka\\Metadata\\Partition' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castPartitionMetadata'], 'MonorepoBuilder20210715\\RdKafka\\Metadata\\Topic' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicMetadata'], 'MonorepoBuilder20210715\\RdKafka\\Message' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castMessage'], 'MonorepoBuilder20210715\\RdKafka\\Topic' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopic'], 'MonorepoBuilder20210715\\RdKafka\\TopicPartition' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicPartition'], 'MonorepoBuilder20210715\\RdKafka\\TopicConf' => ['MonorepoBuilder20210715\\Symfony\\Component\\VarDumper\\Caster\\RdKafkaCaster', 'castTopicConf']];
    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;
    private $casters = [];
    private $prevErrorHandler;
    private $classInfo = [];
    private $filter = 0;
    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(array $casters = null)
    {
        if (null === $casters) {
            $casters = static::$defaultCasters;
        }
        $this->addCasters($casters);
    }
    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     */
    public function addCasters($casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }
    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     * @param int $maxItems
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;
    }
    /**
     * Sets the maximum cloned length for strings.
     * @param int $maxString
     */
    public function setMaxString($maxString)
    {
        $this->maxString = $maxString;
    }
    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     * @param int $minDepth
     */
    public function setMinDepth($minDepth)
    {
        $this->minDepth = $minDepth;
    }
    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var, $filter = 0)
    {
        $this->prevErrorHandler = \set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }
            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }
            return \false;
        });
        $this->filter = $filter;
        if ($gc = \gc_enabled()) {
            \gc_disable();
        }
        try {
            return new \MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner\Data($this->doClone($var));
        } finally {
            if ($gc) {
                \gc_enable();
            }
            \restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }
    /**
     * Effectively clones the PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return array The cloned variable represented in an array
     */
    protected abstract function doClone($var);
    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The object casted as array
     * @param \Symfony\Component\VarDumper\Cloner\Stub $stub
     */
    protected function castObject($stub, $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;
        if (\PHP_VERSION_ID < 80000 ? "\0" === ($class[15] ?? null) : \false !== \strpos($class, "@anonymous\0")) {
            $stub->class = \get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            [$i, $parents, $hasDebugInfo, $fileInfo] = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = \method_exists($class, '__debugInfo');
            foreach (\class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (\class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';
            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(\MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner\Stub::class) ? [] : ['file' => $r->getFileName(), 'line' => $r->getStartLine()];
            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }
        $stub->attr += $fileInfo;
        $a = \MonorepoBuilder20210715\Symfony\Component\VarDumper\Caster\Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);
        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(\MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner\Stub::TYPE_OBJECT === $stub->type ? \MonorepoBuilder20210715\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL : '') . '⚠' => new \MonorepoBuilder20210715\Symfony\Component\VarDumper\Exception\ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The resource casted as array
     * @param \Symfony\Component\VarDumper\Cloner\Stub $stub
     */
    protected function castResource($stub, $isNested)
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;
        try {
            if (!empty($this->casters[':' . $type])) {
                foreach ($this->casters[':' . $type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(\MonorepoBuilder20210715\Symfony\Component\VarDumper\Cloner\Stub::TYPE_OBJECT === $stub->type ? \MonorepoBuilder20210715\Symfony\Component\VarDumper\Caster\Caster::PREFIX_VIRTUAL : '') . '⚠' => new \MonorepoBuilder20210715\Symfony\Component\VarDumper\Exception\ThrowingCasterException($e)] + $a;
        }
        return $a;
    }
}
