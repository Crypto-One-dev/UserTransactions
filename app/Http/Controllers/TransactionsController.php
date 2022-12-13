<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Transactions;

class TransactionsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {

    }

    public function upload_csv(Request $request) {

        if($_FILES['txt_file']['name'] != null){
            $info = pathinfo($_FILES['txt_file']['name']);
            $ext = $info['extension']; // get the extension of the file            
            $ddstr = date('Y_m_d_H_i_s');
            $file_name = "trs_".$ddstr.".".$ext;
            $target = './temp/'.$file_name;
            move_uploaded_file( $_FILES['txt_file']['tmp_name'], $target);            
            Transactions::import_csv($target);
            return redirect()->route('upload')->with('status', 'Success to upload file');
        } else {
            return redirect()->route('upload')->with('fail_status', 'Failed to upload file');
        }
    }

    public function users() {
        $data['users'] = Transactions::getUserAmounts();
        return view('users', compact('data'));    
    }

    public function userTransactions(Request $request) {
        $address = $request["search"]["value"];
        $data = Transactions::getUserTransactions($address);

        foreach($data['txs'] as $idx => &$item) {
            $item->no = $idx + 1;
        }

        return response()->json([
            "recordsTotal" => count($data['txs']),
            "recordsFiltered" => count($data['txs']),
            "data" => $data['txs'],
            "total" => count($data['txs']) + 1,
            "sum" => $data['total_amount']
        ]);
        return Tranactions::getUserTransactions();
    }
}
