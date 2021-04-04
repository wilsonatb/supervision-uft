@extends('layouts.app')
    @section('content')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    No tienes autorizacion para acceder
                </div>
                <div class="card-body">
                  <h5 class="card-title">No tienes autorizacion para acceder</h5>
                  <p class="card-text">Contacta al administrador.</p>
                  {{-- <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">salir</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> --}}
                </div>
              </div>
            
        </div>
    @endsection