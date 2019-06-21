<?php
    // echo "获取页面传来的参数";

    // 从文件中读取数据到PHP变量  
    $json_string = file_get_contents('json/data.json');  
      
    // 用参数true把JSON字符串强制转成PHP数组  
    $data = json_decode($json_string, true);  
      
    // 显示出来看看  
    // var_dump($json_string); 
    // var_dump ($data); 
    // print_r($data); 

    // //产品循环
    function foreachFun($d)
    {
      foreach ($d as $key => $value) {
        // $v = $value['value'];
        $value['value']=$value['label'];
        // var_dump($value['value']);exit();
        if(isset($value["children"])){
            foreachFun($value["children"]);
        }
      }
      return $d;
    }


    $result = foreachFun($data);
    var_dump($result);

  ?>