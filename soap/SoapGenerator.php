<?php

namespace sebastiangolian\php\soap;

use SoapClient;

/**
 $generator = new SoapGenerator('http://www.webservicex.net/geoipservice.asmx?WSDL',['trace'=>true]);
 $generator->serviceAlias = 'NewSoap';
 $generator->namespace = '';
 $generator->outputFile = 'NewSoap.php';
 $generator->generateCode();
 */
class SoapGenerator
{
    public $serviceAlias = 'Service';
    public $namespace = '';
    public $outputFile = '';
    public $tryFindBase = false;
    
    protected $types = array();
    protected $methods = array();
    protected $nativeTypes = array(
        'int',
        'integer',
        'string',
        'date',
        'datetime',
        'bool',
        'boolean',
        'float',
        'decimal',
    );
    protected $wsdl = '';
    protected $wsdlXml = null;
    
    public function __construct($wsdl, $opts)
    {
        $client = new SoapClient($wsdl, $opts);
        $this->types = array_unique($client->__getTypes());
        $this->methods = array_unique($client->__getFunctions());
        $this->wsdl = $wsdl;
    }
    
    public function generateFile()
    {
        if (!empty($this->outputFile)) {
            file_put_contents($this->outputFile, $this->generate());
        } else {
            throw new \Exception('Param "outputFile" is empty.');
        }
    }
    
    /**
     * highlight_string($soap->generateCode())
     * @return string
     */
    public function generateCode()
    {
        return $this->generate();
    }
    
    private function generate()
    {
        if ($this->tryFindBase) {
            $this->wsdlXml = simplexml_load_file($this->wsdl);
        }
        
        $soapMethods = $this->parseMethods();
        $soapTypes = $this->parseTypes();
        
        $classStart = "<?php" . PHP_EOL;
        if($this->namespace != '')
        {
            $classStart .= "namespace " .$this->namespace.";".PHP_EOL;
            $classStart .= PHP_EOL;
        }
        $classStart .= "class $this->serviceAlias extends \SoapClient {" . PHP_EOL;
        
        
        $class = '';
        $class .= $this->generateConstructor();
        $class .= $this->generateSoapCall();
        foreach ($soapMethods as $method) {
            $class .= "\t/**" . PHP_EOL;
            $class .= "\t* Genarated webservice method " . $method['method'] . PHP_EOL;
            $class .= "\t*" . PHP_EOL;
            
            $methodParams = array();
            $methodParamsVals = array();
            foreach ($method['params'] as $param) {
                if (in_array($param['type'], $this->nativeTypes)) {
                    $methodParams[] = $param['name'];
                    $class .= "\t* @param " . $param['type'] . ' ' . $param['name'] . PHP_EOL;
                } else {
                    $methodParams[] = $param['type'] . ' ' . $param['name'];
                    $class .= "\t* @param " . $param['type'] . ' ' . $param['name'] . PHP_EOL;
                }
                $methodParamsVals[] = $param['name'];
            }
            
            $class .= "\t* @return " . $method['return'] . PHP_EOL;
            $class .= "\t*/" . PHP_EOL;
            
            $class .= "\tpublic function " . $method['method'] . "(";
            $class .= implode(' ', $methodParams);
            $class .= ") {" . PHP_EOL;
            
            $parameters = '';
            if(count($methodParamsVals) > 0) {
                $parameters = ',(array) ' . implode(' ', $methodParamsVals);
            }
            
            $class .= "\t\t" . 'return $this->__soapCall("' . $method['method'].'"'.$parameters.');' . PHP_EOL;
            $class .= "\t}" . PHP_EOL . PHP_EOL;
        }
        
        $class .= '}' . PHP_EOL;
        
        $wsdl = "\t" . 'protected $wsdl = "' .$this->wsdl.'";'. PHP_EOL;
        $classMap = "\t" . 'protected $classmap = array(' . PHP_EOL;
        $classMapArray = array();
        $types = PHP_EOL . '/**********SOAP TYPES***********/' . PHP_EOL;
        foreach ($soapTypes as $type) {
            $classMapArray[] = "\t\t" . '"' .$type['name'] . '" => "' . $this->parseNamespace() . $type['name'] . '"';
            $types .= $this->generateType($type);
        }
        
        $classMap .= implode(',' . PHP_EOL, $classMapArray);
        $classMap .= PHP_EOL . "\t);" . PHP_EOL . PHP_EOL;
        
        return $classStart.$wsdl.$classMap.$class.$types;
    }
    
    protected function parseMethods()
    {
        $soapMethods = array();
        foreach ($this->methods as $method) {
            $struct = explode(' ', trim(str_replace(array("(", ")"), ' ', $method)));
            $returnType = $struct[0];
            $methodName = $struct[1];
            array_shift($struct);
            array_shift($struct);
            
            $params = array();
            $index = 0;
            foreach ($struct as $k => $param) {
                if ($k % 2 == 0) { //param type
                    $params[$index]['type'] = $param;
                } else { //param name
                    $params[$index]['name'] = $param;
                    $index++;
                }
            }
            
            $soapMethods[] = array(
                'return' => $returnType,
                'method' => $methodName,
                'params' => $params
            );
        }
        
        return $soapMethods;
    }
    
    protected function parseTypes()
    {
        $soapTypes = array();
        
        foreach ($this->types as $soapType) {
            $struct = explode(' ', str_replace(array("\n", "\t", " {", "{", "}", ";", '[', ']'), '', $soapType));
            $soapTypeName = $struct[0];
            $typeName = $struct[1];
            array_shift($struct);
            array_shift($struct);
            
            $fields = array();
            $index = 0;
            foreach ($struct as $k => $vars) {
                if ($k % 2 == 0) { //variable type
                    $fields[$index]['type'] = $vars;
                } else { //variable name
                    $fields[$index]['name'] = $vars;
                    $index++;
                }
            }
            
            //try to find a base type class
            $base = $this->findBaseType($typeName);
            
            $soapTypes[] = array(
                'type' => $soapTypeName,
                'name' => $typeName,
                'fields' => $fields,
                'base' => $base
            );
        }
        
        return $soapTypes;
    }
    
    protected function findBaseType($typeName)
    {
        if (!$this->tryFindBase) {
            return '';
        }
        $elem = $this->wsdlXml->xpath("//s:complexType[@name='" . $typeName . "']/s:complexContent/s:extension[@base]");
        
        $base = '';
        if (isset($elem[0])) {
            $base = (string) $elem[0]->attributes()->base;
            $baseParts = explode(':', $base);
            if (array_key_exists($baseParts[0], $this->wsdlXml->getDocNamespaces(true))) {
                array_shift($baseParts);
            }
            $base = $baseParts[0];
        }
        return $base;
    }
    
    protected function generateType($typeInfo)
    {
        $extend = !empty($typeInfo['base']) ? (' extends ' . $typeInfo['base']) : '';
        
        $txt = 'class ' . $typeInfo['name'] . $extend . ' {' . PHP_EOL . PHP_EOL;
        foreach ($typeInfo['fields'] as $field) {
            $txt .= "\t/**" . PHP_EOL;
            if (in_array($field['type'], $this->nativeTypes)) {
                $txt .= "\t* @var " . $field['type'] . ' $' . $field['name'] . PHP_EOL;
            } else {
                $txt .= "\t* @var "  . $field['type'] . ' $' . $field['name'] . PHP_EOL;
            }
            $txt .= "\t*/" . PHP_EOL;
            $txt .= "\tpublic $" . $field['name'] . ';' . PHP_EOL . PHP_EOL;
        }
        $txt .= '}' . PHP_EOL . PHP_EOL;
        
        return $txt;
    }
    
    protected function generateConstructor()
    {
        $constructor = "\t".'public function __construct($options = null)'.PHP_EOL;
        $constructor .= "\t".'{'.PHP_EOL;
        $constructor .= "\t\t".'$options["classmap"] = $this->classmap;'.PHP_EOL;
        $constructor .= "\t\t".'parent::__construct($this->wsdl,$options);'.PHP_EOL;
        $constructor .= "\t".'}'.PHP_EOL.PHP_EOL;
        
        return $constructor;
    }
    
    protected function generateSoapCall()
    {
        $soapCall = "\t".'public function __soapCall($function_name,$arguments,$options=NULL,$input_headers=NULL,&$output_headers=NULL)'.PHP_EOL;
        $soapCall .= "\t".'{'.PHP_EOL;
        $soapCall .= "\t\t".'try{'.PHP_EOL;
        $soapCall .= "\t\t\t".'$this->__setSoapHeaders();'.PHP_EOL;
        $soapCall .= "\t\t\t".'return parent::__soapCall($function_name,[$arguments],$options,$input_headers,$output_headers);'.PHP_EOL;
        $soapCall .= "\t\t".'}'.PHP_EOL;
        $soapCall .= "\t\t".'catch (\Exception $ex) {'.PHP_EOL;
        $soapCall .= "\t\t\t".'return $ex->faultstring;'.PHP_EOL;
        $soapCall .= "\t\t".'}'.PHP_EOL;
        $soapCall .= "\t".'}'.PHP_EOL.PHP_EOL;
        
        return $soapCall;
    }
    
    protected function parseNamespace()
    {
        if($this->namespace == '')
        {
            return '';
        }
        else
        {
            return $this->namespace."\\";
        }
    }
}