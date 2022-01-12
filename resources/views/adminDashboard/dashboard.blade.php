@extends('indexDashboard')

@section('content')

    <!-- Begin Page Content -->
    <div class="dashboardSection">
        <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Dashboard</h3>
                    <h3>Selamat datang {{ auth()->user()->name }}</h3>
                   <h3>Join date: {{ Carbon\Carbon::parse(auth()->user()->created_at)->format('j F Y') }}</h3>
                </div>
            </div>
        </div>
    </div>


@endsection
