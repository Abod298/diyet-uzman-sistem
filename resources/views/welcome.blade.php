@extends('navbar')
@section('main')
<div class="box shadow-lg p-3 mb-5 bg-white rounded mt-5 ml-5 mr-5 d-flex align-items-center justify-content-center vh-100 ms-auto row">
    <div class="col">
        <h1 >Hoş Geldiniz <br> Lütfen Bilgilerinizi giriniz . . .</h1>
    </div>

    <form class="col" action="{{route('tables')}}" method="GET">
        <div class="form-group">
          <label for="name"></label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Adınız">
          <label for="yas"></label>
          <input type="number" class="form-control" id="yas" name="yas" placeholder="Yaşınız">
          <label for="boy"></label>
          <input type="number" class="form-control" id="boy" name="boy" placeholder="Boyunuz cm">
          <label for="kilo"></label>
          <input type="number" class="form-control" id="kilo" name="kilo" placeholder="Kilonuz kg">
        </div>
        <div class="form-group">
          <label for="cinsiyet">Cinsiyetiniz</label>
          <select class="form-control" id="cinsiyet" name="cinsiyet">
            <option>ERKEK</option>
            <option>KADIN</option>
          </select>
        </div>
        <div class="form-group">
            <label for="aktivite">Fiziksel aktivite durumu</label>
            <select class="form-control" id="aktivite" name="aktivite">
              <option  value="1">Çoğu zaman fiziksel olarak aktif değil</option>
              <option  value="2">Hafif fiziksel aktivite</option>
              <option  value="3">Orta derecede fiziksel aktivite</option>
              <option  value="4">Fiziksel olarak çok aktif</option>
            </select>
          </div>
        <!--<div class="form-group">
            <label for="hasta">Hastalık : (Varsa)</label>
            <select class="form-control" id="hasta" name="hasta">
              <option value="">Yok</option>
              <option value="diyabet">Diyabet</option>
              <option value="kolesterol">Kolesterol yüksekliği</option>
            </select>
          </div> !-->
        <button type="submit" class="btn btn-success mt-3 ml-5">Devam</button>
      </form>
</div>

@endsection
