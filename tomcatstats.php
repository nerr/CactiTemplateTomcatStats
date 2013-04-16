<?php
/*
*  TomcatStats v0.1(PHP)
*  Based Timothy Denike TomcatStats v0.1
* 
*  By Leon Zhuang 
*  http://nerrsoft.com
*  leon@nerrsoft.com
*/ 

// information
if($_SERVER["argc"]!=4){
    exit;
}
$host = $_SERVER["argv"][1];
$username = $_SERVER["argv"][2];
$password = $_SERVER["argv"][3];
$url = 'http://'.$username.':'.$password.'@'.$host.'/manager/status?XML=true';

// connect & get data
$status = file_get_contents($url, 'r');
$obj = simplexml_load_string($status);

// output 
if($obj){
    print "jvm_memory_free:".$obj->jvm->memory->attributes()->free.' ';
    print "jvm_memory_max:".$obj->jvm->memory->attributes()->max.' ';
    print "jvm_memory_total:".$obj->jvm->memory->attributes()->total.' ';
    print "connector_max_time:".$obj->connector->requestInfo->attributes()->maxTime.' ';
    print "connector_error_count:".$obj->connector->requestInfo->attributes()->errorCount.' ';
    print "connector_bytes_sent:".$obj->connector->requestInfo->attributes()->bytesSent.' ';
    print "connector_processing_time:".$obj->connector->requestInfo->attributes()->processingTime.' ';
    print "connector_request_count:".$obj->connector->requestInfo->attributes()->requestCount.' ';
    print "connector_current_thread_count:".$obj->connector->threadInfo->attributes()->currentThreadCount.' '; 
    print "connector_min_spare_threads:".$obj->connector->threadInfo->attributes()->minSpareThreads.' '; 
    print "connector_max_threads:".$obj->connector->threadInfo->attributes()->maxThreads.' '; 
    print "connector_max_spare_threads:".$obj->connector->threadInfo->attributes()->maxSpareThreads.' '; 
    print "connector_current_threads_busy:".$obj->connector->threadInfo->attributes()->currentThreadsBusy.' ';    
}
exit;
?>