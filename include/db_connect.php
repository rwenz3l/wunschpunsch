<?php

class RequestDB extends SQLite3 {
    /*
    * My own SQLite Class for Handling the DB
    * Takes FilePath as Argument.
    */
    
    // Database Connection
    private $db;
    
    // Set Current Version
    private $db_version;
    
    function __construct($filePath) {
        $this->open($filePath, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        $this->query('CREATE TABLE IF NOT EXISTS requests (name TEXT, filled INTEGER);');
    }
    
    function postConstruct() {
        $schema = $this->updateSchema();
        return $schema;
    }
    
    function setVersion($v) {
        $stmt = $this->prepare('PRAGMA user_version = :version;');
        $stmt->bindValue(':version', $version, SQLITE3_INTEGER);
        $result = $stmt->execute();
    }
    
    function getVersion() {
        $statement = $this->prepare('PRAGMA user_version;');
        // For Whatever Reason this needs to be Fetched as an Array
        $result = $statement->execute()->fetchArray(SQLITE3_ASSOC);
        return $result['user_version'];
    }
    
    function updateSchema() {
        $version = $this->getVersion();
        
        /*
         * Update 1
         * +++ Column: comments, Type=TEXT
         */
        if($version < 1){
            $version += 1;
            $this->exec("BEGIN;");
            $statement_schema = $this->prepare('ALTER TABLE requests ADD COLUMN comments TEXT');
            $statement_schema->execute();
            
            $statement_pragma = $this->prepare("PRAGMA user_version = ${version}");
            $statement_pragma->execute();
            $result = $this->exec("COMMIT;");
            if(! $result ){
                $this->exec("ROLLBACK;");
                echo("Error in Update 1");
                $version -= 1;
                return 1;
            }
        }
        
        /*
         * Update 2
         * +++ Change all filled Values to 0
         * that have been inserted as NULL (Bug)
         */
        if($version < 2){
            $version += 1;
            $this->exec("BEGIN;");
            $statement_schema = $this->prepare('UPDATE requests SET filled=0 WHERE filled ISNULL');
            $statement_schema->execute();
            
            $statement_pragma = $this->prepare("PRAGMA user_version = ${version}");
            $statement_pragma->execute();
            $result = $this->exec("COMMIT;");
            if(! $result ){
                $this->exec("ROLLBACK;");
                echo("Error in Update 2");
                $version -= 1;
                return 1;
            }
        }
    return 0;
    } // Update Schema End    

} // RequestDB End


// Database Connection
$db = new RequestDB($filePath="../data/requests.db");

//Post-Construction
$post = $db->postConstruct();
if($post != 0){
    echo("Error in DB Initialization");
}

?>