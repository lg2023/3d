<?php
// // 允许跨域请求
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type');

// // 处理GET请求
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // 读取x3d模型数据
//     $model_data = file_get_contents("coke.x3d");

//     // 返回x3d模型数据
//     header('Content-Type: application/x3d+xml');
//     echo $model_data;
// }

// // 处理POST请求
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // 处理从前端页面发送的数据
//     $data = json_decode(file_get_contents('php://input'), true);

//     // TODO: 处理数据并返回结果
// }
class Model
{
    // private member db to store the database connection
    private $db;
    // init Model and db
    function __construct()
    {
        $this->init_databse();
        // $this->createTable('Model_3D','Id INTEGER PRIMARY KEY, x3dModelTitle TEXT, x3dCreationMethod TEXT, modelTitle TEXT, modelSubtitle TEXT, modelDescription TEXT');

    }
    public function getHomePageInfo()
    {
    // homePage data
        return array(
            'name'=>'Coco Cola',
            'intro'=>'Coca-Cola (or Coke for short) is a type of coke produced by the Coca-Cola Company, which was born on 8 May 1886 in Atlanta, Georgia, USA, when pharmacist John Pemberton created a flavoured syrup and brought it to his neighbourhood pharmacy, where he mixed it with soft drinks to create a distinctive soft drink that could be sold over the counter. His partner and accountant, Frank Robinson, named the drink \'Coca-Cola\' and designed the distinctive lettering that is still used today. Coca-Cola is now the market leader in most countries, with 1.9 billion servings sold worldwide each day.
            <br> --Cited from Wikipedia'
        );
    }
    // find data in db
    public function find($table)
    {
        $results = $this->db->query("SELECT * FROM $table");
        return $results->fetchArray();
    }
    public function find_byID($table,$id)
    {
        $results = $this->db->query("SELECT * FROM $table WHERE  ModelId= $id" );
        return $results;
    }
    // delete data in db
    public function delete($table, $id)
    {
        $this->db->query("DELETE FROM $table WHERE id = $id");
    }
    // update data in db
    public function update($table, $id, $data)
    {
        $this->db->query("UPDATE $table SET $data WHERE id = $id");
    }
    // insert data in db
    public function insert($table, $cols='x3dModelTitle, x3dCreationMethod, modelTitle, modelSubtitle, modelDescription', $values=null)
    {
        try {
                // echo $values;
            // echo " INSERT INTO $table ($cols) VALUES ($values); ";
        $result = $this->db->query(" INSERT INTO $table ($cols) VALUES ($values); ");
    } catch (Exception $e) {
        echo $e->getMessage();
        $result= $e->getMessage();
    }
        return $result;
    }
    // a static function to get the database connection
    private function init_databse()
    {
        //connect sqlitedb use PDO
        try {
            $this->db = new PDO('sqlite:./models/data.db', 'user', 'password', array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            ));
        } catch (PDOException $e) {
            echo 'can not connect to database';
            print new Exception($e->getMessage());
        }
    }
    //create Table
    public function createTable($table, $data)
    {

            $this->db->query("CREATE TABLE $table ($data)");
    }
    public function dbGetData()
    {
        try {
            // Prepare a statement to get all records from the Model_3D table
            $sql = 'SELECT * FROM Model_3D';
            // Use PDO query() to query the database with the prepared SQL statement
            $stmt = $this->db->query($sql);
            // Set up an array to return the results to the view
            $result = null;
            // Set up a variable to index each row of the array
            $i = -0;
            // Use PDO fetch() to retrieve the results from the database using a while loop
            // Use a while loop to loop through the rows	
            while ($data = $stmt->fetch()) {
                // Don't worry about this, it's just a simple test to check we can output a value from the database in a while loop
                // echo '</br>' . $data['x3dModelTitle'];
                // Write the database conetnts to the results array for sending back to the view
                $result[$i]['x3dModelTitle'] = $data['x3dModelTitle'];
                $result[$i]['x3dPath'] = $data['x3dPath'];
                $result[$i]['modelTitle'] = $data['modelTitle'];
                $result[$i]['modelSubtitle'] = $data['modelSubtitle'];
                $result[$i]['modelDescription'] = $data['modelDescription'];
                //increment the row index
                $i++;
            }
        } catch (PD0EXception $e) {
            print new Exception($e->getMessage());
        }
        
        // Close the database connection
        // $this->db = NULL;
        // Send the response back to the view
        return $result;
    }
    public function dbModelInfo()
    {
        try {
            // Prepare a statement to get all records from the Model_3D table
            $sql = 'SELECT * FROM Model_Info';
            // Use PDO query() to query the database with the prepared SQL statement
            $stmt = $this->db->query($sql);
            // Set up an array to return the results to the view
            $result = null;
            // Set up a variable to index each row of the array
            $i = -0;
            // Use PDO fetch() to retrieve the results from the database using a while loop
            // Use a while loop to loop through the rows	
            while ($data = $stmt->fetch()) {
            //===== Model Info =====
                //'Title,
            // Background,
            // Intro,
            // ModelId'
                // Don't worry about this, it's just a simple test to check we can output a value from the database in a while loop
                // echo '</br>' . $data['x3dModelTitle'];
                // Write the database conetnts to the results array for sending back to the view
                $result[$i]['Title'] = $data['Title'];
                $result[$i]['Background'] = $data['Background'];
                $result[$i]['Intro'] = $data['Intro'];
                $result[$i]['ModelId'] = $data['ModelId'];
                //increment the row index
                $i++;
            }
        } catch (PD0EXception $e) {
            print new Exception($e->getMessage());
        }
        
        // Close the database connection
        // $this->db = NULL;
        // Send the response back to the view
        return $result;
    }
    public function dbModelInfoByID($modelID)
    {
        try {
            // Prepare a statement to get all records from the Model_3D table
            $sql = 'SELECT * FROM Model_3D WHERE ModelId='.$modelID;
            // Use PDO query() to query the database with the prepared SQL statement
            $stmt = $this->db->query($sql);
//            print $stmt;
            // Set up an array to return the results to the view
            $result = null;
            // Set up a variable to index each row of the array
            $i = -0;
            // Use PDO fetch() to retrieve the results from the database using a while loop
            // Use a while loop to loop through the rows
            while ($data = $stmt->fetch()) {
                // Don't worry about this, it's just a simple test to check we can output a value from the database in a while loop
                // echo '</br>' . $data['x3dModelTitle'];
                // Write the database conetnts to the results array for sending back to the view
                $result[$i]['x3dModelTitle'] = $data['x3dModelTitle'];
                $result[$i]['x3dPath'] = $data['x3dPath'];
                $result[$i]['modelTitle'] = $data['modelTitle'];
                $result[$i]['modelSubtitle'] = $data['modelSubtitle'];
                $result[$i]['modelDescription'] = $data['modelDescription'];
                //increment the row index
                $i++;
            }
        } catch (PD0EXception $e) {
            print new Exception($e->getMessage());
        }

        // Close the database connection
        // $this->db = NULL;
        // Send the response back to the view

        return $result;
    }
    public function initModel()
    {
        // echo '1111';
        try{
            // need to be designed futher 
            $this->createTable('Model_3D','ModelId INTEGER PRIMARY KEY AUTOINCREMENT, 
                x3dModelTitle TEXT,
                x3dPath TEXT,
                modelTitle TEXT, 
                modelSubtitle TEXT, 
                modelDescription TEXT');
            $this->createTable('Model_Info','InfoId INTEGER PRIMARY KEY AUTOINCREMENT, 
            Title TEXT,
            Background TEXT,
            Intro TEXT,
            ModelId INTEGER NOT NULL REFERENCES Model_3D(ModelID)');
            $this->insert('Model_3D',
            'x3dModelTitle,
            x3dPath,
            modelTitle,
            modelSubtitle, 
            modelDescription',
            '"Coke Can 3D Model",
            "assets/ImageToStl.com_1.x3d", 
            "Ignite Your Passion and Share a Wonderful Life with Coca-Cola",
            "Drink it all in and enjoy to the fullest",
            "Coca-Cola is a carbonated beverage originated from the United States, first introduced in 1886. Today, it has become one of the most beloved drinks by consumers worldwide. Whether at work, study or leisure, Coca-Cola can bring you unlimited passion and joy. Here, you can learn about the latest Coca-Cola product information and activity updates, and together, we can ignite passion and share a wonderful life. Drink it all in and enjoy to the fullest, making Coca-Cola an essential part of your life."');
            $modelID=$this->db->lastInsertId();
            $this->insert('Model_info',
            'Title,
            Background,
            Intro,
            ModelId',
            '"Coke Cola",
            "assets/bkg1.jpg",
            "Coca-Cola is a carbonated beverage originated from the United States, first introduced in 1886. Today, it has become one of the most beloved drinks by consumers worldwide. Whether at work, study or leisure, Coca-Cola can bring you unlimited passion and joy. Here, you can learn about the latest Coca-Cola product information and activity updates, and together, we can ignite passion and share a wonderful life. Drink it all in and enjoy to the fullest, making Coca-Cola an essential part of your life.",
            '.$modelID,
        );
            // echo '111';

            $this->insert('Model_3D',
            'x3dModelTitle,
            x3dPath,
            modelTitle,
            modelSubtitle, 
            modelDescription',
            '"Sprite Can 3D Model",
            "assets/ImageToStl.com_2.x3d",
            "Refresh Your Life with Sprite", 
            "Taste the Crispness, Feel the Freshness",
            "Sprite is a refreshing lemon-lime flavored carbonated beverage that originated from the United States. It has been a popular choice among consumers worldwide since its introduction in 1961. Whether you\'re working, studying, or enjoying leisure time, Sprite can bring you a refreshing change and help you feel more alive. Here, you can learn about the latest Sprite product information and activity updates, and together, we can refresh our lives with the crispness and freshness of Sprite. Taste the crispness, feel the freshness, and make Sprite a part of your daily routine."
            ');
             $modelID=$this->db->lastInsertId();
            $this->insert('Model_info',
            'Title,
            Background,
            Intro,
            ModelId',
            '"Sprite",
            "assets/bkg2.jpg",
            "Sprite is a refreshing lemon-lime flavored carbonated beverage that originated from the United States. It has been a popular choice among consumers worldwide since its introduction in 1961. Whether you\'re working, studying, or enjoying leisure time, Sprite can bring you a refreshing change and help you feel more alive. Here, you can learn about the latest Sprite product information and activity updates, and together, we can refresh our lives with the crispness and freshness of Sprite. Taste the crispness, feel the freshness, and make Sprite a part of your daily routine.",
            '.$modelID
            );


            $this->insert('Model_3D',
            'x3dModelTitle,
            x3dPath,
            modelTitle,
            modelSubtitle, 
            modelDescription',
            '"Fanta",
            "assets/ImageToStl.com_3.x3d",
            "Experience the Vibrant Flavors of Fanta", 
            "Indulge in the Fun, Refreshing Taste",
            "Fanta is a fruit-flavored carbonated beverage that originated in Germany in 1940. It has since become a popular choice among consumers worldwide, known for its bold and vibrant flavors. Whether you\'re looking for a refreshing drink to quench your thirst or a fun and exciting taste experience, Fanta has something for everyone. Here, you can learn about the latest Fanta product information and activity updates, and together, we can indulge in the fun, refreshing taste of Fanta. Experience the vibrant flavors, indulge in the fun, and make Fanta a part of your daily routine."
            ');
             $modelID=$this->db->lastInsertId();
            $this->insert('Model_info',
            'Title,
            Background,
            Intro,
            ModelId',
            '"Fanta",
            "assets/bkg3.jpg",
            "Fanta is a fruit-flavored carbonated beverage that originated in Germany in 1940. It has since become a popular choice among consumers worldwide, known for its bold and vibrant flavors. Whether you\'re looking for a refreshing drink to quench your thirst or a fun and exciting taste experience, Fanta has something for everyone. Here, you can learn about the latest Fanta product information and activity updates, and together, we can indulge in the fun, refreshing taste of Fanta. Experience the vibrant flavors, indulge in the fun, and make Fanta a part of your daily routine.",
            '.$modelID
        );
           }catch(PD0EXception $e){
            echo new Exception($e->getMessage());
        };
        
    }   
}
