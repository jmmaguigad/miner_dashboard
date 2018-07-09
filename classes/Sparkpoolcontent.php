<?php
/**
 * Sparkpoolcontent Class - Class that interacts with sparkpool api
 */
class Sparkpoolcontent {
    protected $miner_url = 'https://eth.sparkpool.com/api/miner';
    protected $worker_url = 'https://eth.sparkpool.com/api/worker';

    private function getJson($url) {
        $json = file_get_contents($url);
        $obj = json_decode($json,true);
        return $obj;
    }

    /**
     * 1 - workers data
     * 2 - individual worker data
     * 3 - workers count
     * 4 - current hashrate
     * 5 - bill info
     */
    private function getContents($option,$worker) {
        $wallet_address = strtolower(WALLET_ADDRESS);
        if ($option == 1) {
            $url = $this->miner_url . DS . $wallet_address . DS . 'workers/';            
        } else if ($option == 2) {
            $url = $this->worker_url . DS . 'hashrate?wallet=' . $wallet_address . '&rig=' . $worker;
        } else if ($option == 3) {
            $url = $this->miner_url . DS . $wallet_address . DS .'workers/counts';
        } else if ($option == 4) {
            $url = $this->miner_url . DS . $wallet_address . DS . 'shares';
        } else if ($option == 5) {
            $url = $this->miner_url . DS . $wallet_address . DS . 'billInfo';
        }
        $arr = $this->getJson($url);
        if ($option == 5) {
            return $arr;
        } else {
            $processedarray = array_values($arr);
            return $processedarray[1];
        }
    }

    public function showContents($option,$worker) {
        return $this->getContents($option,$worker);
    }

    public function DND($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    public static function lastSeen($date)
    {
        if(empty($date)) {
            return "No date provided";
        }
        
        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");
        
        $now             = time();
        $unix_date         = strtotime($date);
        
           // check validity of date
        if(empty($unix_date)) {    
            return "Bad date";
        }
    
        // is it future date or past date
        if($now > $unix_date) {    
            $difference     = $now - $unix_date;
            $tense         = "ago";
            
        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }
        
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        
        $difference = round($difference);
        
        if($difference != 1) {
            $periods[$j].= "s";
        }
        
        return "$difference $periods[$j] {$tense}";
    }

    /**
     * @return mix
     * 1st argument - Hash value
     * 2nd argument - Decimal Pt
     * 3rd argument - Prefix
     * Meaning: 1 - MH/s , 2 - GH/s
     */
    public static function getHashRate($hash,$decimalpt,$prefix) {
        $prefix_measurement = ($prefix == 1) ? "MH/s" : "GH/s";
        $divisor = ($prefix == 1) ? 1000000 : 1000000000;
        return round($hash/$divisor,$decimalpt).' '.$prefix_measurement;
    }

    /**
     * @return mix
     */
    public static function getUnpaidValue($value) {
        return number_format($value) * 0.001 . " ETH";
    }

}