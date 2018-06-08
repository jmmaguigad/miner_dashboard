<?php
/**
 * Change $url to the right subdomain where your rigs were listed
 */
class Filecontent {
    public $_count;
    public $url = 'http://custompanel.ethosdistro.com/?json=yes';

    private function getJson() {
        $json = file_get_contents($this->url);
        $obj = json_decode($json,true);
        return $obj;
    }

    private function getContents() {
        $arr = $this->getJson();
        $processedarray = array_values($arr["rigs"]);
        $this->_count = count($processedarray);
        return $processedarray;
    }

    public function showContents() {
        return $this->getContents();
    }

    private function getHeaderValues() {
        $arr = $this->getJson();
        return array_values($arr["per_info"]);
    }

    public function showHeaderValues() {
        return $this->getHeaderValues();
    }

    public function countArray() {        
        return $this->_count;
    }

    public function DND($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}