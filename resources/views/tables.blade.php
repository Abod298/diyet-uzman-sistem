@extends('navbar')
@section('main')
    <div class="box">
        <div class="container d-flex align-items-center justify-content-center">
            <h2>Merhaba {{ $kullanci }}</h2>
        </div>
        <div class="container d-flex align-items-center justify-content-center">
            <h3>Beslenme ve Diyetetik Uzman Sistemine Hoş Geldiniz</h3>
        </div>
    </div>

    <div class="ml-5 mt-5">
        <div>
            <h5> BKI'iniz : {{ number_format((float) $bki, 2, '.', '') }} ->
                @if ($bki < 15)
                    Çok Şiddetli Kilo kaybınız var
                @elseif ($bki < 16)
                    Şiddetli Kilo kaybınız var
                @elseif ($bki < 18.5)
                    Kilo kaybınız var
                @elseif ($bki < 25)
                    Harika , Kilonuz iyidir !
                @elseif ($bki < 30)
                    Birinci derece obezite
                @elseif ($bki < 35)
                    İkinci derece obezite
                @else
                    Çok aşırı obeziteniz var
                @endif

            </h5>
        </div>
        <div>
            <h5> İdeal Kilonuz : {{ $ideal }} kg</h5>
        </div>
        <div>
            <h5> Günlük Kalori İhtiyacınız : {{ number_format((float) $ihtiyacKalori, 2, '.', '') }} kcal</h5>
        </div>
    </div>
    <div>

    </div>
    <div class="ml-5 mr-5 mt-5 d-flex align-items-center justify-content-center vh-100 ms-auto row">
        <table class="table opacity-100 text-center " style="border: 4px solid #4f4b4b;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Pazartesi</th>
                    <th scope="col">Salı</th>
                    <th scope="col">Çarşamba</th>
                    <th scope="col">Perşempe</th>
                    <th scope="col">Cuma</th>
                    <th scope="col">Cumartesi</th>
                    <th scope="col">Pazar</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;">
                    @foreach ($kahvaltiler as $kahvalti)
                        <td scope="col">{{ $kahvalti[0] }}</td>
                    @endforeach
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    @foreach ($ogleYemekler as $ogleYemek)
                        <td scope="col">{{ $ogleYemek[0] }}</td>
                    @endforeach
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    @foreach ($aksamYemekler as $aksamYemek)
                        <td scope="col">{{ $aksamYemek[0] }}</td>
                    @endforeach
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    @for ($i = 0; $i < 7; $i++)
                        <td scope="col">{{ $ogleYemekler[$i][1] + $kahvaltiler[$i][1] + $aksamYemekler[$i][1] }} kcal
                        </td>
                    @endfor
                </tr>
            </tbody>
        </table>

        <div class="mr-5">
            <a href="{{ route('main') }}" class="btn btn-info">Ana sayfa</a>
        </div>
        <div class="ml-5">
            <a href="/" class="btn btn-success">Yazdir</a>
        </div>
    </div>
@endsection
