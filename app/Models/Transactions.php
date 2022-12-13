<?php
namespace App\models;
  
use Illuminate\Database\Eloquent\Model;//Not required with Composer
use Illuminate\Support\Facades\DB;


class Transactions extends Model{

    protected $table="transactions";

    public static function import_csv($file){
        $row = 0;
        $trs = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);                
                $row++;
                if ($row > 1) {
                    $tr = array(
                        'txhash' => $data[0],
                        'datetime' => $data[1],
                        'address' => $data[2],
                        'amount' => str_replace(",", "", $data[3]),
                    );
                    array_push($trs, $tr);
                }

                if ($row > 1 && $row % 100 == 0){
                    DB::table('transactions')->insert($trs); 
                    $trs = [];
                }                    
            }
            if (count($trs) > 0)
                DB::table('transactions')->insert($trs); 
            fclose($handle);
        }
    }

    public static function getUserAmounts() {
        return DB::select("SELECT address, SUM(amount) AS total_amount FROM transactions GROUP BY address");
    }

    public static function getUserTransactions($address) {        
        $data['txs'] = DB::select("SELECT * FROM transactions WHERE address = '{$address}'");
        $row = DB::select("SELECT SUM(amount) AS total_amount FROM transactions WHERE address = '{$address}'");
        $data['total_amount'] = $row[0]->total_amount;
        return $data;
    }
}

?>