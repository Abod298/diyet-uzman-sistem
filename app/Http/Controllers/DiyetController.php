<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class DiyetController extends Controller
{
    public function index(Request $request){
        $idealKilo = $this->idalKilo($request);
        $bki = $this->BKI($request);
        $ihtiyacKalori = $this->ihtiyackalori($request);
        $ogleYemek= $this->haftaOgleYemek($request);
        $kahvalti = $this->haftaKahvalti($request);
        $aksamYemek = $this->haftaAksamYemek($request);
        return view('tables', )->with('ideal' , $idealKilo)->with('ogleYemekler' , $ogleYemek)->with('kahvaltiler' , $kahvalti)
        ->with('aksamYemekler' , $aksamYemek)->with('ihtiyacKalori' , $ihtiyacKalori)->with('kullanci',$request->name)->with('bki',$bki);
    }

    public function ogleYemek(){
        $anaYemekler = DB::select('select name , calorie
        from ana_yemekler
        ORDER BY RAND()
        LIMIT 1');
        $corbalar = DB::select('select name , calorie
        from corbalar
        ORDER BY RAND()
        LIMIT 1');
        $pilavlar = DB::select('select name , calorie
        from pilavlar
        ORDER BY RAND()
        LIMIT 1');
        $salatalar = DB::select('select name , calorie
        from salatalar
        ORDER BY RAND()
        LIMIT 1');
        $ogle = $anaYemekler[0]->name . '-' . $corbalar[0]->name . '-' . $pilavlar[0]->name . '-' . $salatalar[0]->name ;
        $kalori = $anaYemekler[0]->calorie + $corbalar[0]->calorie + $pilavlar[0]->calorie + $salatalar[0]->calorie;
        return [$ogle , $kalori];
    }
    public function haftaOgleYemek($request){
        $haftaOgleYemek = [];
        for ($i = 1; $i <= 7; $i++){
            if($request->hasta == 'diyabet'){
                $ogle = $this->ogleYemekSeker();
            }elseif($request->hasta == 'kolesterol'){
                $ogle = $this->ogleYemekKolistrol();
            }else
                $ogle = $this->ogleYemek();
            array_push($haftaOgleYemek , [$ogle[0] , $ogle[1]]);
        }
        return $haftaOgleYemek;
    }
    public function kahvalti(){
        $kahvaltiYemek = DB::select('select name , calorie
        from kahvalti_yemekler
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        ORDER BY RAND()
        LIMIT 1');

        $kahvalti = $kahvaltiYemek[0]->name . '-' . $icecek[0]->name . '-' . 'Ekmek' ;
        $kalori = $kahvaltiYemek[0]->calorie + $icecek[0]->calorie  + 264*1.5;
        return [$kahvalti , $kalori];
    }
    public function haftaKahvalti($request){
        $haftaKahvalti = [];
        for ($i = 1; $i <= 7; $i++){
            if($request->hasta == 'diyabet'){
                $kahvalti = $this->kahvaltiSeker();
            }elseif($request->hasta == 'kolesterol'){
                $kahvalti = $this->kahvaltiKolistrol();
            }else
                $kahvalti = $this->kahvalti();

            array_push($haftaKahvalti , [$kahvalti[0] , $kahvalti[1]]);
        }
        return $haftaKahvalti;
    }
    public function aksamYemek(){
        $aksamYemek = DB::select('select name , calorie
        from aksam_yemekler
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        ORDER BY RAND()
        LIMIT 1');
        $aksam = $aksamYemek[0]->name . '-' . $icecek[0]->name . '-' . 'EKMEK' ;
        $kalori = $aksamYemek[0]->calorie + $icecek[0]->calorie + 264*1.2;
        return [$aksam , $kalori];
    }
    public function haftaAksamYemek($request){
        $haftaAksamYemek = [];
        for ($i = 1; $i <= 7; $i++){
            if($request->hasta == 'diyabet'){
                $aksam = $this->aksamYemekSeker();
            }elseif($request->hasta == 'kolesterol'){
                $aksam = $this->aksamYemekKolistrol();
            }else
                $aksam = $this->aksamYemek();
            array_push($haftaAksamYemek , [$aksam[0] , $aksam[1]]);
        }
        return $haftaAksamYemek;
    }

    public function ihtiyackalori($request){
        if($request->cinsiyet == 'ERKEK'){
            $rmr = ($request->kilo * 10 )+($request->boy * 6.25)-($request->yas * 5) + 5;
        }else{
            $rmr = ($request->kilo * 10 )+($request->boy * 6.25)-($request->yas * 5) - 161;
        }
        if($request->aktivite == 1){
            $ihtiyacKalori = $rmr * 1.25 ;
        }elseif ($request->aktivite == 2){
            $ihtiyacKalori = $rmr * 1.375 ;
        }elseif ($request->aktivite == 3){
            $ihtiyacKalori = $rmr * 1.550 ;
        }else{
            $ihtiyacKalori = $rmr * 1.725 ;
        }
        return $ihtiyacKalori;
    }

    private function idalKilo($request){
        if($request->cinsiyet == 'ERKEK'){
            $idealKilo = 48 + 1.1 * ($request->boy - 150);
        }else{
            $idealKilo = 45 + 0.9 * ($request->boy - 150);
        }
        return $idealKilo;
    }
    public function BKI($request){
        $bki = $request->kilo / (($request->boy /100) * ($request->boy / 100) );
        return $bki;
    }
    public function aksamYemekSeker(){
        $aksamYemek = DB::select('select name , calorie
        from aksam_yemekler
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $aksam = $aksamYemek[0]->name . '-' . $icecek[0]->name . '-' . 'EKMEK' ;
        $kalori = $aksamYemek[0]->calorie + $icecek[0]->calorie + 264*1.2;
        return [$aksam , $kalori];
    }
    public function aksamYemekKolistrol(){
        $aksamYemek = DB::select('select name , calorie
        from aksam_yemekler
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $aksam = $aksamYemek[0]->name . '-' . $icecek[0]->name . '-' . 'EKMEK' ;
        $kalori = $aksamYemek[0]->calorie + $icecek[0]->calorie + 264*1.2;
        return [$aksam , $kalori];
    }
    public function kahvaltiSeker(){
        $kahvaltiYemek = DB::select('select name , calorie
        from kahvalti_yemekler
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');

        $kahvalti = $kahvaltiYemek[0]->name . '-' . $icecek[0]->name . '-' . 'Ekmek' ;
        $kalori = $kahvaltiYemek[0]->calorie + $icecek[0]->calorie  + 264*1.5;
        return [$kahvalti , $kalori];
    }
    public function kahvaltiKolistrol(){
        $kahvaltiYemek = DB::select('select name , calorie
        from kahvalti_yemekler
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $icecek = DB::select('select name , calorie
        from icecekler
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');

        $kahvalti = $kahvaltiYemek[0]->name . '-' . $icecek[0]->name . '-' . 'Ekmek' ;
        $kalori = $kahvaltiYemek[0]->calorie + $icecek[0]->calorie  + 264*1.5;
        return [$kahvalti , $kalori];
    }
    public function ogleYemekSeker(){
        $anaYemekler = DB::select('select name , calorie
        from ana_yemekler
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $corbalar = DB::select('select name , calorie
        from corbalar
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $pilavlar = DB::select('select name , calorie
        from pilavlar
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $salatalar = DB::select('select name , calorie
        from salatalar
        WHERE `desc` != "seker"
        ORDER BY RAND()
        LIMIT 1');
        $ogle = $anaYemekler[0]->name . '-' . $corbalar[0]->name . '-' . $pilavlar[0]->name . '-' . $salatalar[0]->name ;
        $kalori = $anaYemekler[0]->calorie + $corbalar[0]->calorie + $pilavlar[0]->calorie + $salatalar[0]->calorie;
        return [$ogle , $kalori];
    }
    public function ogleYemekKolistrol(){
        $anaYemekler = DB::select('select name , calorie
        from ana_yemekler
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $corbalar = DB::select('select name , calorie
        from corbalar
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $pilavlar = DB::select('select name , calorie
        from pilavlar
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $salatalar = DB::select('select name , calorie
        from salatalar
        WHERE `desc` != "kolistrol"
        ORDER BY RAND()
        LIMIT 1');
        $ogle = $anaYemekler[0]->name . '-' . $corbalar[0]->name . '-' . $pilavlar[0]->name . '-' . $salatalar[0]->name ;
        $kalori = $anaYemekler[0]->calorie + $corbalar[0]->calorie + $pilavlar[0]->calorie + $salatalar[0]->calorie;
        return [$ogle , $kalori];
    }


}
