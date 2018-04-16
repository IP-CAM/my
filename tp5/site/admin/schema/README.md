#数据库描述文件

'status'=>array(
                    'type'  => 'enum',  数据类型，以mysql系统的数据类型为准
		  'charset' => 'ascii', 字符集
		   'length' => 1,       数据长度
                     'attr' => '0,1',   属性值 
		  'default' => 0,       默认值
                  'comment' => '状态 0：禁止上 1：启用', 字段描述说明
        ),