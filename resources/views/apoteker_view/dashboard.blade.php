@extends('layouts.app')

@section('content')
<div class="d-flex text-center">
    <div class="w-100">
        <div class="container w-100">
            <div class="text-start">
                <h2> Selamat Datang, {{auth()->user()->name}}</h2>
                <hr class="mb-5">
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="h5">Obat</div>
                                <div class="h6">{{$total_obat}} </div>
                            </div>
                            <i class="fas fa-calendar-alt icon green-bg"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <div class="h5">Resep</div>
                                <div class="h6">{{$total_resep}}</div>
                            </div>
                            <i class="fas fa-calendar-check icon pink-bg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection